<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

Class MyLaravelPayU extends \Alexo\LaravelPayU\LaravelPayU
{

    /**
     * Get array of available Payment Methods.
     *
     * @return array
     */
    public static function getPaymentMethods($onSuccess, $onError)
    {
        static::setPayUEnvironment();

        try {
            $array = \PayUPayments::getPaymentMethods();

            if ($array) {
                $onSuccess($array->paymentMethods);
            }
        } catch (\PayUException $exc) {
            $onError($exc);
        } catch (InvalidArgumentException $exc) {
            $onError($exc);
        }
    }
    
}
