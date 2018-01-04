 <?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'sandboxe72cfd0e35f3448e8faee66a10911c19.mailgun.org',
        'secret' => 'key-48de58653136e7910f4b0c553afe2906',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],

    'google' => [
        'client_id' => '747977863578-kd078kmrnu9o745sosh2a61eao178nk2.apps.googleusercontent.com',
        'client_secret' => 'qcAk3a7ai6dWbnO_zGdHLaNb',
        'redirect' => 'http://localhost:8000/google_callback',
    ],

    'facebook' => [
        'client_id' => '1959522864322614',
        'client_secret' => '552f01c5aca8ad8513331ec5d1a352a6',
        'redirect' => 'https://4slash.com/callback',
    ]

];
