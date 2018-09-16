<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DocumentType;
use App\Event;
use App\EventType;
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
        $customers = Customer::fullName($request->full_name)->orderBy('first_name', 'ASC')->paginate(10);

        if ($request->ajax()) {
            return view('customers.partials.customers', compact('customers'));
        }

        return view('customers.index', compact('customers'));
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
        $customer = Customer::create($request->all());

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

    public function portal()
    {
        $events = Event::lastEvents(3);
        return view('portal.home', compact('events'));
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
    public function events(Request $request)
    {
        $events      = Event::title($request->title)->orderBy('title', 'ASC')->paginate(20);
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $event_form  = new Event();
        $page        = new Page();

        return view('portal.customer.events', compact('events', 'event_types', 'event_form', 'page'));

    }

}
