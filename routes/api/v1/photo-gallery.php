<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\PhotoGallery\PhotoGalleryController;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/photo-gallery', action: [PhotoGalleryController::class, 'index']);