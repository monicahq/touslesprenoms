<?php

namespace App\Http\Middleware;

use App\Models\NameList;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CheckList
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestedId = $request->route()->parameter('liste');

        try {
            $list = Cache::remember('route-list-' . $requestedId, 604800, function () use ($requestedId) {
                return NameList::findOrFail($requestedId);
            });

            if (! auth()->check() && ! $list->is_public) {
                return redirect()->route('home.index');
            }

            if (auth()->check() && ! $list->is_public) {
                if ($list->user_id !== auth()->id()) {
                    return redirect()->route('home.index');
                }
            }

            $request->attributes->add(['list' => $list]);

            return $next($request);
        } catch (ModelNotFoundException) {
            return redirect()->route('home.index');
        }
    }
}
