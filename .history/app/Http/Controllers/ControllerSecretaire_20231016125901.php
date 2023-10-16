<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use App\Models\devises;
use App\Models\listedevise;
use App\Models\user as user;
use Illuminate\Http\Request;
use App\Models\pieces as piece;
use Illuminate\Support\Facades\DB;
use App\Models\demandes as demande;
use Illuminate\Support\Facades\Log;
use libphonenumber\PhoneNumberUtil;
use Illuminate\Support\Facades\Auth;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Barryvdh\DomPDF\Facade\Pdf;

class ControllerSecretaire extends Controller
{
    /************************************Home Secretaire************************************************ */
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
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        return view('secretaire.Home', compact('user', 'dmd_back', 'dmd_n_lu', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'date', 'le_n_dmd_s'));
    }
    /************************************Home Secretaire************************************************ */


    /************************************Formulaire demande************************************************ */
    public function get_form_ask(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $date = now();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        $dev = devises::all();
        $listedevis = listedevise::all();
        return view('secretaire.form_demande', compact('listedevis', 'dmd_n_lu', 'dmd_back', 'user', 'date', 'dev'));
    }
    /************************************Formulaire demande************************************************ */

    public function getD(Request $request)
    {

        $monnaie = $request->input('monnaie');
        $devise = Devises::where('devise', $monnaie)
            ->orderBy('date', 'desc')
            ->first();

        if ($devise) {
            return response()->json(['val' => $devise->valeur]);
        } else {
            return response()->json(['val' => null]);
        }
    }

    /************************************Sauvegarder une demande************************************************ */

    public function store_form_ask(Request $request)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();
        //dd($data);

        if (request()->validate([
            'num_compt_client' => 'required|min:11|max:12',

        ]))


            $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_secretaire = new demande();
        // Supposons que vous ayez les informations suivantes pour la demande de prêt

        $anneeDemande = date('Y');

        // dd($anneeDemande);
        // Récupérez le dernier numéro de dossier enregistré dans votre base de données
        $test = demande::latest()->first();
        $dernierNumeroDossier = null;

        if ($test) {
            $dernierNumeroDossier = $test->numero_doss;
        }

        if ($dernierNumeroDossier) {
            // Extraire la partie numérique "XXXXXX"
            $n = substr($dernierNumeroDossier, 4, 6);

            // Convertir la partie numérique en un nombre entier
            $n = (int)$n;

            // Incrémenter la partie numérique
            $n++;

            // Formatez la partie numérique avec des zéros non significatifs à gauche
            $n = sprintf('%06d', $n);
        } else {
            // Si aucun numéro de dossier n'a été enregistré, initialisez à 1
            $n = '000001';
        }
        // dd($n);
        // Obtenez l'année de la demande (exemple : 2023)
        $anneeDemande = date("Y");

        // Créez le nouveau numéro de dossier en utilisant le format
        $numeroDossier = "DTr" . "-" . $n . "-" . $anneeDemande;

        /*         $numeroDossier =substr(strtoupper($prenomDemandeur), 0, 1) . substr(strtoupper($nomDemandeur), 0, 1) . $anneeDemande . sprintf('%03d', $new);
 */
        $dmd_secretaire->numero_doss  = $numeroDossier;
        $dmd_secretaire->date = $data['date_depot'];
        $dmd_secretaire->nature_p = $data['nature_pro'];
        $dmd_secretaire->nature_op = $data['nature_op'];
        $dmd_secretaire->montant = $data['montant_in'];
        $dmd_secretaire->num_save = $data['num_save'];

        $dmd_secretaire->type_prs = $data['type'];

        if ($data['type'] == "morale") {
            $dmd_secretaire->boite = $data["boite"];
            $dmd_secretaire->nomsociete = $data["nomsociete"];
            $dmd_secretaire->categorie = $data["categorie"];
            $dmd_secretaire->adresse = $data["adresse"];
        }

        $dmd_secretaire->vu_secret = 1;
        $dmd_secretaire->devise = $data['currency_from'];
        $dmd_secretaire->valeur = $data['valeur'];
        if ($data['valeur'] * $data['montant_in'] != $data['mont_fcfa']) {
            $dmd_secretaire->montant_con = $data['valeur'] * $data['montant_in'];
        } else {
            $dmd_secretaire->montant_con = $data['mont_fcfa'];
        }

        $fromCurrency = $data['currency_from'];

        $dmd_secretaire->devise = $fromCurrency;
        if ($data['type'] == "physique") {

            $dmd_secretaire->nom_client = $data['nom_client'];
            $dmd_secretaire->prenom_client = $data['prenom_client'];
            $dmd_secretaire->profess_client = $data['profess_client'];
            $dmd_secretaire->nationalite = $data["nationalite"];
        }
        $dmd_secretaire->tel_client = $data['tel_client'];
        $dmd_secretaire->banque_client = $data['banque_client'];

        $dmd_secretaire->num_compt_client = $data['num_compt_client'];
        $dmd_secretaire->id_secret = Auth::id();
        $dmd_secretaire->status_dmd = 'En cours';

        // Sauvegarde du modèle en base de données
        $dmd_secretaire->save();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->where('vu_secret', '=', 1)->get();
        $le_n_dmd = count($demande);
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        return redirect('/ListeDemandes')->with('demande', 'dmd_back', 'dmd_n_lu', 'user');

        //return view('secretaire.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }
    /************************************Sauvegarder une demande************************************************ */
    public function get_rec_ask(Request $request, $id)
    {
        // retreive all records from db
        $demande = demande::where('id', '=', $id)->get();
        dd($demande);

        // share data to view
        view()->share('demande', $demande);

        $pdf = PDF::loadView('secretaire.pdf_recu', $data = ['numero_doss', 'date', 'nature_p', 'nature_op', 'montant', 'montant_con', 'devise', 'num_save', 'nom_client', 'type_prs', 'boite', 'adresse', 'nomsociete', 'prenom_client', 'profess_client', 'tel_client', 'banque_client', 'num_compt_client']);
        //  download PDF file with download method
        return $pdf->download('Recu.pdf');
    }
    /************************************Liste des demandes************************************************ */

    public function get_list_ask(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->where('vu_secret', '=', 1)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        return view('secretaire.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }
    /************************************Liste des demandes************************************************ */

    /************************************Voir les details d'une demande************************************************ */


    public function   get_list_details_ask(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id_secret', '=', $id_c)->where('id', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd = demande::find($id);
        $dmd->reponse_damf = 0;
        $dmd->update();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        $pieces = piece::where('id_dmd', '=', $id)->first();

        /*      if ($pieces) {
            $piece = $pieces->libellepiece;
        } else {
            $piece = 0;
        } */
        /*        $fileNamesJson = $demande->file;
        $fileNames = json_decode($fileNamesJson, true); */
        return view('secretaire.detaille_demande', compact('demande', 'pieces', 'dmd_back', 'user', 'dmd_n_lu'));
    }
    /************************************Voir les details d'une demande************************************************ */


    /************************************Formulaire mise à jour demande************************************************ */

    public function  get_update_form_ask(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());

        return view('secretaire.form_demande_mj', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }
    /************************************Formulaire mise à jour demande************************************************ */

    /************************************Faire la mise à jour d'une demande************************************************ */

    public function store_update_form_ask(Request $request, $id_dmd)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();

        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_secretaire = demande::find($id_dmd);
        $dmd_secretaire->nature_p = $data['nature_pro'];
        $dmd_secretaire->nature_op = $data['nature_op'];
        $dmd_secretaire->montant = $data['montant_in'];
        /*        $convertedObj = Currency::convert()
            ->from($data['currency_from'])
            ->to($data['currency_to'])
            ->amount($data['montant_in']);
        $montant_con = $convertedObj->get(); */
        $dmd_secretaire->type_prs = $data['type'];

        if ($data['type'] == "morale") {

            $dmd_secretaire->boite = $data["boite"];
            $dmd_secretaire->nomsociete = $data["nomsociete"];
            $dmd_secretaire->categorie = $data["categorie"];
            $dmd_secretaire->adresse = $data["adresse"];
        }
        $dmd_secretaire->vu_secret = 1;
        $dmd_secretaire->devise = $data['currency_from'];
        $dmd_secretaire->valeur = $data['valeur'];
        if ($data['valeur'] * $data['montant_in'] != $data['mont_fcfa']) {
            $dmd_secretaire->montant_con = $data['valeur'] * $data['montant_in'];
        } else {
            $dmd_secretaire->montant_con = $data['mont_fcfa'];
        }
        $dmd_secretaire->num_save = $data["num_save"];
        if ($data['type'] == "physique") {
            $dmd_secretaire->nom_client = $data['nom_client'];
            $dmd_secretaire->prenom_client = $data['prenom_client'];
            $dmd_secretaire->profess_client = $data['profess_client'];
            $dmd_secretaire->nationalite = $data["nationalite"];
        }

        $dmd_secretaire->tel_client = $data['tel_client'];
        $dmd_secretaire->banque_client = $data['banque_client'];
        $dmd_secretaire->vu_secret = 1;
        $dmd_secretaire->num_compt_client = $data['num_compt_client'];
        $dmd_secretaire->id_secret =  $data['id_user'];
        $dmd_secretaire->status_dmd = 'En cours';


        if ($dmd_secretaire->back_secret == 1) {
            $dmd_secretaire->back_secret = 0;
        } else {
            $dmd_secretaire->back_secret = 0;
        }
        // Sauvegarde du modèle en base de données
        //dd($dmd_secretaire);
        $dmd_secretaire->update();
        //dd($id_dmd);
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->where('vu_secret', '=', 1)->get();
        $le_n_dmd = count($demande);
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        return redirect('/ListeDemandes')->with('demande', 'dmd_back', 'dmd_n_lu', 'user');
        //return view('secretaire.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));

        // Sauvegarde du modèle en base de données


    }
    /************************************Faire la mise à jour d'une demande************************************************ */




    /************************************Formulaire pour chercher une demande pour poursuivre************************************************ */

    /*     public function get_search_ask_suite(Request $request)
    {

        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $date = now();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());

        return view('secretaire.checkdemande', compact('dmd_n_lu', 'dmd_back', 'user', 'date'));
    } */
    /************************************Formulaire pour chercher une demande pour poursuivre************************************************ */


    /************************************Rechercher demande pour poursuivre************************************************ */

    /*  public function store_search_ask_suite(Request $request, $id)
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

        if ($dmd_suite->montantrestant == null) {
            $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
            $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
            $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
            $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
            $le_n_dmd_c = count($demande_encours);
            $le_n_dmd_v = count($demande_valider);
            $le_n_dmd_e = count($demande_echec);
            $le_n_dmd_s = count($demande_suspendre);
            $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());
            $montantr = 0;

            $dernierNumeroDossier = demande::where('numero_doss', '=',  $data['query'])->latest()->first();
            $derniereValeur = $dernierNumeroDossier->numero_doss;
            $dernierCaractere =  substr($derniereValeur, 0, strpos($derniereValeur, '_'));
            $demande = demande::where('numero_doss', 'LIKE', '%' . $dernierCaractere . '%')->get();

            $piece = piece::where('numero_doss', '=',  $dernierCaractere)->get();
            $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());


            return view('secretaire.recap', compact('montantr', 'dmd_back', 'numeroDossier', 'demande', 'user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu', 'piece'));
        } else {
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
            $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
            // dd($numeroDossier);
            return view('secretaire.form_dmd_suite', compact('montantr', 'dmd_back', 'numeroDossier', 'demande', 'user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
        }
    }
    */ /************************************Rechercher demande pour poursuivre************************************************ */

    /************************************    Sauvegarder une demande pour la suite************************************************ */

    /*    public function store_form_ask_suite(Request $request)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();

        $suite_dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        // Création d'un nouveau modèle avec les données du formulaire
        $suite_dmd_secretaire = demande::find($data['id_doss']);

        $nom_client = $suite_dmd_secretaire->nom_client;
        $prenom_client = $suite_dmd_secretaire->prenom_client;
        $profess_client = $suite_dmd_secretaire->profess_client;
        $tel_client = $suite_dmd_secretaire->tel_client;
        $banque_client = $suite_dmd_secretaire->banque_client;
        $num = $suite_dmd_secretaire->numero_doss;



        // Récupérez le dernier numéro de dossier enregistré dans votre base de données
        $dernierNumeroDossier = demande::where('numero_doss', '=', $num)->latest()->first();
        if ($dernierNumeroDossier) {
            $derniereValeur = $dernierNumeroDossier->numero_doss;
            $dernierCaractere = substr($derniereValeur, -1);
            $numero = $dernierCaractere;
            $numf = $num . '_' . '1';
        }

        $dmd_secretaire = new demande();


        $dmd_secretaire->nom_client = $nom_client;
        $dmd_secretaire->prenom_client = $prenom_client;
        $dmd_secretaire->profess_client = $profess_client;
        $dmd_secretaire->tel_client = $tel_client;
        $dmd_secretaire->banque_client = $banque_client;
        $dmd_secretaire->numero_doss = $numf;
        $dmd_secretaire->date = now();
        $dmd_secretaire->vu_secret = 1;
        $dmd_secretaire->num_compt_client = $data['num_compt_client'];
        $dmd_secretaire->id_secret =  $data['id_user'];
        $dmd_secretaire->status_dmd = 'En cours';
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
        // Sauvegarde du modèle en base de données
        $dmd_secretaire->save();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->where('vu_secret', '=', 1)->get();
        $dmd_n_lu = count($demande);
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        //return view('secretaire.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
        return redirect('/ListeDemandes')->with('demande', 'dmd_back', 'dmd_n_lu', 'user');

        // Sauvegarde du modèle en base de données


    }
  */   /************************************Sauvegarder une demande pour la suite************************************************ */
    public function listeretour()
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->where('back_secret', '=', 1)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        return view('secretaire.liste_dmd_back', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }

    /************************************Formulaire mise à jour demande************************************************ */

    public function  get_correction_form_ask(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        //dd($id_dmd);
        return view('secretaire.form_demande_corr', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }
    /************************************Formulaire mise à jour demande************************************************ */

    /************************************Faire la mise à jour d'une demande************************************************ */

    public function store_correction_form_ask(Request $request, $id_dmd)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();

        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_secretaire = demande::find($id_dmd);
        $dmd_secretaire->nature_p = $data['nature_pro'];
        $dmd_secretaire->nature_op = $data['nature_op'];
        $dmd_secretaire->montant = $data['montant_in'];
        /*        $convertedObj = Currency::convert()
            ->from($data['currency_from'])
            ->to($data['currency_to'])
            ->amount($data['montant_in']);
        $montant_con = $convertedObj->get(); */
        $dmd_secretaire->type_prs = $data['type'];

        if ($data['type'] == "morale") {

            $dmd_secretaire->boite = $data["boite"];
            $dmd_secretaire->nomsociete = $data["nomsociete"];
            $dmd_secretaire->categorie = $data["categorie"];
            $dmd_secretaire->adresse = $data["adresse"];
        }
        $dmd_secretaire->vu_secret = 1;
        $dmd_secretaire->devise = $data['currency_from'];
        $dmd_secretaire->valeur = $data['valeur'];
        if ($data['valeur'] * $data['montant_in'] != $data['mont_fcfa']) {
            $dmd_secretaire->montant_con = $data['valeur'] * $data['montant_in'];
        } else {
            $dmd_secretaire->montant_con = $data['mont_fcfa'];
        }
        $dmd_secretaire->num_save = $data["num_save"];
        if ($data['type'] == "physique") {
            $dmd_secretaire->nom_client = $data['nom_client'];
            $dmd_secretaire->prenom_client = $data['prenom_client'];
            $dmd_secretaire->profess_client = $data['profess_client'];
            $dmd_secretaire->nationalite = $data["nationalite"];
        }

        $dmd_secretaire->tel_client = $data['tel_client'];
        $dmd_secretaire->banque_client = $data['banque_client'];
        $dmd_secretaire->vu_secret = 1;
        $dmd_secretaire->num_compt_client = $data['num_compt_client'];
        $dmd_secretaire->id_secret =  $data['id_user'];
        $dmd_secretaire->status_dmd = 'En cours';


        if ($dmd_secretaire->back_secret == 1) {
            $dmd_secretaire->back_secret = 0;
        } else {
            $dmd_secretaire->back_secret = 0;
        }
        // Sauvegarde du modèle en base de données
        //dd($dmd_secretaire);
        $dmd_secretaire->update();
        //dd($id_dmd);
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->where('vu_secret', '=', 1)->get();
        $le_n_dmd = count($demande);
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        return redirect('/ListeDemandes')->with('demande', 'dmd_back', 'dmd_n_lu', 'user');

        // return view('secretaire.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));

        // Sauvegarde du modèle en base de données


    }
    /************************************Faire la mise à jour d'une demande************************************************ */
}
