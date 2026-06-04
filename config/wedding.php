<?php

return [
    'admin_email' => env('WEDDING_ADMIN_EMAIL', 'victor.vencedor2005@gmail.com'),
    'admin_password' => env('WEDDING_ADMIN_PASSWORD', 'laura-victor-2026'),

    'asaas' => [
        'api_key' => env('ASAAS_API_KEY'),
        'environment' => env('ASAAS_ENV', 'sandbox'),
        'webhook_token' => env('ASAAS_WEBHOOK_TOKEN'),
    ],
];
