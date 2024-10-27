<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\ApiExceptionHandler;
use Closure;
use Illuminate\Http\Request;
use Throwable;

class HandleApiExceptions
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Throwable $e) {
            return app(ApiExceptionHandler::class)->handle($e, $request);
        }
    }
}
