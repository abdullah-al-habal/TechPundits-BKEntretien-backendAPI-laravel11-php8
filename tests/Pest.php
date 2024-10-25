<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

uses(TestCase::class, RefreshDatabase::class)->in('Feature');
uses(TestCase::class)->in('Unit');

/*
|--------------------------------------------------------------------------
| Global Test Functions
|--------------------------------------------------------------------------
*/

function createTestUser(array $attributes = []): App\Models\User
{
    return App\Models\User::factory()->create($attributes);
}

/*
|--------------------------------------------------------------------------
| Custom Expectations
|--------------------------------------------------------------------------
*/

expect()->extend('toBeValidUser', function () {
    return $this->toBeInstanceOf(App\Models\User::class)
        ->and($this->value)
        ->name->toBeString()
        ->and($this->value->name)->not->toBeEmpty()
        ->and($this->value)
        ->email->toBeString()
        ->and($this->value->email)->toContain('@');
});

expect()->extend('toBeSuccessfulResponse', function () {
    return $this
        ->and($this->value->status())->toBe(200)
        ->and($this->value->header('content-type'))->toContain('application/json')
        ->and($this->value->json())->toBeArray();
});

/*
|--------------------------------------------------------------------------
| Dataset Providers
|--------------------------------------------------------------------------
*/

dataset('users', [
    'admin' => static fn () => ['name' => 'Admin User', 'email' => 'admin@example.com', 'role' => 'admin'],
    'regular' => static fn () => ['name' => 'Regular User', 'email' => 'user@example.com', 'role' => 'user'],
]);

dataset('invalid_inputs', [
    'empty_string' => '',
    'null' => null,
    'too_long' => str_repeat('a', 256),
    'special_chars' => '@#$%^&*()',
]);

/*
|--------------------------------------------------------------------------
| Global Test Hooks
|--------------------------------------------------------------------------
*/

uses()->beforeEach(static function (): void {
    // Clear cache before each test
    Illuminate\Support\Facades\Cache::flush();

    // Reset queued jobs
    Illuminate\Support\Facades\Queue::fake();

    // Reset event listeners
    Illuminate\Support\Facades\Event::fake();
})->afterEach(static function (): void {
    // Cleanup after each test
})->in(__DIR__);
