<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyLaravelPayU;
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
    }

    public function reversedPaymentStatus(Request $request, $id)
    {
        $order = Order::find($id);
    }

}
