<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Shipment Api Key
    |--------------------------------------------------------------------------
    |
    | This value is the key of your shipment cost check.
    |
    */

    'api_key' => env('RAJA_ONGKIR_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Application Shipment Account Type
    |--------------------------------------------------------------------------
    |
    | This value is the account type of your shipment api
    |
    */

    'account_type' => env('RAJA_ONGKIR_ACCOUNT_TYPE', ''),

    /*
    |--------------------------------------------------------------------------
    | Shipment Origin Id
    |--------------------------------------------------------------------------
    |
    | This value is the origin id of shop city, this value is get from city_id
    | when we are request to rajaongkir API
    |
    */

    'shipment_origin_city_id' => 114,
];
