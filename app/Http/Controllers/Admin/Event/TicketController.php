<?php

namespace App\Http\Controllers\Admin\Event;

use App\Customer;
use App\Event;
use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Mail\RefuseTicket;
use App\Mail\TicketNotification;
use App\Order;
use App\OrderDetail;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        Ticket::checkIncompleteTickets();
        return view('admin.events.tickets.index',compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Ticket::create($request->all())){
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$event,$id)
    {
        $ticket = Ticket::find($id);
        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Event $event, Ticket $ticket)
    {
        $ticket->fill($request->all());
        $ticket->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event,Ticket $ticket)
    {
        $ticket->delete();
        return back();
    }

    public function assignToCustomer(Order $order, OrderDetail $orderDetail,Request $request)
    {
        if  (isset($request->owner)){
            $orderDetail->customer_id = $request->user()->id;
            $orderDetail->update();
            session()->flash('message','Tiquete asignado a ' . $request->user()->full_name);
            Mail::to(['email' => $request->user()->email])->send(new OrderShipped($orderDetail));
            return back();
        }
        if ($request->email && $orderDetail->customer_id == null){
            $customer = Customer::whereEmail($request->email)->first();
            if ($customer){
                $orderDetail->customer_id = $customer->id;
                $orderDetail->update();
                Mail::to(['email' => $request->email])->send(new OrderShipped($orderDetail));
                session()->flash('message','Tiquete asignado al usuario ' . $customer->email);
                return back();
            }
            $orderDetail->send_to_email = $request->email;
            $orderDetail->token_verify = Str::uuid();
            $orderDetail->update();
            Mail::to(['email' => $request->email])->send(new OrderShipped($orderDetail));
            session()->flash('message','Tiquete enviado al correo ' . $request->email);
            return back();
        }
        session()->flash('message',"Falta el email o el tiquete ya esta asignado");
        return back();
    }

    public function verify(Request $request)
    {
        $status = false;
        if (OrderDetail::where('token_verify','=',$request->token)->first()){
            $status = true;
        }

        return response()->json([
            'status' => $status
        ]);
    }

    public function asiggnByToken(Request $request)
    {
        if ($detail = OrderDetail::where('token_verify','=',$request->token)->first()){
            $detail->token_verify = null;
            $detail->send_to_email = null;
            $detail->customer_id = $request->user()->id;
            $detail->update();
            // Enviar email de tiquete asignado
            //return redirect(route(''));
            session()->flash('message','Tiquete asignado para el evento ' . $detail->event->title);
        }
        return back();

    }

    public function refuse(Request $request, OrderDetail $orderDetail)
    {

        session()->flash('message','Tiquete rechazado');
        if ($orderDetail->customer_id && $orderDetail->order->customer_id != $orderDetail->customer_id){
            Mail::to(['email' => $orderDetail->customer->email])->send(new RefuseTicket($orderDetail,$request->user()));
        }
        Mail::to(['email' => $orderDetail->order->customer->email])->send(new RefuseTicket($orderDetail,$request->user()));
        $orderDetail->customer_id = null;
        $orderDetail->update();
        return redirect(route('portal'));
    }

    public function resendEmail(OrderDetail $orderDetail){
        Mail::to(['email' => $orderDetail->send_to_email])->send(new OrderShipped($orderDetail));
        session()->flash('message','Correo reenviado');
        return back();
    }

    public  function attended(Event $event, OrderDetail $orderDetail)
    {
        $orderDetail->attended = true;
        if ($orderDetail->update()){
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}
