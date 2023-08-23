<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Support\Facades\DB;
use App\Models\pieces as piece;

class ControllerSecretaire extends Controller
{
    public function home(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendu')->get();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        $date = now();
        return view('secretaire.Home', compact('user', 'dmd_n_lu', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'date', 'le_n_dmd_s'));
    }


    public function formulai(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $date = now();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        return view('secretaire.form_demande', compact('dmd_n_lu', 'user', 'date'));
    }
    public function  form(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());

        return view('secretaire.form_demande_mj', compact('demande', 'dmd_n_lu', 'user'));
    }
    public function searchs(Request $request, $id)
    {

        request()->validate([
            'query' => 'required|min:2'
        ]);
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $data = $request->all();
        $x = $data['query'];
        $demande = demande::where('numero_doss', '=', $x)->get();
        $demandes = demande::where('numero_doss', '=', $x)->first();

        $id_dmd = $demandes->id;
        $numeroDossier = $demandes->numero_doss;
        $dmd_suite = piece::where('id_dmd', '=', $id_dmd)->first();
        $montantr = $dmd_suite->montantrestant;
        $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());
        // dd($numeroDossier);
        return view('secretaire.form_dmd_suite', compact('montantr', 'numeroDossier', 'demande', 'user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function check_demande(Request $request)
    {

        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $date = now();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());

        return view('secretaire.checkdemande', compact('dmd_n_lu', 'user', 'date'));
    }

    /*     public function same_demande(Request $request, $numeroDossier)
    {

        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $date = now();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $demande = (demande::where('numero_doss', '=', $numeroDossier)->get());

        return view('secretaire.same_demande', compact('dmd_n_lu', 'demande', 'user', 'date'));
    } */




    public function store_suite_dmd(Request $request, $id_dmd)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();

        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_secretaire = demande::find($id_dmd);
        $dmd_secretaire->nature_p = $data['nature_pro'];
        $dmd_secretaire->nature_op = $data['nature_op'];
        $dmd_secretaire->montant = $data['montant_in'];
        $convertedObj = Currency::convert()
            ->from($data['currency_from'])
            ->to($data['currency_to'])
            ->amount($data['montant_in']);
        $montant_con = $convertedObj->get();
        $dmd_secretaire->montant_con = $montant_con;
        $dmd_secretaire->devise = $data['currency_from'];
        $dmd_secretaire->nom_client = $data['nom_client'];
        $dmd_secretaire->prenom_client = $data['prenom_client'];
        $dmd_secretaire->profess_client = $data['profess_client'];
        $dmd_secretaire->tel_client = $data['tel_client'];
        $dmd_secretaire->banque_client = $data['banque_client'];
        $dmd_secretaire->numero_doss = $data[' num_doss'];

        $dmd_secretaire->num_compt_client = $data['num_compt_client'];
        $dmd_secretaire->id_secret =  $data['id_user'];
        $dmd_secretaire->status_dmd = 'En cours';

        // Sauvegarde du modèle en base de données
      x  $dmd_secretaire->save();
        dd($dmd_secretaire->save());
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->get();
        $le_n_dmd = count($demande);
        return view('secretaire.liste_demande', compact('demande', 'dmd_n_lu', 'user'));

        // Sauvegarde du modèle en base de données


    }


    public function store_mj(Request $request, $id_dmd)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();

        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_secretaire = demande::find($id_dmd);
        $dmd_secretaire->nature_p = $data['nature_pro'];
        $dmd_secretaire->nature_op = $data['nature_op'];
        $dmd_secretaire->montant = $data['montant_in'];
        $convertedObj = Currency::convert()
            ->from($data['currency_from'])
            ->to($data['currency_to'])
            ->amount($data['montant_in']);
        $montant_con = $convertedObj->get();
        $dmd_secretaire->montant_con = $montant_con;
        $dmd_secretaire->devise = $data['currency_from'];
        $dmd_secretaire->nom_client = $data['nom_client'];
        $dmd_secretaire->prenom_client = $data['prenom_client'];
        $dmd_secretaire->profess_client = $data['profess_client'];
        $dmd_secretaire->tel_client = $data['tel_client'];
        $dmd_secretaire->banque_client = $data['banque_client'];

        $dmd_secretaire->num_compt_client = $data['num_compt_client'];
        $dmd_secretaire->id_secret =  $data['id_user'];
        $dmd_secretaire->status_dmd = 'En cours';

        // Sauvegarde du modèle en base de données
        $dmd_secretaire->update();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->get();
        $le_n_dmd = count($demande);
        return view('secretaire.liste_demande', compact('demande', 'dmd_n_lu', 'user'));

        // Sauvegarde du modèle en base de données


    }

    public function store(Request $request)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();

        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_secretaire = new demande();
        // Supposons que vous ayez les informations suivantes pour la demande de prêt
        $prenomDemandeur = $data['prenom_client'];
        $nomDemandeur = $data['nom_client'];
        $anneeDemande = date('y');

        // Récupérez le dernier numéro de dossier enregistré dans votre base de données
        $dernierNumeroDossier = demande::latest()->first();
        if ($dernierNumeroDossier) {
            $derniereValeur = $dernierNumeroDossier->numero_doss;
            $dernierCaractere = substr($derniereValeur, -1);
            $new = $dernierCaractere + 1;
        } else {
            // Si le champ est vide, vous pouvez initialiser la séquence numérique à 
            $new  = 0;
        }

        $numeroDossier = substr(strtoupper($prenomDemandeur), 0, 1) . substr(strtoupper($nomDemandeur), 0, 1) . $anneeDemande . sprintf('%03d', $new);

        $dmd_secretaire->numero_doss  = $numeroDossier;
        $dmd_secretaire->date = $data['date_depot'];
        $dmd_secretaire->nature_p = $data['nature_pro'];
        $dmd_secretaire->nature_op = $data['nature_op'];
        $dmd_secretaire->montant = $data['montant_in'];
        $convertedObj = Currency::convert()
            ->from($data['currency_from'])
            ->to($data['currency_to'])
            ->amount($data['montant_in']);
        $montant_con = $convertedObj->get();
        $dmd_secretaire->montant_con = $montant_con;
        $dmd_secretaire->devise = $data['currency_from'];
        $dmd_secretaire->nom_client = $data['nom_client'];
        $dmd_secretaire->prenom_client = $data['prenom_client'];
        $dmd_secretaire->profess_client = $data['profess_client'];
        $dmd_secretaire->tel_client = $data['tel_client'];
        $dmd_secretaire->banque_client = $data['banque_client'];

        $dmd_secretaire->num_compt_client = $data['num_compt_client'];
        $dmd_secretaire->id_secret =  $data['id_user'];
        $dmd_secretaire->status_dmd = 'En cours';

        // Sauvegarde du modèle en base de données
        $dmd_secretaire->save();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->get();
        $le_n_dmd = count($demande);
        return view('secretaire.liste_demande', compact('demande', 'dmd_n_lu', 'user'));
    }




    public function liste(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        return view('secretaire.liste_demande', compact('demande', 'dmd_n_lu', 'user'));
    }

    public function   detaille(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id_secret', '=', $id_c)->where('id', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd = demande::find($id);
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        /*        $fileNamesJson = $demande->file;
        $fileNames = json_decode($fileNamesJson, true); */
        return view('secretaire.detaille_demande', compact('demande', 'user', 'dmd_n_lu'));
    }
}
