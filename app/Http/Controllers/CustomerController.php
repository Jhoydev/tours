<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\Meeting;
use App\DocumentType;
use App\Event;
use App\EventType;
use App\Notifications\CreateCustomer;
use App\Order;
use App\OrderDetail;
use App\Page;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Company::find(Auth::user()->company_id)->customers();

        if ($request->ajax()) {
            return view('customers.partials.customers', compact('customers'));
        }

        return view('customers.index', compact('customers','company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $customer    = new Customer();

        $document_types = DocumentType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('customers.create', compact('customer', 'permissions', 'document_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $request->validate([
            'email' => 'required|unique:customers|email'
        ]);
        $customer = Customer::create($request->all());
        if (Auth::guard('web')){
            $customer->notify(new CreateCustomer($customer,$request->email,$request->password));
        }
        session()->flash('message', "Asistente $customer->name creado");
        return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        $document_types = DocumentType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('customers.edit', compact('customer', 'document_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::find($id);
        $customer->fill($request->all());
        $customer->save();

        session()->flash('message', "La información del asistente: $customer->first_name $customer->last_name ha sido actualizada");
        if (Auth::guard('customer')->check()) {
            return redirect(route('portal'));
        }
        return redirect('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        session()->flash('message', "El asistente: $customer->first_name $customer->last_name ha sido eliminado correctamente");
        return redirect('customer');
    }

    public function portal(Request $request)
    {
        $details = OrderDetail::where('customer_id','=',$request->user()->id)
            ->whereHas('event',function ($query){
                $query->where('end_date','>',now());
            })
            ->groupBy('event_id')
            ->get();
        return view('portal.home', compact('details'));
    }

    public function profile()
    {
        $customer = Customer::find(Auth::user()->id);
        return view('portal.customer.profile', compact('customer'));
    }

    public function changePassword(){
        return view('portal.customer.change_password');
    }

    public function updatePassword(Request $request){
        if (Auth::guard('customer')->check()){
            $request->validate([
                'current_password' => 'current_password',
                'password' => 'required|string|min:6|confirmed',
            ]);
            $customer = Customer::find(Auth::user()->id);
            $customer->password = bcrypt($request->password);
            $customer->update();
            return redirect(route('profile'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function event(Request $request,Event $event)
    {
        if ($event->end_date < now()){
            session()->flash('message','Este evento no esta disponible');
            return back();
        }
        $orders = Order::where('customer_id','=',$request->user()->id)->where('event_id','=',$event->id)->get();
        $details = OrderDetail::where('customer_id','=',$request->user()->id)->where('event_id','=',$event->id)->get();
        $details_null = OrderDetail::DetailsNull($event,$request->user());
        return view('portal.event.index', compact('event','details','details_null','orders'));
    }


    public function order(Request $request, Event $event, Order $order)
    {
        $details = OrderDetail::where('customer_id','=',$request->user()->id);

        $details = $order->orderDetails;

        return view ('portal.customer.order',compact('order','details','event'));
    }

    public function orders(Request $request, Event $event)
    {

        $orders = Order::with('order_status')->where('customer_id','=',$request->user()->id)->where('event_id','=',$event->id)->withCount([
            'orderDetails',
            'orderDetails as pending_assign' => function ($query) {
                $query->where('customer_id', null);
            }
        ])->get();

        $details_null = OrderDetail::DetailsNull($event,$request->user());
        return view ('portal.order.index',compact('orders','event','details_null'));
    }

    public function Details(Request $request, Event $event)
    {
        $details = OrderDetail::where('customer_id','=',$request->user()->id)->where('event_id','=',$event->id)->get();
        return view ('portal.customer.details',compact('details','event'));
    }

    public function Calendar(Event $event, Customer $customer)
    {
        $dates = Meeting::where('customer_id','=',$customer->id)
            ->where('event_id','=',$event->id)->where('meeting_status_id','!=','3')
            ->orWhere(function ($query) use ($customer,$event){
                $query->where('contact_id','=',$customer->id)
                    ->where('event_id','=',$event->id);
            })->where('meeting_status_id','!=','3')
            ->get();
        $res = [];
        if (count($dates)){
            foreach ($dates as $date){
                $name = $date->contact->full_name;
                $contact = $date->contact;
                // Ponemos la subfijo solcitada cuando es una cita pedida por nosotros
                if ($date->contact_id == $customer->id){
                    $name = $date->customer->full_name . " - Solicitada";
                    $contact = $date->customer;

                }
                $color = '#20a8d8';
                if ($date->meeting_status_id == 1) {
                    $color = '#4dbd74';
                }
                if ($date->meeting_status_id == 2) {
                    $color = 'gold';
                }

                $res[] = [
                    'id' => $date->id,
                    'title' => "$name",
                    'start' => $date->start_date->toDateTimeString(),
                    'end' => $date->end_date->toDateTimeString(),
                    'color' => $color,
                    'message' => $date->message,
                    'status' => $date->meeting_status_id,
                    'req' => url("portal/event/$event->id/date/$date->id"),
                    'contact_id' => $date->contact_id,
                    'contact' => $contact
                ];
            }
        }
        return response()->json($res);
    }

    public function History(Request $request)
    {
        $details = OrderDetail::where('customer_id','=',$request->user()->id)->with(['event' => function ($query) {
            $query->where('start_date','<',now())->where('end_date','<',now());
        }])->groupBy('event_id')->get();
        return view('portal.customer.history', compact('details'));
    }
}
