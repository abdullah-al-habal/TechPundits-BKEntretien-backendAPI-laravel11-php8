<?php

declare(strict_types=1);

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\HealthCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/health', HealthCheckController::class);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(static function (): void {
    Route::post('/logout', [LogoutController::class, 'logout']);
});

require __DIR__ . '/api/v1/routes.php';
