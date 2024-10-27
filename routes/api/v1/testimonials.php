<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\Testimonial\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/testimonials', action: [TestimonialController::class, 'index']);
