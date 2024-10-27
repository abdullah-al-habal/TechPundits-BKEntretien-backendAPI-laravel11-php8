<?php

declare(strict_types=1);

namespace App\Constants;

class HealthCheckMessages
{
    public const HEALTH_CHECK_SUCCESS = 'Good news! Our system health check is complete and everything looks great.';

    public const HEALTH_CHECK_FAILED = 'Our system health check encountered some issues. We\'re looking into it to ensure everything runs smoothly.';

    public const DATABASE_CONNECTION_SUCCESS = 'Database connection successful';

    public const DATABASE_CONNECTION_FAILED = 'Database connection failed';

    public const DATABASE_SOLUTION = 'Check database credentials and ensure the database server is running.';

    public const CACHE_WORKING = 'Cache is working correctly';

    public const CACHE_CHECK_FAILED = 'Cache check failed';

    public const CACHE_SOLUTION = 'Verify cache configuration and ensure the cache service is running.';

    public const REDIS_WORKING = 'Redis is working correctly';

    public const REDIS_CHECK_FAILED = 'Redis check failed';

    public const REDIS_SOLUTION = 'Check Redis configuration and ensure the Redis server is running.';

    public const STORAGE_WORKING = 'File storage is working correctly';

    public const STORAGE_CHECK_FAILED = 'File storage check failed';

    public const STORAGE_SOLUTION = 'Verify storage configuration and ensure write permissions are set correctly.';

    public const EXTERNAL_API_ACCESSIBLE = 'External API is accessible';

    public const EXTERNAL_API_CHECK_FAILED = 'External API check failed';

    public const EXTERNAL_API_SOLUTION = 'Verify API endpoint and check network connectivity.';

    public const HEALTHY = 'healthy';

    public const UNHEALTHY = 'unhealthy';
}
