<?php

namespace App\Http\Controllers;

use App\Event;
use App\Order;
use App\OrderDetail;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SpecialTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event,Ticket $ticket)
    {
        $customers = Auth::user()->company->Customers();
        return view('events.tickets.customers',compact('event','ticket','customers'));
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
    public function store(Request $request,Event $event, Ticket $ticket)
    {
        $order = new Order();
        $order->reference = Str::uuid();
        $order->value = 0;
        $order->customer_id = $request->customer_id;
        $order->event_id = $event->id;
        $order->order_status_id = 1;
        $order->save();
        for ($i = 1; $i <= $request->quantity_available;$i++){
            OrderDetail::addDetail($ticket,$order);
        };
        OrderDetail::where('order_id',$order->id)->update(['complete' => 1]);
        $ticket->decrement('quantity_available',$request->quantity_available);
        $ticket->update();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
