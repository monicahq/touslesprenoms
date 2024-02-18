<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Pirsch\Facades\Pirsch;

class TrackPageview
{
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        if ($response instanceof RedirectResponse) {
            return $response;
        }

        // If app is down, don't track pageviews.
        if (app()->isDownForMaintenance()) {
            return $response;
        }

        Pirsch::track();

        return $response;
    }
}
