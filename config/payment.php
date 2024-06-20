<?php
/**
 * 各ページのタイトルとリンク名定義
 */

return [

    'stripe' => [
        'api_key'     => env('STRIPE_SECRET_KEY'),
        'public_key'  => env('STRIPE_PUBLIC_KEY'),
        'api_version' => "2022-11-15",
    ],

    'currency' => 'jpy',

    'method_type' => [
        'card' => 'card'
    ],

];
