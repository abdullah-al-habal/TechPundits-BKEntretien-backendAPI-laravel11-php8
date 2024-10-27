<?php

declare(strict_types=1);

namespace App\Providers;

use App\Exceptions\ApiExceptionHandler;
use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ApiExceptionHandler::class);
    }

    public function boot(): void {}
}
