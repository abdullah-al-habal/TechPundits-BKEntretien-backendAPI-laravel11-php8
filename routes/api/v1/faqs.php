<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\Faq\FaqController;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/faqs', action: [FaqController::class, 'index']);
