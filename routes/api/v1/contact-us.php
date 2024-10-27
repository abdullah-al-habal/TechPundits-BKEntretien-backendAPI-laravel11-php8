<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\ContactUs\ContactUsController;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/contact-us', action: [ContactUsController::class, 'index']);
