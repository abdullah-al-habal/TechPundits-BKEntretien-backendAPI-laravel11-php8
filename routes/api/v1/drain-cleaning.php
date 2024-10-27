<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\DrainCleaning\DrainCleaningController;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/drain-cleaning', action: [DrainCleaningController::class, 'index']);
