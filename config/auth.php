<?php

return [



//    'driver' => 'eloquent',
//    'model' => App\User::class,
//    'table' => 'users',

    'multi-auth' => [
        'admin' => [
            'driver' => 'eloquent',
            'model'  => App\Admin::class,
            'table' => 'users'
        ],
        'agency' => [
            'driver' => 'eloquent',
            'model' => App\Agency::class,
            'table' => 'users'
        ],
        'user' => [
            'driver' => 'eloquent',
            'model'  => App\User::class,
            'table' => 'users'
        ],
    ],



    'password' => [
        'email' => 'emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],

];
