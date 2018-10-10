<?php

namespace Alexo\LaravelPayU;

use InvalidArgumentException;
use Alexo\LaravelPayU\LaravelPayU;

trait Cancelable
{
    /*
     * Cancel order.
     *
     * @return array
     */

    public static function voidOrder(array $params = [], $onSuccess, $onError)
    {
        static::setPayUEnvironment();

        try {
            $params[\PayUParameters::TRANSACTION_ID] = $this->transaction_id;
            $params[\PayUParameters::ORDER_ID]       = $this->payu_order_id;

            $array = \PayUPayments::doVoid($params);
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
