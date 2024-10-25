<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Http\Controllers\API\BaseApiController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

use function in_array;

class HealthCheckController extends BaseApiController
{
    public function __invoke(): JsonResponse
    {
        try {
            $checks = [
                'database' => $this->checkDatabase(),
                'cache' => $this->checkCache(),
                'storage' => $this->checkStorage(),
            ];

            if (config('app.check_redis', false)) {
                $checks['redis'] = $this->checkRedis();
            }

            if (config('app.external_api_url')) {
                $checks['external_api'] = $this->checkExternalApi();
            }

            $status = in_array(false, array_column($checks, 'status'), true) ? 503 : 200;

            return $this->sendResponse([
                'status' => $status === 200 ? 'healthy' : 'unhealthy',
                'checks' => $checks,
            ], SuccessCode::HEALTH_CHECK_COMPLETED, $status);
        } catch (Exception $e) {
            return $this->sendError('Health check failed', 500, ErrorCode::HEALTH_CHECK_FAILED, $e->getMessage());
        }
    }

    private function checkDatabase(): array
    {
        try {
            DB::connection()->getPdo();

            return [
                'status' => true,
                'message' => 'Database connection successful',
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Database connection failed',
                'error' => $e->getMessage(),
                'solution' => 'Check database credentials and ensure the database server is running.',
            ];
        }
    }

    private function checkCache(): array
    {
        try {
            Cache::store()->put('health_check_test', 'test', 10);
            $value = Cache::store()->get('health_check_test');
            if ($value !== 'test') {
                throw new Exception('Cache read/write test failed');
            }

            return [
                'status' => true,
                'message' => 'Cache is working correctly',
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Cache check failed',
                'error' => $e->getMessage(),
                'solution' => 'Verify cache configuration and ensure the cache service is running.',
            ];
        }
    }

    private function checkRedis(): array
    {
        try {
            Redis::set('health_check_test', 'test');
            $value = Redis::get('health_check_test');
            if ($value !== 'test') {
                throw new Exception('Redis read/write test failed');
            }

            return [
                'status' => true,
                'message' => 'Redis is working correctly',
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Redis check failed',
                'error' => $e->getMessage(),
                'solution' => 'Check Redis configuration and ensure the Redis server is running.',
            ];
        }
    }

    private function checkStorage(): array
    {
        try {
            Storage::put('health_check_test.txt', 'test');
            $contents = Storage::get('health_check_test.txt');
            Storage::delete('health_check_test.txt');
            if ($contents !== 'test') {
                throw new Exception('Storage read/write test failed');
            }

            return [
                'status' => true,
                'message' => 'File storage is working correctly',
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'File storage check failed',
                'error' => $e->getMessage(),
                'solution' => 'Verify storage configuration and ensure write permissions are set correctly.',
            ];
        }
    }

    private function checkExternalApi(): array
    {
        try {
            $apiUrl = config('app.external_api_url');
            if (! $apiUrl) {
                throw new Exception('External API URL is not configured');
            }
            $response = Http::get($apiUrl);
            if (! $response->successful()) {
                throw new Exception('API returned non-200 status code');
            }

            return [
                'status' => true,
                'message' => 'External API is accessible',
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'External API check failed',
                'error' => $e->getMessage(),
                'solution' => 'Verify API endpoint and check network connectivity.',
            ];
        }
    }
}
