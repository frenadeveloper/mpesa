<?php

return [
    'sandbox_domain' => 'https://sandbox.safaricom.co.ke',

    'live_domain' => 'https://live.safaricom.co.ke',

    'env' => env('MPESA_ENV', 'sandbox'),

    'save_requests' => env('MPESA_SAVE_REQUESTS', false),

    'multi_app' => env('MPESA_MULTI_APP', false),

    'api_url' => env('MPESA_API_URL', ''),

    'consumer_key' => env('MPESA_COMSUMER_KEY', ''),

    'consumer_secret' => env('MPESA_COMSUMER_SECRET', ''),

    'short_codes' => [
        'c2b' => env('MPESA_C2B_SHORT_CODE', ''),
        'b2c' => env('MPESA_B2C_SHORT_CODE', ''),
        'bpb' => env('MPESA_BPB_SHORT_CODE', ''),
    ],

    'initiator' => [
        'name' => env('MPESA_INITIATOR_NAME', ''),
        'password' => env('MPESA_INITIATOR_PASSWORD', ''),
        'security_credential' => env('MPESA_SECURITY_CREDENTIAL', ''),
    ],

    'passkey' => env('MPESA_PASSKEY', ''),

    'apis' => [
        'auth' => [
            'endpoint_url' => 'oauth/v1/generate?grant_type=client_credentials'
        ],

        'c2b' => [
            'endpoint_url' => 'mpesa/c2b/v1/registerurl',
            'simulation_url' => 'mpesa/c2b/v1/simulate',
            'validation_url' => env('MPESA_C2B_VALIDATION_URL',''),
            'confirmation_url' => env('MPESA_C2B_CONFIRMATION_URL',''),
        ],

        'stkpush' => [
            'endpoint_url' => 'mpesa/stkpush/v1/processrequest',
            'query_url' => 'mpesa/stkpushquery/v1/query',
            'callback_url' => env('MPESA_STKPUSH_CALLBACK_URL',''),
        ],

        'transaction_status' => [
            'endpoint_url' => 'mpesa/transactionstatus/v1/query',
            'callback_url' => env('MPESA_TRANSACTION_STATUS_CALLBACK_URL',''),
            'timeout_url' => env('MPESA_TRANSACTION_STATUS_TIMEOUT_URL',''),
        ],

        'balance' => [
            'endpoint_url' => 'mpesa/accountbalance/v1/query',
            'callback_url' => env('MPESA_BALANCE_CALLBACK_URL',''),
            'timeout_url' => env('MPESA_BALANCE_TIMEOUT_URL',''),
        ],

        'b2c' => [
            'endpoint_url' => 'mpesa/b2c/v3/paymentrequest',
            'callback_url' => env('MPESA_B2C_CALLBACK_URL',''),
            'timeout_url' => env('MPESA_B2C_TIMEOUT_URL',''),
        ],

        'bpb' => [
            'endpoint_url' => 'mpesa/b2b/v1/paymentrequest',
            'callback_url' => env('MPESA_BPB_CALLBACK_URL',''),
            'timeout_url' => env('MPESA_BPB_TIMEOUT_URL',''),
        ],

        'bbg' => [
            'endpoint_url' => 'mpesa/b2b/v1/paymentrequest',
            'callback_url' => env('MPESA_BBG_CALLBACK_URL',''),
            'timeout_url' => env('MPESA_BBG_TIMEOUT_URL',''),
        ],

        'reversal' => [
            'endpoint_url' => 'mpesa/reversal/v1/request',
            'callback_url' => env('MPESA_REVERSAL_CALLBACK_URL',''),
            'timeout_url' => env('MPESA_REVERSAL_TIMEOUT_URL',''),
        ],

        'qr_code' => [
            'endpoint_url' => 'mpesa/qrcode/v1/generate'
        ],
    ],

];
