<?php
//writen by Riwash

return [
    'access_type' => env('ESEWA_ACCESS_TYPE', 'Test'),
    'website_url' => env('WEBSITE_URL'),
    'secret_key' => env('ESEWA_MERCHANT_ID', 'EPAYTEST'),
    'test_esewa_url' => 'https://uat.esewa.com.np/epay/main/?',
    'live_esewa_url' => 'https://esewa.com.np/epay/main/?',
];