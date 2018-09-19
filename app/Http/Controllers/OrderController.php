<?php

namespace App\Http\Controllers;

use App\Event;
use App\Ticket;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alexo\LaravelPayU\LaravelPayU;

class OrderController extends Controller
{

    public function show(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $data          = $request->all();
            $arr_ticket_id = [];
            $data_ticket   = [];
            $ticket_id     = "";
            if ($arr_json      = json_decode($request->buy_json, 1)) {
                foreach ($arr_json as $li) {
                    $data_ticket[$li['id']]['qty'] = $li['qty'];
                    array_push($arr_ticket_id, $li['id']);
                }
                $tickets = Ticket::WhereIn('id', $arr_ticket_id)->get();
                $event   = Event::find($request->event_id);
                return view('portal.order.create', compact('tickets', 'data_ticket', 'data', 'event'));
            }
            return redirect(route('event.page', [$request->key_app, $request->page_id]));
        } else {
            return redirect(route('portal.login'));
        }
    }

    public function doPing(Request $request)
    {
        LaravelPayU::doPing(function($response) {
            $code = $response->code;
            // ... revisar el codigo de respuesta
        }, function($error) {
            // ... Manejo de errores PayUException
        });
    }

    public function getPSEBanks(Request $request)
    {
        LaravelPayU::getPSEBanks(function($banks) {
            //... Usar datos de bancos
            foreach ($banks as $bank) {
                $bankCode = $bank->pseCode;
            }
        }, function($error) {
            // ... Manejo de errores PayUException, InvalidArgument
        });
    }

    public function makePayment(Request $request, $id)
    {
        $order = Order::find($id);

        $data = [
            \PayUParameters::DESCRIPTION                 => 'Payment cc test', //descripcion
            \PayUParameters::IP_ADDRESS                  => '127.0.0.1', //ip
            \PayUParameters::CURRENCY                    => 'COP', //tipo de moneda
            \PayUParameters::CREDIT_CARD_NUMBER          => '378282246310005', //numero de tarjeta
            \PayUParameters::CREDIT_CARD_EXPIRATION_DATE => '2017/02', //fecha de expiracion
            \PayUParameters::CREDIT_CARD_SECURITY_CODE   => '1234', //codigo de seguridad
            \PayUParameters::INSTALLMENTS_NUMBER         => 1, //numero de cuotas
        ];

        $order->payWith($data, function($response, $order) {
            if ($response->code == 'SUCCESS') {
                $order->update([
                    'payu_order_id'  => $response->transactionResponse->orderId,
                    'transaction_id' => $response->transactionResponse->transactionId
                ]);
                // ... El resto de acciones sobre la orden
            } else {
                //... El código de respuesta no fue exitoso
            }
        }, function($error) {
            // ... Manejo de errores PayUException, InvalidArgument
        });
    }

    public function getPaymentStatus(Request $request, $id)
    {
        $order = Order::find($id);

        $order->searchById(function($response, $order) {
            // ... Usar la información de respuesta
        }, function($error) {
            // ... Manejo de errores PayUException, InvalidArgument
        });

        $order->searchByReference(function($response, $order) {
            // ... Usar la información de respuesta
        }, function($error) {
            // ... Manejo de errores PayUException, InvalidArgument
        });

        $order->searchByTransaction(function($response, $order) {
            // ... Usar la información de respuesta
        }, function($error) {
            // ... Manejo de errores PayUException, InvalidArgument
        });
    }

    public function reversePayment(Request $request, $id)
    {
        $order = Order::find($id);
    }

    public function reversedPaymentStatus(Request $request, $id)
    {
        $order = Order::find($id);
    }

}
