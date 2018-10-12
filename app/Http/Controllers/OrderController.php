<?php

namespace App\Http\Controllers;

use App\Event;
use App\OrderDetail;
use App\Ticket;
use App\Order;
use App\MyLaravelPayU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class OrderController extends Controller
{

    public function show(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $data          = $request->all();
            $arr_ticket_id = [];
            $data_ticket   = [];
            $new_order     = false;

            if ($arr_json = json_decode($request->buy_json, 1)) {

                $event       = Event::find($request->event_id);
                $customer_id = Auth::user()->id;

                if (!$order = Order::where('reference', '=', $request->reference)->first()) {
                    $order     = new Order();
                    $new_order = true;
                }

                $order->event_id        = $event->id;
                $order->customer_id     = $customer_id;
                $order->order_status_id = 5;
                $order->reference       = $request->reference;
                $order->save();

                $order_value = 0;
                foreach ($arr_json as $li) {

                    $data_ticket[$li['id']]['qty'] = $li['qty'];
                    array_push($arr_ticket_id, $li['id']);

                    $ticket = Ticket::find($li['id']);

                    $order_value += ($ticket->price * (int) $li['qty']);
                    if ($new_order) {
                        $ticket->decrement('quantity_available', $li['qty']);
                        for ($i = 1; $i <= $li['qty']; $i++) {
                            OrderDetail::addDetail($ticket, $order);
                        }
                    } else {
                        $ticket->increment('quantity_available', count($order->orderDetails));
                        DB::table('order_details')->where('order_id', '=', $order->id)->delete();
                        for ($i = 1; $i <= $li['qty']; $i++) {
                            OrderDetail::addDetail($ticket, $order);
                        }
                    }
                }
                $tickets = Ticket::WhereIn('id', $arr_ticket_id)->get();
                $order->value = $order_value;

                // PayU Information
                $random_string = get_random_string();
                $signature     = config('payu.payu_api_key') . "~" .
                        config('payu.payu_merchant_id') . "~" .
                        $random_string . "~" .
                        $order_value . "~" .
                        config('payu.payu_currency');
                $payu          = (object) [
                            "url"             => config('payu.payu_url'),
                            "merchantId"      => config('payu.payu_merchant_id'),
                            "accountId"       => config('payu.payu_account_id'),
                            "description"     => $event->title,
                            "referenceCode"   => $random_string,
                            "amount"          => $order_value,
                            "tax"             => "0",
                            "taxReturnBase"   => "0",
                            "currency"        => config('payu.payu_currency'),
                            "signature"       => md5($signature),
                            "test"            => (int) config('payu.payu_testing'),
                            "responseUrl"     => route('order.invoice', ['order' => $order]),
                            "confirmationUrl" => "",
                ];

                $order->reference = $random_string;
                $order->update();

                return view('portal.order.create', compact('tickets', 'data_ticket', 'data', 'event', 'order', 'payu'));
            }
            return redirect(route('event.page', [$request->key_app, $request->page_id]));
        } else {
            return redirect(route('portal.login'));
        }
    }

    public function store(Request $request)
    {
        $completed = true;
        $url       = "";
        $order     = Order::find($request->order_id);

        foreach ($order->orderDetails as $order_detail) {
            $order_detail->complete = true;
            if (!$order_detail->update()) {
                $completed = false;
            }
        }

        if (!$order->update()) {
            $completed = false;
        }

        if ($request->method_payment != "online_payment") {
            $url = route('order.invoice', ['order' => $order]);
        }

        $res = [
            'success'  => $completed,
            'redirect' => $url,
        ];

        if ($completed) {
            return response()->json($res);
        } else {
            return back();
        }
    }

    public function invoice(Request $request, Order $order)
    {
        return view('portal.order.invoice', compact('order'));
    }

}
