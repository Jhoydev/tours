<?php

namespace Alexo\LaravelPayU;

use InvalidArgumentException;
use Alexo\LaravelPayU\LaravelPayU;

trait Refundable
{

    /**
     * Refund order.
     *
     * @return array
     */
    public static function refundOrder(array $params = [], $onSuccess, $onError)
    {
        static::setPayUEnvironment();

        try {
            $params[\PayUParameters::TRANSACTION_ID] = $this->transaction_id;
            $params[\PayUParameters::ORDER_ID]       = $this->payu_order_id;

            $array = \PayUPayments::doRefund($params);
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
