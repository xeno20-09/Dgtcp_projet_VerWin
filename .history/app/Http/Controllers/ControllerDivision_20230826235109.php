<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ControllerDivision extends Controller
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
        $dmd_n_lu = count(demande::where('vu_chef_division', '=', 0)->get());
        $dmd_back = count(demande::where('back_verificateur', '=', 1)->where('vu_chef_', '=', 1)->where('vu_chef_division', '=', 1)->get());
        $dmd_n_lu = count(demande::where('vu_', '=', 0)->get()) - $dmd_back;
        return view('chef_division.Home', compact('user', 'dmd_back', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function liste_demandes_n(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('status_dmd', '=', 'En cours')->where('date_decision', '=', null)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_chef_division', '=', 0)->get());
        return view('chef_division.liste_demande_n', compact('user', 'demande', 'jointure', 'jointure1', 'dmd_n_lu'));
    }

    public function formulaires(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('vu_chef_division', '=', 0)->get());
        $dmd_chef_division = demande::find($id);
        $dmd_chef_division->vu_chef_division =  1;
        $dmd_chef_division->update();
        return view('chef_division.form_demande', compact('demande', 'user', 'dmd_n_lu'));
    }

    public function  form(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());

        return view('chef_division.formcd_demande_mj', compact('demande', 'dmd_n_lu', 'user'));
    }

    public function stores(Request $request, $idc)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();


        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_chef_division = demande::find($idc);
        $dmd_chef_division->date_decision = $data['date_decision'];

        $dmd_chef_division->id_chef_division =  $id;

        // Sauvegarde du modèle en base de données
        $dmd_chef_division->update();
        $dmd_n_lu = count(demande::where('vu_chef_division', '=', 0)->get());
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('id_chef_division', '=', $id)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        return view('chef_division.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'jointure1'));
    }
    public function liste_demandes(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_chef_division', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = demande::where('vu_secret', '=', 0)->get();
        $dmd_n_lu = count($dmd_n_lu);
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_chef_division', '=', 0)->get());
        return view('chef_division.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'jointure1', 'dmd_n_lu'));
    }

    public function   detailles(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);

        $dmd_n_lu = demande::where('vu_secret', '=', 0)->get();
        $dmd_n_lu = count($dmd_n_lu);
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_chef_division', '=', 0)->get());

        return view('chef_division.detaille_demande', compact('demande', 'user', 'dmd_n_lu', 'jointure', 'jointure1', 'dmd_n_lu'));
    }
}
