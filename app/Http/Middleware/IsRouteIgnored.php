<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Attributes\Ignore;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use function in_array;

use ReflectionMethod;
use Symfony\Component\HttpFoundation\Response;

class IsRouteIgnored
{
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();

        if (! ($route instanceof Route) || $route->action['uses'] instanceof Closure) {
            return $next($request);
        }

        $reflection = new ReflectionMethod($route->getControllerClass(), $route->getActionMethod());

        $attributes = $reflection->getAttributes(Ignore::class);

        if (! empty($attributes) && in_array(config('app.env'), $attributes[0]->newInstance()->in, true)) {
            abort(404);
        }

        return $next($request);
    }
}
