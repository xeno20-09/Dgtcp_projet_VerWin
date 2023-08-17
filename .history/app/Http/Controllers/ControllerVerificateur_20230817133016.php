<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use Illuminate\Support\Facades\DB;

class ControllerVerificateur extends Controller
{
    public function home()
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        return view('verificateur.Home', compact('user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function liste_demande_n(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('status_dmd', '=', 'En cours')->where('nom_benefi', '=', null)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        return view('verificateur.liste_demande_n', compact('user', 'demande', 'jointure', 'dmd_n_lu'));
    }
    public function formulaire(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $dmd_verificateur = demande::find($id);
        $dmd_verificateur->vu_verifi = 1;
        $le_n_dmd = count($demande);
        $dmd_verificateur->update();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        return view('verificateur.form_demande', compact('demande', 'user', 'dmd_n_lu'));
    }

    public function store(Request $request, $idc)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();


        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_verificateur = demande::find($idc);
        $dmd_verificateur->nom_benefi = $data['nom_benifi'];
        $dmd_verificateur->prenom_benefi = $data['prenom_benifi'];
        $dmd_verificateur->profess_benefi =  $data['profess_benifi'];
        $dmd_verificateur->pays_benifi = $data['pays_benifi'];


        $dmd_verificateur->banque_benefi = $data['banque_benifi'];
        $dmd_verificateur->num_compt_benefi = $data['num_compt_benifi'];
        $dmd_verificateur->id_verifi =  $id;
            $file = $request->file('file');
            $destinationPath = 'files/';
            $profileFile = time() . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
            $verificateur['file'] = "$profileFile";
            $dmd_verificateur->file = $verificateur['file'];
        
        // Sauvegarde du modèle en base de données
        $dmd_verificateur->update();
        echo $verificateur['file'];
        $demande = demande::where('id_verifi', '=', $id)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        $user = User::where('id', '=', $id)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        return view('verificateur.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure'));
    }

    public function liste(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_verifi', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        return view('verificateur.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'dmd_n_lu'));
    }

    public function   detaille(Request $request, $id)
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
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        return view('verificateur.detaille_demande', compact('demande', 'user', 'dmd_n_lu', 'jointure', 'dmd_n_lu'));
    }
}
