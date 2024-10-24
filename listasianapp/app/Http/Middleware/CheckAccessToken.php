<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccessToken
{
    public function handle($request, Closure $next)
    {
        if (!config('services.vk.access_token')) {
            return response()->json(['error' => 'Access token not found'], 403);
        }

        return $next($request);
    }
}
