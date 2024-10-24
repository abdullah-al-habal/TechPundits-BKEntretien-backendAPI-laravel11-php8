<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // if (!$this->app->environment('production')) {
        //     EnvValidator::validate();
        // }

        Password::defaults(function () {
            $password = Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols();

            return app()->environment('production') ? $password->uncompromised() : $password;
        });

        $this->configureDatabase();
        $this->configureModels();
        $this->configurePasswordValidation();
        $this->configureDates();
    }

    protected function configureDatabase(): void
    {
        if (app()->environment('production')) {
            DB::prohibitDestructiveCommands();
        }
    }

    protected function configureModels(): void
    {
        Model::preventLazyLoading(! app()->environment('production'));
        Model::shouldBeStrict(! app()->environment('production'));
        Model::unguard();
    }

    protected function configurePasswordValidation(): void
    {
        // Password validation is now handled in the boot method
    }

    protected function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
