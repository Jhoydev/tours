<?php

namespace App\Http\Controllers;

use App\Customer;
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
        session()->flash('message','Tiquetes Asignados');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event,Ticket $ticket,Customer $customer)
    {
        $orders = Order::where('customer_id',$customer->id)->where('order_status_id','<=',4)->whereHas('orderDetails',function ($query) use ($ticket) {
            return $query->where('ticket_id',$ticket->id);
        })->get();

        return view('events.tickets.show',compact('orders','customer','event','ticket'));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id ,$ticket_id,$order_id)
    {
        $ticket = Ticket::find($ticket_id);
        $order = Order::find($order_id);
        $ticket->increment('quantity_available',count($order->orderDetails));
        $ticket->update();
        $order->delete();
        session()->flash('message','Se han cancelado los tiquetes');
        return redirect("events/$event_id/tickets/$ticket_id/send-tickets");
    }
}
