<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Event;
use App\Mail\OrderShipped;
use App\Order;
use App\OrderDetail;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        return view('events.tickets.index',compact('event'));
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
        if ($request->email){
            $customer = Customer::whereEmail($request->email)->first();
            if ($customer){
                $orderDetail->customer_id = $customer->id;
                $orderDetail->update();
                return "hecho";
            }

            Mail::to(['email' => $request->email])->send(new OrderShipped($orderDetail));
            return "enviado";
        }
        return "falta el email";
    }

    public  function verify($token)
    {
        return "ticketController@verify";
    }

}
