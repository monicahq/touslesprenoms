<?php

namespace App\Http\Middleware;

use App\Models\Name;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CheckLetter
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestedLetter = $request->route()->parameter('letter');

        // check if the requested letter is between A and Z and is exactly one character
        if (strlen($requestedLetter) > 1) {
            return redirect()->route('home.index');
        }

        if (!preg_match('/^[A-Za-z]+$/', $requestedLetter)) {
            return redirect()->route('home.index');
        }

        $request->attributes->add(['letter' => Str::lcfirst($requestedLetter)]);

        return $next($request);
    }
}
