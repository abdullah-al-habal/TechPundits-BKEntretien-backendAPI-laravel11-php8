<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\EnvValidator;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use RuntimeException;

use function sprintf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // if ($this->app->environment('local')) {
        //     $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        //     $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        // }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $this->validateEnvironment();
        $this->configureApplication();
        $this->configureDatabase();
        $this->configureModels();
        $this->configureAuth();
        $this->configurePagination();
        $this->configurePerformanceMonitoring();

        if ($this->app->environment('production')) {
            $this->configureProduction();
        }
    }

    /**
     * Validate environment configuration.
     */
    protected function validateEnvironment(): void
    {
        if (! $this->app->environment('production')) {
            try {
                EnvValidator::validate();
            } catch (RuntimeException $e) {
                logger()->error('Environment validation failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                if ($this->app->environment('local')) {
                    throw $e;
                }
            }
        }
    }

    /**
     * Configure general application settings.
     */
    protected function configureApplication(): void
    {
        // Set default string length for MySQL older versions
        Schema::defaultStringLength(191);

        // Use CarbonImmutable for dates
        Date::use(CarbonImmutable::class);

        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Share common data with all views
        View::share('appName', config('app.name'));
        View::share('appVersion', config('app.version'));
    }

    /**
     * Configure database settings and monitoring.
     */
    protected function configureDatabase(): void
    {
        // Enable query logging in local environment
        if ($this->app->environment('local')) {
            DB::listen(static function (QueryExecuted $query): void {
                Log::channel('queries')->info(sprintf(
                    '[%s ms] %s %s',
                    $query->time,
                    $query->sql,
                    json_encode($query->bindings)
                ));
            });
        }

        // Monitor slow queries in production
        if ($this->app->environment('production')) {
            DB::listen(static function (QueryExecuted $query): void {
                if ($query->time > 1000) {
                    Log::warning('Slow query detected', [
                        'sql' => $query->sql,
                        'time' => $query->time,
                        'connection' => $query->connectionName,
                    ]);
                }
            });
        }
    }

    /**
     * Configure Eloquent models.
     */
    protected function configureModels(): void
    {
        Model::preventLazyLoading(! app()->environment('production'));
        Model::shouldBeStrict(! app()->environment('production'));
        Model::preventSilentlyDiscardingAttributes(! app()->environment('production'));
        Model::preventAccessingMissingAttributes(! app()->environment('production'));

        Relation::enforceMorphMap([
            // Define your morph maps here
            // 'user' => \App\Models\User::class,
        ]);

        Model::unguard();
    }

    /**
     * Configure authentication and password rules.
     */
    protected function configureAuth(): void
    {
        Password::defaults(function () {
            $password = Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();

            return $this->app->environment('production')
                ? $password
                : $password->min(6);
        });
    }

    /**
     * Configure pagination.
     */
    protected function configurePagination(): void
    {
        // Add custom pagination macro
        // Collection::macro('paginate', function ($perPage = 15, $total = null, $page = null, $pageName = 'page') {
        //     $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

        //     return new LengthAwarePaginator(
        //         $this->forPage($page, $perPage),
        //         $total ?: $this->count(),
        //         $perPage,
        //         $page,
        //         [
        //             'path' => LengthAwarePaginator::resolveCurrentPath(),
        //             'pageName' => $pageName,
        //         ]
        //     );
        // });
    }

    /**
     * Configure performance monitoring.
     */
    protected function configurePerformanceMonitoring(): void
    {
        if ($this->app->environment('production')) {
            // Cache frequently accessed data
            Cache::remember('app_settings', now()->addDay(), static fn () => []);
        }
    }

    /**
     * Configure production-specific settings.
     */
    protected function configureProduction(): void
    {
        // Prevent destructive commands in production
        DB::preventDestructiveMigrations();
        DB::preventLazyLoading();

        // Enable HTTP/2 Server Push
        // $this->app['router']->middlewareGroup('web', [
        //     \Illuminate\Http\Middleware\AddLinkHeadersMiddleware::class,
        // ]);

        // Additional security headers
        // $this->app['router']->middlewareGroup('web', [
        //     \App\Http\Middleware\SecurityHeaders::class,
        // ]);
    }
}
