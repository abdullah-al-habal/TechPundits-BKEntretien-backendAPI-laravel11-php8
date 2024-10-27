<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\HomePage\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/home-page', action: [HomePageController::class, 'index']);
