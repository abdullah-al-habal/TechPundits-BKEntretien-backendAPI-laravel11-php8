<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class EnvValidator
{
    public static function validate()
    {
        $validator = Validator::make($_ENV, [
            'APP_NAME' => 'required|string',
            'APP_ENV' => 'required|in:local,production,staging',
            'APP_KEY' => 'required|string|size:32',
            'APP_DEBUG' => 'required|boolean',
            'APP_URL' => 'required|url',
            'APP_TIMEZONE' => 'required|string',
            'APP_LOCALE' => 'required|string',
            'APP_FALLBACK_LOCALE' => 'required|string',
            'APP_FAKER_LOCALE' => 'required|string',
            'APP_MAINTENANCE_DRIVER' => 'required|string',
            'APP_MAINTENANCE_STORE' => 'required|string',

            'BCRYPT_ROUNDS' => 'required|integer',

            'LOG_CHANNEL' => 'required|string',
            'LOG_STACK' => 'required|string',
            'LOG_DEPRECATIONS_CHANNEL' => 'nullable|string',
            'LOG_LEVEL' => 'required|string',

            'DB_CONNECTION' => 'required|string',
            'DB_HOST' => 'nullable|string',
            'DB_PORT' => 'nullable|integer',
            'DB_DATABASE' => 'nullable|string',
            'DB_USERNAME' => 'nullable|string',
            'DB_PASSWORD' => 'nullable|string',

            'SESSION_DRIVER' => 'required|string',
            'SESSION_LIFETIME' => 'required|integer',
            'SESSION_ENCRYPT' => 'required|boolean',
            'SESSION_PATH' => 'required|string',
            'SESSION_DOMAIN' => 'nullable|string',

            'BROADCAST_CONNECTION' => 'required|string',
            'FILESYSTEM_DISK' => 'required|string',
            'QUEUE_CONNECTION' => 'required|string',

            'CACHE_STORE' => 'required|string',
            'CACHE_PREFIX' => 'nullable|string',

            'MEMCACHED_HOST' => 'required|string',

            'REDIS_CLIENT' => 'required|string',
            'REDIS_HOST' => 'required|string',
            'REDIS_PASSWORD' => 'nullable|string',
            'REDIS_PORT' => 'required|integer',

            'MAIL_MAILER' => 'required|string',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|integer',
            'MAIL_USERNAME' => 'nullable|string',
            'MAIL_PASSWORD' => 'nullable|string',
            'MAIL_ENCRYPTION' => 'nullable|string',
            'MAIL_FROM_ADDRESS' => 'required|email',
            'MAIL_FROM_NAME' => 'required|string',

            'AWS_ACCESS_KEY_ID' => 'nullable|string',
            'AWS_SECRET_ACCESS_KEY' => 'nullable|string',
            'AWS_DEFAULT_REGION' => 'nullable|string',
            'AWS_BUCKET' => 'nullable|string',
            'AWS_USE_PATH_STYLE_ENDPOINT' => 'nullable|boolean',

            'VITE_APP_NAME' => 'required|string',

            'SANCTUM_STATEFUL_DOMAINS' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Environment configuration is invalid: '.json_encode($validator->errors()->all()));
        }
    }
}
