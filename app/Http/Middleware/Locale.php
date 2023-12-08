<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    protected Application $app;

    protected Request $request;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $this->app->setLocale(session('current_locale', auth()->user()->locale));
        } else {
            $this->app->setLocale(session('current_locale', config('app.locale')));
        }

        return $next($request);
    }
}
