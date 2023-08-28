<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use Illuminate\Support\Facades\DB;

class ControllerDamf extends Controller
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
        $dmd_n_lu = count(demande::where('vu_damf', '=', 0)->where('vu_chef_bureau', '=', 1)->get());



        return view('damf.Home', compact('user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function liste_dmd_n(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('status_dmd', '=', 'En cours')->where('vu_damf', '=', 0)->get();
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
        $jointure3 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_bureau')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_damf', '=', 0)->where('vu_chef_bureau', '=', 1)->get());


        return view('damf.liste_demande_n', compact('user', 'demande', 'jointure', 'jointure1', 'jointure2', 'jointure3', 'dmd_n_lu'));
    }
    public function formulair(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('vu_damf', '=', 0)->where('vu_chef_bureau', '=', 1)->get());
        $dmd_damf = demande::find($id);
        $dmd_damf->vu_damf =  1;
        $dmd_damf->update();


        return view('damf.form_demande', compact('demande', 'user', 'dmd_n_lu'));
    }
    public function  form(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('vu_damf', '=', 0)->where('vu_chef_bureau', '=', 1)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());


        return view('damf.formda_demande_mj', compact('demande', 'dmd_n_lu', 'user'));
    }
    public function stor(Request $request, $idc)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();


        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_damf = demande::find($idc);
        $dmd_damf->reponse_damf = 1;
        $dmd_damf->motif = $data['motif'];
        $dmd_damf->status_dmd = $data['status'];

        $dmd_damf->id_damf =  $id;
        $dmd_n_lu = count(demande::where('vu_damf', '=', 0)->where('vu_chef_bureau', '=', 1)->get());
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('id_damf', '=', $id)->get();
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
        $jointure3 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_bureau')
            ->select('demandes.*', 'users.*')
            ->get();
        // Sauvegarde du modèle en base de données
        $dmd_damf->update();


        return view('damf.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
    }

    public function liste_dmd(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_damf', '=', $id)->get();
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
        $jointure3 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_bureau')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_damf', '=', 0)->where('vu_chef_bureau', '=', 1)->get());

        return view('damf.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'jointure1', 'jointure2', 'jointure3', 'dmd_n_lu'));
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
        $jointure3 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_bureau')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_damf', '=', 0)->where('vu_chef_bureau', '=', 1)->get());



        return view('damf.detaille_demande', compact('demande', 'user', 'dmd_n_lu', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
    }

    public function retour(Request $request, $idc)
    {
        $demande = demande::find($idc);
        $demande->back_chef_bureau = 1;
        $demande->update();

        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_damf', '=', $id)->get();
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
        $jointure3 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_bureau')
            ->select('demandes.*', 'users.*')
            ->get();


        return view('damf.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'jointure1', 'jointure2', 'jointure3', 'dmd_n_lu'));
    }
}
