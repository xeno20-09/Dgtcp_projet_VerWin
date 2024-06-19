<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class SessionToken
{
    public function handle($request, Closure $next)
    {
        if ($request->has('session')) {
             // Récupérer le token de session à partir de l'URL
             $sessionToken = $request->url();

             // Récupérer l'élément après 'c/'
             $sessionToken = Str::after($sessionToken, "c/");
          
             Session::setId($sessionToken);
             Session::start();
        }

        return $next($request);
    }
}
