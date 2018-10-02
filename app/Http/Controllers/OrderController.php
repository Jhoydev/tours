<?php

namespace App\Http\Controllers;

use App\Event;
use App\OrderDetail;
use App\Ticket;
use App\Order;
use App\MyLaravelPayU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    protected $successPayment = false;
    protected $paymentErrors  = [];
    protected $res            = '';

    public function show(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $data          = $request->all();
            $arr_ticket_id = [];
            $data_ticket   = [];
            $new_order = false;

            if ($arr_json      = json_decode($request->buy_json, 1)) {

                $event   = Event::find($request->event_id);
                $customer_id = Auth::user()->id;

                if (!$order = Order::where('reference','=',$request->reference)->first()){
                    $order = new Order();
                    $new_order = true;
                }

                $order->event_id = $event->id;
                $order->customer_id = $customer_id;
                $order->order_status_id = 5;
                $order->reference = $request->reference;
                $order->save();

                $order_value = 0;
                foreach ($arr_json as $li) {

                    $data_ticket[$li['id']]['qty'] = $li['qty'];
                    array_push($arr_ticket_id, $li['id']);

                    $ticket =  Ticket::find($li['id']);

                    $order_value += ($ticket->price * (int) $li['qty']);
                    if ($new_order){
                        $ticket->decrement('quantity_available',$li['qty']);
                        for ($i = 1; $i <= $li['qty']; $i++) {
                            OrderDetail::addDetail($ticket,$order);
                        }
                    }

                }
                $tickets = Ticket::WhereIn('id', $arr_ticket_id)->get();

                $order->value = $order_value;
                $order->update();

                return view('portal.order.create', compact('tickets', 'data_ticket', 'data', 'event','order'));
            }
            return redirect(route('event.page', [$request->key_app, $request->page_id]));
        } else {
            return redirect(route('portal.login'));
        }
    }

    public function  store(Request $request)
    {
        $res = true;
        $order = Order::find($request->order_id);
        $order->order_status_id = 1;
        if ($request->method_payment == "card_payments"){
            $order->payu_order_id = Str::uuid();
            $order->transaction_id = Str::uuid();
        }
        foreach ($order->orderDetails as $order_detail){
            $order_detail->complete = true;
            if (!$order_detail->update()){
                $res = false;
            }
        }
        if(!$order->update()){
            $res = false;
        }
        if ($res){
            return redirect(route('order.invoice',['order' => $order]));
        }else{
            return back();
        }
    }

    public function invoice(Request $request, Order $order)
    {
        return view('portal.order.invoice',compact('order'));
    }
    
}
