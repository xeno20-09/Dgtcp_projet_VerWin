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
    public function loginUser()  {
        return view('auth.login');
    }
    public function registerUser()  {
        return view('auth.register');
    }

    public function search(Request $request, $id)
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



    public function search(Request $request, $id)
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

    public function search(Request $request, $id)
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

        return view('chef_division.info_search', compact('info',  'query'));
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

        return view('chef_bureau.info_search', compact('info',  'query'));
    }

    public function searchD(Request $request, $id)
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

        return view('damf.info_search', compact('info',  'query'));
    }
}
