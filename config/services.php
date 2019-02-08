<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    'google' => [
        'client_id' => '166445815620-tam31e4vl6vbq8cjrldp3e4hs1c6con3.apps.googleusercontent.com',         // Your google Client ID
        'client_secret' => 'VO_TKX2F8zu3UfkJT5JLzXTC', // Your google Client Secret
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],
    'twitter' => [
        'client_id' => 'Ckfb1kVlV0LzsON8czSJoOTea',         // Your google Client ID
        'client_secret' => 'Spr4PkGW24zQF5oneocBNYrypRqGARnyte2SLXYAU2J1eqYdCo', // Your twitter Client Secret
        'redirect' => 'http://localhost:8000/login/twitter/callback',
    ],
];
