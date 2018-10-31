<?php

return [
    'payu_url'         => env('PAYU_URL', 'https://checkout.payulatam.com/ppp-web-gateway-payu'),
    'payu_testing'     => env('PAYU_TESTING_ENV', true),
    'payu_merchant_id' => env('PAYU_MERCHANT_ID', '709118'),
    'payu_api_login'   => env('PAYU_API_LOGIN', 'lv1Ge8WeK1g2k65'),
    'payu_api_key'     => env('PAYU_API_KEY', 'iHTz8i1ahcwg69jki2x4u9erhO'),
    'payu_public_key'  => env('PAYU_PUBLIC_KEY', 'PKc62q90YnU881uz5OLZU1y1qo'),
    'payu_account_id'  => env('PAYU_ACCOUNT_ID', '712451'),
    'payu_country'     => env('PAYU_COUNTRY', 'CO'),
    'payu_currency'    => env('PAYU_COUNTRY', 'COP'),
    'pse_redirect_url' => env('PSE_REDIRECT_URL', '')
];
