<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SessionToken
{
    public function handle($request, Closure $next)
    {
        if ($request->has('session')) {
             // Récupérer le token de session à partir de l'URL
             $sessionToken = $request->session;

             // Récupérer l'élément après 'c/'
             $sessionToken = substr($sessionToken, strpos($sessionToken, "c/") + 2);
             dd($sessionToken)
             Session::setId($sessionToken);
             Session::start();
        }

        return $next($request);
    }
}
