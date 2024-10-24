<?php

declare(strict_types=1);

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\V1\ContactUs\ContactUsController;
use App\Http\Controllers\API\V1\DrainCleaning\DrainCleaningController;
use App\Http\Controllers\API\V1\Faq\FaqController;
use App\Http\Controllers\API\V1\HomePage\HomePageController;
use App\Http\Controllers\API\V1\PhotoGallery\PhotoGalleryController;
use App\Http\Controllers\API\V1\SiteSetting\SiteSettingController;
use App\Http\Controllers\API\V1\Testimonial\TestimonialController;
use App\Http\Controllers\API\V1\Unlocking\UnlockingController;
use Illuminate\Support\Facades\Route;

Route::post(uri: '/login', action: [LoginController::class, 'login']);
Route::post(uri: '/register', action: [RegisterController::class, 'register']);

Route::prefix('v1')->group(callback: static function (): void {
    Route::get(uri: '/site-settings', action: [SiteSettingController::class, 'index']);
    Route::get(uri: '/contact-us', action: [ContactUsController::class, 'index']);
    Route::get(uri: '/testimonials', action: [TestimonialController::class, 'index']);
    Route::get(uri: '/photo-gallery', action: [PhotoGalleryController::class, 'index']);
    Route::get(uri: '/drain-cleaning', action: [DrainCleaningController::class, 'index']);
    Route::get(uri: '/unlocking', action: [UnlockingController::class, 'index']);
    Route::get(uri: '/home-page', action: [HomePageController::class, 'index']);
    Route::get(uri: '/faqs', action: [FaqController::class, 'index']);
});

Route::middleware(['auth:sanctum'])->group(static function (): void {
    Route::post(uri: '/logout', action: [LogoutController::class, 'logout']);
});
