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
use App\Models\devises;
use App\Models\listedevise;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Facade as IlluminateFacade;
use App\Models\pieces as piece;

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
        $devise = demande::all();
        // Utilisez la méthode groupBy pour regrouper les demandes par devise
        $groupedDemandes = $devise->groupBy('devise');
        $groupedDemandes = $devise->groupBy('devise');

        // Parcourez chaque groupe pour calculer le total
        foreach ($groupedDemandes as $devise => $demandesParDevise) {
            $total = $demandesParDevise->sum('montant');
            $totalsParDevise[$devise] = $total;
        }

        return view('Admin_SGBD.etats', compact('user', 'date', 'groupedDemandes', 'totalsParDevise'));
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
        return redirect('/Admin')->with('user');
        /*         return view('Admin_SGBD.Home', compact('user'));
 */
    }

    public function listedmd(Request $request)
    {
        // Récupérez les données du formulaire
        $status = $request->input('status');
        $fdate = $request->input('fdate');
        $sdate = $request->input('sdate');

        // Utilisez la méthode whereNotNull pour vous assurer que les champs ne sont pas vides
        $demande = demande::where('status_dmd', $status)
            ->whereBetween('date', [$fdate, $sdate])
            ->get();
        $id = Auth::id();

        // $user = user::find($id);
        $user = user::where('id', $id)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure2 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_division')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure3 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_bureau')
            ->select('demandes.*', 'users.*')
            ->get();


        // dd(count($demande));

        return view('Admin_SGBD.liste', compact('demande', 'user', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
        // Utilisez dd() pour déboguer les données


        // Le reste de votre code ici...
    }
    public function   detailles(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure1 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_verifi')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure2 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_division')
            ->select('demandes.*', 'users.*')
            ->get();
        $jointure3 = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_chef_bureau')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_damf', '=', 0)->where('vu_chef_bureau', '=', 1)->get());
        $piece = piece::where('id_dmd', '=', $id)->first();



        return view('Admin_SGBD.detaille_demande', compact('demande', 'piece', 'user', 'dmd_n_lu', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
    }


    public function delete_user(Request $request, $id)
    {
        $user = User::find($id);
        // Supprimer l'utilisateur
        $user->delete();
        // Effectuer une action supplémentaire après la suppression de l'utilisateur si nécessaire
        $user = User::orderBy('created_at', 'desc')->paginate(3);
        return redirect('/Admin')->with('user');
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
