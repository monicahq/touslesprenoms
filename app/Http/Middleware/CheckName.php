<?php

namespace App\Http\Middleware;

use App\Models\Name;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CheckName
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestedId = $request->route()->parameter('id');

        try {
            $name = Cache::remember('route-name-' . $requestedId, 604800, function () use ($requestedId) {
                return Name::findOrFail($requestedId);
            });

            $request->attributes->add(['name' => $name]);

            return $next($request);
        } catch (ModelNotFoundException) {
            return redirect()->route('home.index');
        }
    }
}
