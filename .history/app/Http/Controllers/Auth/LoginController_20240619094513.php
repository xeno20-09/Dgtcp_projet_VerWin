<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        // Valider et authentifier l'utilisateur

        // Générer un token unique
        $sessionToken = bin2hex(random_bytes(32));

        //  return redirect()->to('/HSecretaire/?session=' . $sessionToken);
        if (Auth::check() && Auth::user()->poste == 'Agent de saisir') {
            $request->has('session');
            $sessionToken = $request->fullUrl();

            dd($sessionToken);
            $sessionToken = Str::after($sessionToken, "c/");

            return 'HSecretaire/c/' . $sessionToken;

        }
        if (Auth::check() && Auth::user()->poste == 'Vérificateur') {

            return '/HVerificateur';
        }
        if (Auth::check() && Auth::user()->poste == 'Chef division') {

            return '/HChef_division';
        }
        if (Auth::check() && Auth::user()->poste == 'Chef service') {

            return '/HChef_bureau';
        }
        if (Auth::check() && Auth::user()->poste == 'Directeur') {

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
