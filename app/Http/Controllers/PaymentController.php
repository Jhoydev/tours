<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\MyLaravelPayU;
use App\Event;
use App\OrderDetail;
use App\Ticket;
use App\Order;

class PaymentController extends Controller
{

    protected $successPayment = false;
    protected $paymentErrors  = [];
    protected $res            = '';

    public function doPing()
    {
        MyLaravelPayU::doPing(function($response) {
            $code = $response->code;
            return response()->json($code);
        }, function($error) {
            array_push($this->paymentErrors, $error->getMessage());
        });
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

        return true;
    }

    public function reversedPaymentStatus(Request $request, $id)
    {
        $order = Order::find($id);

        return true;
    }

    public function confirmationAPIPayU(Request $request, $order_id)
    {
        Log::debug('PayU API.');
        $order = Order::find($order_id);

        if ($request->isMethod('post')) {
            $confirmation_data     = $request->all();
            $order->payu_order_id  = $confirmation_data['reference_sale'];
            $order->transaction_id = $confirmation_data['transaction_id'];

            switch ($confirmation_data['state_pol']) {
                case "4":
                    $order->order_status_id = 1;
                    break;

                case "5":
                case "6":
                case "7":
                    $order->order_status_id = 3;
                    break;

                default:
                    break;
            }

            foreach ($order->orderDetails as $order_detail) {
                $order_detail->complete = false;
                $order_detail->update();
            }

            $order->save();
        }

        return response()->json(['success' => true], 200);
    }

}
