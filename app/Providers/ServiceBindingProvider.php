<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\AuthServiceInterface;
use App\Contracts\FaqServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Faq\FaqService;
use Illuminate\Support\ServiceProvider;

class ServiceBindingProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(FaqServiceInterface::class, FaqService::class);
    }

    public function boot(): void {}
}
