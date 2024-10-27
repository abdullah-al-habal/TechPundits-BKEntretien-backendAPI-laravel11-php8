<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Constants\HealthCheckMessages;
use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\HealthCheckException;
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
    /**
     * @OA\Get(
     *     path="/api/health",
     *     summary="Health check",
     *     description="Check the health status of various system components",
     *     operationId="healthCheck",
     *     tags={"System"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful health check",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="status", type="string", enum={"healthy", "unhealthy"}),
     *             @OA\Property(
     *                 property="checks",
     *                 type="object",
     *                 @OA\Property(property="database", type="object"),
     *                 @OA\Property(property="cache", type="object"),
     *                 @OA\Property(property="storage", type="object"),
     *                 @OA\Property(property="redis", type="object"),
     *                 @OA\Property(property="external_api", type="object")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=503,
     *         description="Service Unavailable",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="status", type="string", enum={"unhealthy"}),
     *             @OA\Property(property="checks", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
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

            if ($status === 503) {
                throw new HealthCheckException($checks);
            }

            return $this->successResponse(
                [
                    'status' => HealthCheckMessages::HEALTHY,
                    'checks' => $checks,
                ],
                null,
                $status,
                null,
                SuccessCode::HEALTH_CHECK_COMPLETED
            );
        } catch (HealthCheckException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getHttpStatus(),
                ['checks' => $e->getData()],
                $e->getErrorCode()
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                HttpStatusCodesEnum::INTERNAL_SERVER_ERROR,
                null,
                ErrorCode::HEALTH_CHECK_FAILED
            );
        }
    }

    private function checkDatabase(): array
    {
        try {
            DB::connection()->getPdo();

            return [
                'status' => true,
                'message' => HealthCheckMessages::DATABASE_CONNECTION_SUCCESS,
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => HealthCheckMessages::DATABASE_CONNECTION_FAILED,
                'error' => $e->getMessage(),
                'solution' => HealthCheckMessages::DATABASE_SOLUTION,
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
                'message' => HealthCheckMessages::CACHE_WORKING,
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => HealthCheckMessages::CACHE_CHECK_FAILED,
                'error' => $e->getMessage(),
                'solution' => HealthCheckMessages::CACHE_SOLUTION,
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
                'message' => HealthCheckMessages::REDIS_WORKING,
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => HealthCheckMessages::REDIS_CHECK_FAILED,
                'error' => $e->getMessage(),
                'solution' => HealthCheckMessages::REDIS_SOLUTION,
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
                'message' => HealthCheckMessages::STORAGE_WORKING,
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => HealthCheckMessages::STORAGE_CHECK_FAILED,
                'error' => $e->getMessage(),
                'solution' => HealthCheckMessages::STORAGE_SOLUTION,
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
                'message' => HealthCheckMessages::EXTERNAL_API_ACCESSIBLE,
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => HealthCheckMessages::EXTERNAL_API_CHECK_FAILED,
                'error' => $e->getMessage(),
                'solution' => HealthCheckMessages::EXTERNAL_API_SOLUTION,
            ];
        }
    }
}
