<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SessionToken
{
    public function handle($request, Closure $next)
    {
        if ($request->has('session')) {
            Session::setId($request->get('session'));
            Session::start();
        }

        return $next($request);
    }
}
