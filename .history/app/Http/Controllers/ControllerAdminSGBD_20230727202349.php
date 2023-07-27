<?php

namespace App\Http\Controllers;

use App\Models\demandes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Facade as IlluminateFacade;

class ControllerAdminSGBD extends Controller
{
    public function home()
    {
        $id = Auth::id();
        $user = User::orderBy('created_at', 'desc')->paginate(3);
        /*    $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=',0)->get()); */
        return view('Admin_SGBD.Home', compact('user'));
    }

    public function modify_user(Request $request, $id)
    {

        $user = User::where('id', '=', $id)->get();
        /*    $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        $dmd_n_lu = count(demande::where('vu_chef_bureau', '=',0)->get()); */
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
         $user = User::orderBy('created_at', 'desc')->get();
        return view('Admin_SGBD.Home', compact('user'));
    }

    public function delete_user(Request $request, $id)
    {
        $user = User::find($id);
        // Supprimer l'utilisateur
        $user->delete();
        // Effectuer une action supplémentaire après la suppression de l'utilisateur si nécessaire
        $user = User::orderBy('created_at', 'desc')->get();
        return view('Admin_SGBD.Home', compact('user'));
    }
       

            // Generate PDF
    public function createPDF() {
        // retreive all records from db
        $data = user::all();
       // share data to view
        view()->share('user',$data);
        $pdf = PDF::loadView('Admin_SGBD.pdf_view', $data= ['name', 'email', 'poste', 'created_at']);
       //  download PDF file with download method
        return $pdf->download('listeUser.pdf'); 
      }
}
