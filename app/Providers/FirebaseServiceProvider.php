<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Firebase\FirebaseService;
use App\Services\Notification\NotificationService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FirebaseService::class, static function ($app) {
            return new FirebaseService(
                new Client(),
                config('firebase.credentials.file')
            );
        });

        $this->app->singleton(NotificationService::class, static function ($app) {
            return new NotificationService(
                $app->make(FirebaseService::class)
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/firebase.php' => config_path('firebase.php'),
        ], 'config');
    }
}
