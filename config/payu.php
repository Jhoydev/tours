<?php

return [
    'payu_url'         => env('PAYU_URL', 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu'),
    'payu_testing'     => env('PAYU_TESTING_ENV', true),
    'payu_merchant_id' => env('PAYU_MERCHANT_ID', '508029'),
    'payu_api_login'   => env('PAYU_API_LOGIN', 'pRRXKOl8ikMmt9u'),
    'payu_api_key'     => env('PAYU_API_KEY', '4Vj8eK4rloUd272L48hsrarnUA'),
    'payu_public_key'  => env('PAYU_PUBLIC_KEY', 'PKc62q90YnU881uz5OLZU1y1qo'),
    'payu_account_id'  => env('PAYU_ACCOUNT_ID', '512321'),
    'payu_country'     => env('PAYU_COUNTRY', 'CO'),
    'payu_currency'    => env('PAYU_COUNTRY', 'COP'),
    'pse_redirect_url' => env('PSE_REDIRECT_URL', '')
];
