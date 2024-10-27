<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\Notification\NotificationController;
use Illuminate\Support\Facades\Route;

Route::put('update-device-token', [NotificationController::class, 'updateDeviceToken']);
Route::post('send-fcm-notification', [NotificationController::class, 'send']);
