<?php

declare(strict_types=1);

return [
    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS', storage_path('app/firebase/firebase_credentials.json')),
    ],
    'fcm' => [
        'sender_id' => env('FCM_SENDER_ID'),
        'server_key' => env('FCM_SERVER_KEY'),
    ],
];
