<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'brick' => [
        'client_id' => 'eyJpdiI6IncrVzFwYWhOZWlmWUlYVHo0TFBDMWc9PSIsInZhbHVlIjoiRWtDNEFvcS93S2ltSnIwU1ZhOE9ZZ0xwaytrWjlQNklYeEIrd090REtYNS9nS2M4OHJMcDQ0cHZmWjJSc2lRZSIsIm1hYyI6IjBjODY1OWM0ZmUyNmE3OGIxNTI2NDhiZDNmNzRjYzg0N2EwNzYyODUzMjFjZGI3MTFlOTczY2MyNjdiNTBjMDciLCJ0YWciOiIifQ==',
        'secret_id' => 'eyJpdiI6IjkrbDhFbEQ2Y0I5R090ajZ2ZjhFSWc9PSIsInZhbHVlIjoiTUl6bW8vUG90U1RJV1VPaUVPTHFuc3Z5Yit6aWdaQ0ZtVU42TXlaeVlURT0iLCJtYWMiOiIzYmRjN2I5MzIxN2VjYzQ0MDViZGYzMjU3YjgwNTlmZGU4MDU0YzI2MDZkNTQ0NjE4MTNjM2ViYjllMDg1M2M4IiwidGFnIjoiIn0=='
    ],
    'secretKeyBank' => [
        'secretKey' => 'Goe-Pos-2024',
    ],
    'secretKeyImage' => [
        'secretKey' => '530b0e821ca1bd5942da65355c12e45b',
    ],
    'serviceAccountKey' => [
        'secretKey' => env('FIREBASE_CREDENTIALS'),
    ]

];
