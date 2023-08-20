<?php

namespace App\Http\Controllers;

use App\Models\user as user;
use App\Models\demandes as demande;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerBureau extends Controller
{
    public function home()
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());
        return view('chef_bureau.Home', compact('user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }
    public function liste_demand_n(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('status_dmd', '=', 'En cours')->where('visa_chef_bureau', '=', 0)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure2 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_division')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());

        return view('chef_bureau.liste_demande_n', compact('dmd_n_lu', 'user', 'demande', 'jointure', 'jointure1', 'jointure2'));
    }

    public function formulair(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_chef_bureau = demande::find($id);
        $dmd_chef_bureau->vu_chef_bureau = 1;
        $dmd_chef_bureau->update();
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());
        return view('chef_bureau.form_demande', compact('demande', 'user', 'dmd_n_lu'));
    }
    public function stor(Request $request, $idc)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();


        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_chef_bureau = demande::find($idc);
       $visa= $data['visa_chef_bureau'] 
        $data['visa_chef_bureau_n'] 
        if ($data['visa_chef_bureau'] == true) {
            $visa = 1;
        } else {
            $visa = 0;
        }
        $dmd_chef_bureau->visa_chef_bureau = $visa;

        $dmd_chef_bureau->id_chef_bureau =  $id;
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('id_chef_bureau', '=', $id)->get();
        // Sauvegarde du modèle en base de données
        $dmd_chef_bureau->update();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure2 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_division')
            ->select('demandes.*', 'users.*')
            ->get();
        return view('chef_bureau.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'jointure1', 'jointure2'));
    }

    public function liste_demand(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_chef_bureau', '=', $id)->get();
        $le_n_dmd = count($demande);

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure2 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_division')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());
        return view('chef_bureau.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'jointure1', 'jointure2'));
    }
    public function   detailles(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);


        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure2 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_division')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());

        return view('chef_bureau.detaille_demande', compact('demande', 'user', 'dmd_n_lu', 'jointure', 'jointure1', 'jointure2'));
    }
}
