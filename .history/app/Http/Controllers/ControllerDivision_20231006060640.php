<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use App\Models\devises;
use App\Models\listedevise;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\pieces as piece;


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
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        return view('chef_division.Home', compact('user', 'dmd_back', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function liste_demandes_n(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());

        return view('chef_division.liste_demande_n', compact('user', 'dmd_back', 'demande', 'jointure', 'jointure1', 'dmd_n_lu'));
    }

    public function formulaires(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());

        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        $demandes = demande::where('id', '=', $id)->first();

        $id_dmd = $demandes->id;
        $piece = piece::where('id_dmd', '=', $id_dmd)->get();
        //  dd($piece);
        return view('chef_division.form_demande', compact('demande', 'dmd_back', 'piece', 'user', 'dmd_n_lu'));
    }

    public function  form(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        $piece = piece::where('id_dmd', '=', $id_dmd)->get();
        //  dd($piece);

        return view('chef_division.formcd_demande_mj', compact('demande', 'piece', 'dmd_back', 'dmd_n_lu', 'user'));
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
        if ($dmd_chef_division->back_chef_division == 1) {
            $dmd_chef_division->back_chef_division = 0;
        } else {
            $dmd_chef_division->back_chef_division = 0;
        }
        $dmd_chef_division->vu_chef_division = 1;
        // Sauvegarde du modèle en base de données
        $dmd_chef_division->update();
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $user = User::where('id', '=', $id)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        $demande = demande::where('id_chef_division', '=', $id)->where('vu_chef_division', '=', 1)->get();

        return redirect('liste_demandes')->with('demande', 'dmd_back', 'dmd_n_lu', 'user', 'jointure', 'jointure1');
    }
    public function liste_demandes(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_chef_division', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());

        return view('chef_division.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user', 'jointure', 'jointure1'));
    }


    public function   devise(Request $request, $id)
    {

        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $date = now();
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        $devise = listedevise::all();

        return view('chef_division.form_devis', compact('user', 'dmd_n_lu', 'date', 'dmd_back', 'devise'));
    }
    public function addc(Request $request, $id)
    {

        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();


        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_chef_division = new devises();

        $dmd_chef_division->date = $data['date'];

        $dmd_chef_division->devise = $data['devise'];

        $dmd_chef_division->valeur = floatval($data['valeur']);
        $dmd_chef_division->id_user = Auth::id();

        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $date = now();
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        $dmd_chef_division->save();
        $devise = listedevise::all();

        return view('chef_division.form_devis', compact('user', 'dmd_n_lu', 'date', 'dmd_back', 'devise'));
    }
    public function adddevise(Request $request, $id)
    {

        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();


        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_chef_division = new listedevise();

        $dmd_chef_division->nom = $data['devise'];

        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $date = now();
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        $dmd_chef_division->save();
        $devise = listedevise::all();

        return view('chef_division.form_devis', compact('user', 'dmd_n_lu', 'date', 'dmd_back', 'devise'));
    }

    public function   detailles(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);

        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        $piece = piece::where('id_dmd', '=', $id)->first();
        if($piece){
            
        }
        $pieces = $piece->libellepiece;
        $piece = piece::where('id_dmd', '=', $id)->first();

        return view('chef_division.detaille_demande', compact('demande', 'piece', 'pieces', 'dmd_back', 'user', 'dmd_n_lu', 'jointure', 'jointure1'));
    }
    public function retour(Request $request, $idc)
    {
        $demande = demande::find($idc);
        $demande->back_verifi = 1;


        $demande->vu_chef_division = 0;
        //dd($demande);

        $demande->update();
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_chef_division', '=', $id)->get();
        $le_n_dmd = count($demande);

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();

        $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        return view('chef_division.Home', compact('user', 'dmd_back', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function listeretour(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_chef_division', '=', $id)->where('back_chef_division', '=', 1)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());

        return view('chef_division.liste_dmd_back', compact('demande', 'dmd_back', 'user', 'jointure', 'jointure1', 'dmd_n_lu'));
    }
}
