<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }
    public function redirectTo()
    {

        if (Auth::check() && Auth::user()->poste == 'Sécretaire') {

            return '/HSecretaire';
        }
        if (Auth::check() && Auth::user()->poste == 'Vérificateur') {

            return '/HVerificateur';
        }
        if (Auth::check() && Auth::user()->poste == 'Chef division') {

            return '/HChef_division';
        }
        if (Auth::check() && Auth::user()->poste == 'Chef bureau') {

            return '/HChef_bureau';
        }
        if (Auth::check() && Auth::user()->poste == 'Damf') {

            return '/HDamf';
        }
        if (Auth::check() && Auth::user()->poste == 'Client') {

            return '/Client';
        }
    }






    public function logout(Request $request)
    {
        // Vérifier si un utilisateur est connecté avant de procéder à la déconnexion
        if (Auth::check()) {
            // Mettez à jour la date de dernière déconnexion de l'utilisateur
            $user = Auth::user();
            $user->last_login_at = now();
            $user->update();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect('/');
    }
}
