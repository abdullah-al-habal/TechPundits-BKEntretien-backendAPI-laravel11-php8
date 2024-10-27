<?php

declare(strict_types=1);

use App\Enums\SuccessCode;
use App\Constants\SuccessMessages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

it('returns healthy status when all checks pass', function (): void {
    // Mock all the checks to return true
    $this->mock(DB::class)->shouldReceive('connection->getPdo')->andReturn(true);
    $this->mock(Cache::class)->shouldReceive('store->put')->andReturn(true);
    $this->mock(Cache::class)->shouldReceive('store->get')->andReturn('test');
    $this->mock(Redis::class)->shouldReceive('set')->andReturn(true);
    $this->mock(Redis::class)->shouldReceive('get')->andReturn('test');
    $this->mock(Storage::class)->shouldReceive('put')->andReturn(true);
    $this->mock(Storage::class)->shouldReceive('get')->andReturn('test');
    $this->mock(Storage::class)->shouldReceive('delete')->andReturn(true);
    Http::fake(['https://api.example.com/health' => Http::response([], 200)]);

    $response = $this->get('/api/health');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'data' => [
                'status' => 'healthy',
                'checks' => [
                    'database' => ['status' => true],
                    'cache' => ['status' => true],
                    'redis' => ['status' => true],
                    'storage' => ['status' => true],
                    'external_api' => ['status' => true],
                ],
            ],
            'status' => 200,
            'message' => SuccessMessages::getMessage(SuccessCode::HEALTH_CHECK_COMPLETED),
            'success_code' => SuccessCode::HEALTH_CHECK_COMPLETED->value,
        ]);
});

it('returns unhealthy status when any check fails', function (): void {
    // Mock one of the checks to fail
    $this->mock(DB::class)->shouldReceive('connection->getPdo')->andThrow(new Exception('Database connection failed'));

    $response = $this->get('/api/health');

    $response->assertStatus(503)
        ->assertJson([
            'success' => true,
            'data' => [
                'status' => 'unhealthy',
                'checks' => [
                    'database' => [
                        'status' => false,
                        'message' => 'Database connection failed',
                    ],
                ],
            ],
            'status' => 503,
        ]);
});
