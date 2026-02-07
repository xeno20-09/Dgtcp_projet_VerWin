<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUserMail;

class RegisterService
{


    /*     protected function validator(array $data)
    {
        return Validator::make($data, [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    } */

    public function register(array $data)
    {

        // Créer un nouvel utilisateur
        $user = $this->create($data);

        //   return $user;
    }
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstname' => $data['prenom_client'] ? $data['prenom_client'] : 'Entreprise',
            'lastname' => $data['nom_client'] ? $data['nom_client'] : 'Entreprise',
            'company_name' => $data['company_name'] ? $data['company_name'] : 'Physique',
            'ifu' => $data['ifu'],
        ]);

        /*         // Envoyer l'e-mail de bienvenue
        Mail::to($user->email)->send(new WelcomeUserMail());
        return $user; */
    }
}
