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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
	
	'facebook' => [
        'client_id'=>getenv('FacebookAppId'),
        'client_secret'=>getenv('FacebookAppSecret'),
        //'client_version'=>'2.3',
        'redirect'=>getenv('FacebookAppRedirect'),
    ],

    'twitter' => [
        'client_id'=>getenv('TwitterAppKey'),
        'client_secret'=>getenv('TwitterAppSecret'),
        'redirect'=>getenv('TwitterAppRedirect'),
    ],

	'google' => [
		'client_id'=>getenv('GoogleAppKey'),
		'client_secret'=>getenv('GoogleAppSecret'),
		'redirect'=>getenv('GoogleAppRedirect'),
	]

];
