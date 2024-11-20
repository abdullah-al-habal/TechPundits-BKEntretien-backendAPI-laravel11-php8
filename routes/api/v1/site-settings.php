<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\SiteSetting\SiteSettingController;
use Illuminate\Support\Facades\Route;

Route::get('/site-settings', [SiteSettingController::class, 'index']);