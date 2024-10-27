<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class EnvValidator
{
    /**
     * Validate the environment configuration.
     *
     * @throws RuntimeException
     * @throws ValidationException
     */
    public static function validate(): void
    {
        try {
            $envData = collect(static::rules())
                ->mapWithKeys(static fn ($rule, $key) => [$key => env($key)])
                ->toArray();

            $validator = Validator::make($envData, static::rules(), static::messages());

            if ($validator->fails()) {
                $errors = collect($validator->errors()->all())
                    ->map(static fn ($error) => "- \"{$error}\"")
                    ->join(PHP_EOL);

                throw new RuntimeException(
                    'Environment configuration validation failed:'.PHP_EOL.$errors
                );
            }

            static::validateAdditionalRequirements();
        } catch (ValidationException $e) {
            throw new RuntimeException(
                'Environment validation failed: '.$e->getMessage()
            );
        }
    }

    /**
     * @return array<string, string>
     */
    protected static function rules(): array
    {
        return [
            // Application
            'APP_NAME' => 'required|string',
            'APP_ENV' => 'required|in:local,production,staging,testing',
            'APP_KEY' => [
                'required',
                'string',
            ],
            'APP_DEBUG' => 'required|boolean',
            'APP_URL' => 'required|url',
            'APP_VERSION' => 'required|string',
            'APP_TIMEZONE' => 'required|string|timezone',
            'APP_LOCALE' => 'required|string|size:2',
            'APP_FALLBACK_LOCALE' => 'required|string|size:2',
            'APP_FAKER_LOCALE' => 'required|string',

            // Maintenance
            'APP_MAINTENANCE_DRIVER' => 'required|string',
            'APP_MAINTENANCE_STORE' => 'required|string',

            // Security
            'BCRYPT_ROUNDS' => 'required|integer|between:4,31',

            // Logging
            'LOG_CHANNEL' => 'required|string|in:stack,single,daily,slack,stderr,syslog,errorlog,null',
            'LOG_STACK' => 'required|string',
            'LOG_DEPRECATIONS_CHANNEL' => 'nullable|string',
            'LOG_LEVEL' => 'required|string|in:debug,info,notice,warning,error,critical,alert,emergency',

            // Database
            'DB_CONNECTION' => 'required|string|in:mysql,pgsql,sqlite,sqlsrv',
            'DB_HOST' => 'required_unless:DB_CONNECTION,sqlite|string',
            'DB_PORT' => 'required_unless:DB_CONNECTION,sqlite|integer',
            'DB_DATABASE' => 'required|string',
            'DB_USERNAME' => 'required_unless:DB_CONNECTION,sqlite|string',
            // 'DB_PASSWORD' => 'required_unless:DB_CONNECTION,sqlite|string',
            'DB_PASSWORD' => 'nullable|string',
            'TEST_DB_DATABASE' => 'required|string',

            // Session
            'SESSION_DRIVER' => 'required|string|in:file,cookie,database,apc,memcached,redis,dynamodb,array',
            'SESSION_LIFETIME' => 'required|integer|min:1',
            'SESSION_ENCRYPT' => 'required|boolean',
            'SESSION_PATH' => 'required|string',
            'SESSION_DOMAIN' => 'nullable|string',
            'SESSION_SECURE_COOKIE' => 'required|boolean',

            // Cache
            'CACHE_DRIVER' => 'required|string|in:apc,array,database,file,memcached,redis,dynamodb,octane,null',
            'CACHE_PREFIX' => 'nullable|string',
            'CACHE_TTL' => 'required|integer',

            // Queue
            'QUEUE_CONNECTION' => 'required|string|in:sync,database,beanstalkd,sqs,redis,null',
            'QUEUE_FAILED_DRIVER' => 'required|string',

            // Broadcasting
            'BROADCAST_DRIVER' => 'required|string',
            'PUSHER_APP_ID' => 'nullable|string',
            'PUSHER_APP_KEY' => 'nullable|string',
            'PUSHER_APP_SECRET' => 'nullable|string',
            'PUSHER_HOST' => 'nullable|string',
            'PUSHER_PORT' => 'nullable|integer',
            'PUSHER_SCHEME' => 'nullable|string',
            'PUSHER_APP_CLUSTER' => 'nullable|string',

            // Storage
            'FILESYSTEM_DISK' => 'required|string|in:local,public,s3,ftp',

            // Redis
            'REDIS_CLIENT' => 'required|string|in:phpredis,predis',
            'REDIS_HOST' => 'required|string',
            'REDIS_PASSWORD' => 'nullable|string',
            'REDIS_PORT' => 'required|integer|between:1,65535',

            // Mail
            'MAIL_MAILER' => 'required|string|in:smtp,sendmail,mailgun,ses,postmark,log,array',
            'MAIL_HOST' => 'required_if:MAIL_MAILER,smtp|string',
            'MAIL_PORT' => 'required_if:MAIL_MAILER,smtp|integer|between:1,65535',
            'MAIL_USERNAME' => 'nullable|string',
            'MAIL_PASSWORD' => 'nullable|string',
            'MAIL_ENCRYPTION' => 'nullable|string|in:tls,ssl,null',
            'MAIL_FROM_ADDRESS' => 'required|email',
            'MAIL_FROM_NAME' => 'required|string',

            // AWS
            'AWS_ACCESS_KEY_ID' => 'required_if:FILESYSTEM_DISK,s3|string',
            'AWS_SECRET_ACCESS_KEY' => 'required_if:FILESYSTEM_DISK,s3|string',
            'AWS_DEFAULT_REGION' => 'required_if:FILESYSTEM_DISK,s3|string',
            'AWS_BUCKET' => 'required_if:FILESYSTEM_DISK,s3|string',
            'AWS_USE_PATH_STYLE_ENDPOINT' => 'nullable|boolean',

            // Frontend
            'VITE_APP_NAME' => 'required|string',

            // API & Auth
            'SANCTUM_STATEFUL_DOMAINS' => 'required|string',

            // Monitoring & Debugging
            'TELESCOPE_ENABLED' => 'required|boolean',
            'DEBUGBAR_ENABLED' => 'required|boolean',

            // Rate Limiting
            'RATE_LIMIT_ENABLED' => 'required|boolean',
            'RATE_LIMIT_ATTEMPTS' => 'required|integer',
            'RATE_LIMIT_DECAY_MINUTES' => 'required|integer',

            // Feature Flags
            'FEATURE_REGISTRATION' => 'required|boolean',
            'FEATURE_SOCIAL_LOGIN' => 'required|boolean',
            'FEATURE_API' => 'required|boolean',

            // Additional Services
            'SCOUT_DRIVER' => 'nullable|string',
            'MEMCACHED_HOST' => 'required|string',

            // External API and Redis Check Settings
            'EXTERNAL_API_URL' => 'nullable|url',
            'CHECK_REDIS' => 'required|boolean',
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    protected static function messages(): array
    {
        return [
            'DB_CONNECTION.in' => 'The database connection must be one of: mysql, pgsql, sqlite, sqlsrv',
            'LOG_LEVEL.in' => 'The log level must be one of: debug, info, notice, warning, error, critical, alert, emergency',
            'MAIL_MAILER.in' => 'The mail driver must be one of: smtp, sendmail, mailgun, ses, postmark, log, array',
            'APP_TIMEZONE.timezone' => 'The timezone must be a valid PHP timezone identifier',
        ];
    }

    /**
     * Validate additional requirements that cannot be handled by the validator.
     *
     * @throws RuntimeException
     */
    protected static function validateAdditionalRequirements(): void
    {
        // Validate APP_KEY format
        // if (!preg_match('/^base64:[\w+\/=]{43}$/', env('APP_KEY', '')) && strlen(env('APP_KEY', '')) !== 32) {
        //     throw new RuntimeException('APP_KEY must be exactly 32 characters or a valid base64 encoded key');
        // }

        // Validate database configuration
        if (env('DB_CONNECTION') === 'sqlite') {
            $database = env('DB_DATABASE');
            if (! file_exists($database) && $database !== ':memory:') {
                throw new RuntimeException("SQLite database file does not exist: {$database}");
            }
        }

        // Validate SSL certificate if using HTTPS
        if (str_starts_with(strtolower(env('APP_URL')), 'https://')) {
            static::validateSslConfiguration();
        }
    }

    /**
     * Validate SSL configuration when using HTTPS.
     *
     * @throws RuntimeException
     */
    protected static function validateSslConfiguration(): void
    {
        // Additional SSL checks can be implemented here
        if (env('SESSION_SECURE_COOKIE') !== true) {
            throw new RuntimeException('SESSION_SECURE_COOKIE must be true when using HTTPS');
        }
    }
}
