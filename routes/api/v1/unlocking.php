<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\Unlocking\UnlockingController;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/unlocking', action: [UnlockingController::class, 'index']);
