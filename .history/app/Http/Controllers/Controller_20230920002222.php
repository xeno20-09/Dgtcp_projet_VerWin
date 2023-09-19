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


    public function get_search_ask(Request $request, $id)
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
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());

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
