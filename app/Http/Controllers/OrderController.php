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
                $order->order_status_id = 1;
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
                        OrderDetail::addDetail($ticket,$order,$customer_id);
                    }

                }
                $tickets = Ticket::WhereIn('id', $arr_ticket_id)->get();

                $order->value = $order_value;
                $order->update();

                return view('portal.order.create', compact('tickets', 'data_ticket', 'data', 'event'));
            }
            return redirect(route('event.page', [$request->key_app, $request->page_id]));
        } else {
            return redirect(route('portal.login'));
        }
    }

    public function doPing()
    {
        MyLaravelPayU::doPing(function($response) {
            $code = $response->code;
            return response()->json($code);
        }, function($error) {
            array_push($this->paymentErrors, $error->getMessage());
        });
    }

    public function getPSEBanks()
    {
        MyLaravelPayU::getPSEBanks(function($banks) {
            //... Usar datos de bancos
            $arrBanks = array();
            foreach ($banks as $bank) {
                $arrBanks[$bank->pseCode] = $bank->description;
            }

            return response()->json($arrBanks);
        }, function($error) {
            array_push($this->paymentErrors, $error->getMessage());
        });
    }

    public function getPaymentMethods()
    {
        MyLaravelPayU::getPaymentMethods(function($methods) {
            //... Usar datos de bancos
            $arrMethods = array();
            foreach ($methods as $method) {
                $arrMethods[$method->id] = $method->description;
            }

            return response()->json($arrMethods);
        }, function($error) {
            array_push($this->paymentErrors, $error->getMessage());
        });
    }

    public function makePayment(Request $request)
    {
        $order = new Order;

        $order->reference = uniqid();
        $order->status_id = 2; // Pending Status
        $order->value     = $request->input('value');
        $order->save();
        $session          = md5('joinapp.com');

        $data = [
            \PayUParameters::DESCRIPTION                 => 'Payment cc test',
            \PayUParameters::IP_ADDRESS                  => '127.0.0.1',
            \PayUParameters::USER_AGENT                  => $_SERVER['HTTP_USER_AGENT'],
            \PayUParameters::CURRENCY                    => 'COP',
            \PayUParameters::VALUE                       => $order->value,
            \PayUParameters::PAYER_COOKIE                => 'cookie_' . time(),
            \PayUParameters::REFERENCE_CODE              => $order->reference,
            \PayUParameters::DEVICE_SESSION_ID           => session_id($session),
            // Card Information 
            \PayUParameters::PAYMENT_METHOD              => $request->input('card_name'),
            \PayUParameters::CREDIT_CARD_NUMBER          => $request->input('card_number'),
            \PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $request->input('expiration_date'),
            \PayUParameters::CREDIT_CARD_SECURITY_CODE   => $request->input('card_cvc'),
            \PayUParameters::INSTALLMENTS_NUMBER         => $request->input('installments'),
            \PayUParameters::PAYER_NAME                  => $request->input('payer_name'),
            // Payer Information
            \PayUParameters::PAYER_EMAIL                 => $request->input('payer_email'),
            \PayUParameters::PAYER_DNI                   => $request->input('payer_dni'),
            \PayUParameters::PAYER_CONTACT_PHONE         => $request->input('payer_phone'),
        ];

        $order->payWith($data, function($response, $order) {
            if ($response->code == 'SUCCESS') {
                $order->payu_order_id  = $response->transactionResponse->orderId;
                $order->transaction_id = $response->transactionResponse->transactionId;
                $order->state          = 1;
                $order->save();

                $this->successPayment = true;
                // ... El resto de acciones sobre la orden
            } else {
                //... El código de respuesta no fue exitoso
            }
        }, function($error) {
            array_push($this->paymentErrors, $error->getMessage());
        });

        if ($this->paymentErrors) {
            return back()->with('errors', $this->paymentErrors);
        }

        return back()->with('status', 'Se ha pagado exitosamente');
    }

    public function getPaymentStatus(Request $request, $id)
    {
        $order = Order::find($id);

        $order->searchById(function($response, $order) {
            // ... Usar la información de respuesta
        }, function($error) {
            array_push($this->paymentErrors, $error->getMessage());
        });

        $order->searchByReference(function($response, $order) {
            // ... Usar la información de respuesta
        }, function($error) {
            array_push($this->paymentErrors, $error->getMessage());
        });

        $order->searchByTransaction(function($response, $order) {
            // ... Usar la información de respuesta
        }, function($error) {
            array_push($this->paymentErrors, $error->getMessage());
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
