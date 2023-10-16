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
        $devises = devises::orderBy('date', 'desc')->get();

        return view('chef_division.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user', 'jointure', 'jointure1'));
    }


    public function   devise(Request $request, $id)
    {           // set API Endpoint, access key, required parameters
        $access_key = 'b662fd153a32369c7a8e4966d7246ff0';

        $date = date('Y-m-d');
        $currencies = 'AED,CAD,CNY,DZD,EGP,EUR,GBP,GHS,GNF,GTQ,JPY,NGN,NZD,RWF,SAR,XAF,USD'; // initialize CURL:

        $url = curl_init('http://api.exchangerate.host/historical?access_key=' . $access_key . '&date=' . $date . '&source=' . 'XOF' . '&currencies=' . $currencies);
        // get the (still encoded) JSON data:
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);

        $aa = curl_exec($url);
        curl_close($url);
        $r = json_decode($aa, true);
        $ladev = devises::first();
        $day = $ladev->date;
        $ladate = now()->format('Y-m-d');
        if ($day == $ladate) {
            $today = 1;
        } else {
            $today = 0;
        }
        // dd($day);


        if ($today == 0) {

            $q = $r['quotes'];
            $val = [];
            $dev = [];

            foreach ($q as $devise => $valeur) {
                $val[] = 1 / $valeur;
                $dev[] = substr($devise, 3, 6);
            }
            // dd($r['success']);
            $u = array_keys($q);

            $n = count($u);

            $new = [];
            $valeur = [];

            $codeToDevise = [
                "AED" => "Dirham des Émirats arabes unis",
                "CAD" => "Dollar canadien",

                "CNY" => "Yuan chinois",
                "DZD" => "Dinar algérien",
                "EGP" => "Livre égyptienne",

                "EUR" => "Euro",
                "GBP" => "Livre sterling",
                "GHS" => "Cedi ghanéen",
                "GNF" => "Franc guinéen",
                "GTQ" => "Quetzal guatémaltèque",
                "JPY" => "Yen japonais",
                "NGN" => "Naira nigérian",
                "NZD" => "Dollar néo-zélandais",

                "RWF" => "Franc rwandais",
                "SAR" => "Riyal saoudien",


                "XAF" => "Franc CFA d'Afrique centrale",
                "USD" => "Dollar des États-Unis",


            ];

            $pays = []; // Créez un tableau pour stocker les noms de devises

            foreach ($u as $key => $value) {
                $casse = substr($value, 3, 6);
                $new[] = $casse;
            }

            foreach ($new as $key => $value) {
                foreach ($codeToDevise as $key1 => $value1) {
                    if ($value == $key1) {
                        $pays[] = $value1;
                    }
                }
            }

            foreach ($val as $key => $value) {
                $valeur[] = $value;
            }
            //$cmp = array_diff($dev, $pays);

            //  dd($cmp, $dev, $pays, $val, $valeur);

            foreach ($valeur as $index => $valeur) {
                $devise = $pays[$index];

                // Créez une nouvelle instance du modèle Devise
                $nouvelleDevise = new devises();
                $nouvelleDevise->id_user = Auth::user()->id;
                $nouvelleDevise->date = $date;
                $nouvelleDevise->devise = $devise;
                $nouvelleDevise->valeur = $valeur;

                // Enregistrez la nouvelle instance dans la base de données
                $nouvelleDevise->save();
            }
        }
        if ($r['success'] == true || $today == 1) {
            return $this->get_devis_mj();
        }
        if ($r['success'] != true) {

            $user = User::where('id', '=', $id)->get();
            $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
            $date = now();
            $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
            $devise = listedevise::all();
            $devises = devises::orderBy('date', 'desc')->get();

            return view('chef_division.form_devis', compact('user', 'ladate', 'devises', 'dmd_n_lu', 'date', 'dmd_back', 'devise'));
        }
    }

    public function get_devis_mj()
    {
        $id = Auth::user()->id;
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', '0')/* ->orwhere('motif', '=', 'Rejetée pour incorformité au niveau des montants') */->where('vu_verifi', '=', 1)->where('back_verifi', '=', 0)->where('date_decision', '=', null)->get());
        $date = now();
        $dmd_back = count(demande::where('back_chef_division', '=', 1)->get());
        $devises = devises::orderBy('date', 'desc')->get();
        $ladate = now()->format('Y-m-d');

        return view('chef_division.listedevisemj', compact('user', 'ladate', 'devises', 'dmd_n_lu', 'dmd_back'));
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
        $devises = devises::orderBy('date', 'desc')->get();
        $ladate = now()->format('Y-m-d');

        return view('chef_division.form_devis', compact('ladate', 'user', 'dmd_n_lu', 'date', 'dmd_back', 'devise', 'devises'));
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
        $devises = devises::orderBy('date', 'desc')->get();
        $ladate = now()->format('Y-m-d');

        return view('chef_division.form_devis', compact('ladate', 'devises', 'user', 'dmd_n_lu', 'date', 'dmd_back', 'devise'));
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
        if ($piece) {
            $pieces = $piece->libellepiece;
        } else {
            $pieces = null;
        }
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
