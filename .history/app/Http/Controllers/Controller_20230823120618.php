<?php

namespace App\Http\Controllers;

use App\Models\demandes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function loginUser()
    {
        return view('auth.login');
    }
    public function registerUser()
    {
        return view('auth.register');
    }

    /*   public function search(Request $request, $id)
    {

        request()->validate([
            'query' => 'required|min:2'
        ]);
        $id = Auth::id();
        $query = request()->input('query');
        $info = demande::where('numero_doss', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_p', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_op', 'LIKE', '%' . $query . '%')
            ->orWhere('nom_client', 'LIKE', '%' . $query . '%')
            ->orWhere('prenom_client', 'LIKE', '%' . $query . '%')->get();

        return view('info_search', compact('info',  'query'));
    }
 */


    public function suite_dmd(Request $request, $id_dmd)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
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
        $dmd_secretaire->nom_client = $dmd_secretaire->nom_client;
        $dmd_secretaire->prenom_client = $dmd_secretaire->prenom_client;
        $dmd_secretaire->profess_client = $dmd_secretaire->profess_client;
        $dmd_secretaire->tel_client = $dmd_secretaire->tel_client;
        $dmd_secretaire->banque_client = $dmd_secretaire->banque_client;
        $num = $dmd_secretaire->numero_doss;



        // Récupérez le dernier numéro de dossier enregistré dans votre base de données
        $dernierNumeroDossier = demande::where('numero_doss', '=', $num)->latest()->first();
        if ($dernierNumeroDossier) {
            $derniereValeur = $dernierNumeroDossier->numero_doss;
            $dernierCaractere = substr($derniereValeur, -1);
            $numero = $dernierCaractere + 1;
            $numf = $num . '_' . $numero;
        }

        $dmd_secretaire->numero_doss =  $numf;

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

        // Sauvegarde du modèle en base de données


    }

    public function searchs(Request $request, $id)
    {

        request()->validate([
            'query' => 'required|min:2'
        ]);
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        $query = request()->input('query');
        $info = demande::where('numero_doss', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_p', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_op', 'LIKE', '%' . $query . '%')
            ->orWhere('nom_client', 'LIKE', '%' . $query . '%')
            ->orWhere('prenom_client', 'LIKE', '%' . $query . '%')->get();
        $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=', 0)->get());
        return view('secretaire.info_search', compact('info',  'query', 'user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function searchv(Request $request, $id)
    {

        request()->validate([
            'query' => 'required|min:2'
        ]);
        $id = Auth::id();
        $query = request()->input('query');
        $info = demande::where('numero_doss', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_p', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_op', 'LIKE', '%' . $query . '%')
            ->orWhere('nom_client', 'LIKE', '%' . $query . '%')
            ->orWhere('prenom_client', 'LIKE', '%' . $query . '%')->get();
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
        return view('verificateur.info_search', compact('info',  'query', 'user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function searchd(Request $request, $id)
    {

        request()->validate([
            'query' => 'required|min:2'
        ]);
        $id = Auth::id();
        $query = request()->input('query');
        $info = demande::where('numero_doss', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_p', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_op', 'LIKE', '%' . $query . '%')
            ->orWhere('nom_client', 'LIKE', '%' . $query . '%')
            ->orWhere('prenom_client', 'LIKE', '%' . $query . '%')->get();
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
        return view('chef_division.info_search', compact('info',  'query', 'user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function searchb(Request $request, $id)
    {

        request()->validate([
            'query' => 'required|min:2'
        ]);
        $id = Auth::id();
        $query = request()->input('query');
        $info = demande::where('numero_doss', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_p', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_op', 'LIKE', '%' . $query . '%')
            ->orWhere('nom_client', 'LIKE', '%' . $query . '%')
            ->orWhere('prenom_client', 'LIKE', '%' . $query . '%')->get();
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
        return view('chef_bureau.info_search', compact('info',  'query', 'user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function searchdamf(Request $request, $id)
    {

        request()->validate([
            'query' => 'required|min:2'
        ]);
        $id = Auth::id();
        $query = request()->input('query');
        $info = demande::where('numero_doss', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_p', 'LIKE', '%' . $query . '%')
            ->orWhere('nature_op', 'LIKE', '%' . $query . '%')
            ->orWhere('nom_client', 'LIKE', '%' . $query . '%')
            ->orWhere('prenom_client', 'LIKE', '%' . $query . '%')->get();
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
        return view('damf.info_search', compact('info',  'query', 'user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }
}
