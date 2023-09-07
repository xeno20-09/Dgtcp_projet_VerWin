<?php

namespace App\Http\Controllers;

use App\Models\demandes;
use App\Models\user as user;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\demandes as demande;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Facade as IlluminateFacade;

class ControllerAdminSGBD extends Controller
{
    public function home()
    {
        $id = Auth::id();
        $user = User::orderBy('created_at', 'desc')->paginate(3);
        return view('Admin_SGBD.Home', compact('user'));
    }

    public function getetatdmd()
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $date = now();
        return view('Admin_SGBD.etats', compact('user', 'date'));
    }

    public function modify_user(Request $request, $id)
    {

        $user = User::where('id', '=', $id)->get();
        return view('Admin_SGBD.form_user', compact('user'));
    }

    public function store_user(Request $request, $idc)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();

        // Création d'un nouveau modèle avec les données du formulaire
        $user = user::find($idc);
        $user->poste = $data['poste'];

        // Sauvegarde du modèle en base de données
        $user->update();
        $user = User::orderBy('created_at', 'desc')->paginate(3);
        return view('Admin_SGBD.Home', compact('user'));
    }

    public function  listedmd(Request $request)
    {
        $data = $request->all();
        $status = $data['status'];
        $demande = demandes::where('status_dmd', $status);
    }

    public function delete_user(Request $request, $id)
    {
        $user = User::find($id);
        // Supprimer l'utilisateur
        $user->delete();
        // Effectuer une action supplémentaire après la suppression de l'utilisateur si nécessaire
        $user = User::orderBy('created_at', 'desc')->paginate(3);
        return view('Admin_SGBD.Home', compact('user'));
    }


    // Generate PDF
    public function createPDF()
    {
        // retreive all records from db
        $data = user::all();
        // share data to view
        view()->share('user', $data);
        $pdf = PDF::loadView('Admin_SGBD.pdf_view', $data = ['name', 'email', 'poste', 'created_at']);
        //  download PDF file with download method
        return $pdf->download('listeUser.pdf');
    }
}
