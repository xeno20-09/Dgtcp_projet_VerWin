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
        $liste = listedevise::all();

        $devise = demandes::select('devise')
            ->groupBy('devise')
            //->orderBy('devise', 'desc')
            ->get();

        // Parcourez chaque groupe pour calculer le total
        /*         foreach ($groupedDemandes as $devise => $demandesParDevise) {
            $total = $demandesParDevise->sum('montant');
            $totalsParDevise[$devise] = $total;
        } */

        return view('Admin_SGBD.etats', compact('user', 'liste', 'date', 'devise'));
    }

    public function test()
    {

        $categories = demandes::select('devise', DB::raw('SUM(montant) as total'))
            ->groupBy('devise')
            //->orderBy('devise', 'desc')
            ->get();
        // dd($categories);

        return view('Admin_SGBD.test', compact('categories'));
    }

    public function getpays()
    {

        $liste = listedevise::all();
        $devise = demande::all();
        // Utilisez la méthode groupBy pour regrouper les demandes par devise
        /* DB::raw('SUM(montant) as total') signifie "calcule la somme de la colonne 'montant' dans la table de la base de données
         et donne-lui le nom 'total'".Cela permet de récupérer le total calculé dans les résultats de la requête avec le nom 
         "total". */

        $grouped = demandes::select('nationalite', DB::raw('SUM(montant) as total'))
            ->groupBy('nationalite')
            //->orderBy('devise', 'desc')
            ->get();


        return view('Admin_SGBD.etatpays', compact('grouped', 'devise'));
    }


    public function getdevis()
    {

        $liste = listedevise::all();
        $devise = demande::all();
        // Utilisez la méthode groupBy pour regrouper les demandes par devise
        /* DB::raw('SUM(montant) as total') signifie "calcule la somme de la colonne 'montant' dans la table de la base de données
         et donne-lui le nom 'total'".Cela permet de récupérer le total calculé dans les résultats de la requête avec le nom 
         "total". */
        $groupedDemandes = demandes::select('devise', DB::raw('SUM(montant) as total'))
            ->groupBy('devise')
            //->orderBy('devise', 'desc')
            ->get();

        $categories = demandes::select('devise', DB::raw('SUM(montant) as total'))
            ->groupBy('devise')
            //->orderBy('devise', 'desc')
            ->get();
        return view('Admin_SGBD.etatdevise', compact('groupedDemandes', 'categories'));
    }


    public function getsociete()
    {

        $liste = listedevise::all();
        $devise = demande::all();
        // Utilisez la méthode groupBy pour regrouper les demandes par devise
        /* DB::raw('SUM(montant) as total') signifie "calcule la somme de la colonne 'montant' dans la table de la base de données
         et donne-lui le nom 'total'".Cela permet de récupérer le total calculé dans les résultats de la requête avec le nom 
         "total". */

        $group = demandes::select('nomsociete', DB::raw('SUM(montant) as total'))
            ->groupBy('nomsociete')
            //->orderBy('devise', 'desc')
            ->get();

        return view('Admin_SGBD.etatsociete', compact('group', 'devise'));
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

        if ($status != 'All') {

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


            $number = count($demande);

            return view('Admin_SGBD.liste', compact('demande', 'sdate', 'fdate', 'status', 'number', 'user', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
        } else {

            // Utilisez la méthode whereNotNull pour vous assurer que les champs ne sont pas vides
            $demande = demande::whereBetween('date', [$fdate, $sdate])
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



            $number = count($demande);
            return view('Admin_SGBD.liste', compact('demande', 'sdate', 'fdate', 'status', 'number', 'user', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
        }
    }


    public function laliste(Request $request)
    {
        // Récupérez les données du formulaire
        $status = $request->input('status2');
        $fdate = $request->input('fdate2');
        $sdate = $request->input('sdate2');
        $devise = $request->input('devise');
        //  dd($status, $fdate, $sdate, $devise);
        if ($status != 'All') {

            // Utilisez la méthode whereNotNull pour vous assurer que les champs ne sont pas vides
            $demande = demande::where('status_dmd', $status)
                ->whereBetween('date', [$fdate, $sdate])
                ->where('devise', $devise)
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


            $number = count($demande);
            //dd($demande);
            return view('Admin_SGBD.laliste', compact('demande', 'sdate', 'devise', 'fdate', 'status', 'number', 'user', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
        } else {

            // Utilisez la méthode whereNotNull pour vous assurer que les champs ne sont pas vides
            $demande = demande::whereBetween('date', [$fdate, $sdate])
                ->where('devise', $devise)

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

            // dd($demande);
            $number = count($demande);

            return view('Admin_SGBD.laliste', compact('demande', 'sdate', 'devise', 'fdate', 'status', 'number', 'user', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
        }
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



        return view('Admin_SGBD.detaille_demande', compact('demande', 'sdate', 'devise', 'fdate', 'piece', 'user', 'dmd_n_lu', 'jointure', 'jointure1', 'jointure2', 'jointure3'));
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

    public function listePDF($status, $sdate, $fdate)
    {
        /*         // retreive all records from db
        $data = user::all();
        // share data to view
        view()->share('user', $data);
        $pdf = PDF::loadView('Admin_SGBD.pdf_view', $data = ['name', 'email', 'poste', 'created_at']);
        //  download PDF file with download method
        return $pdf->download('listeUser.pdf'); */

        if ($status != 'All') {
            $demande = demande::where('status_dmd', $status)
                ->whereBetween('date', [$fdate, $sdate])

                ->get();
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
            view()->share('demande', $demande);
            $pdf = PDF::loadView('Admin_SGBD.pdf_view1', $demande = ['numero_doss', 'date', 'montant', 'devise', 'montant_con', 'staus_dmd']);
            return $pdf->download('listedemande.pdf');
        } else {
            $demande = demande::whereBetween('date', [$fdate, $sdate])
                ->get();
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
            view()->share('demande', $demande);
            $pdf = PDF::loadView('Admin_SGBD.pdf_view1', $demande = ['numero_doss', 'date', 'montant', 'devise', 'montant_con', 'staus_dmd']);
            return $pdf->download('listedemande.pdf');
        }
    }

    public function lalistePDF($status, $sdate, $fdate, $devise)
    {
        /*         // retreive all records from db
        $data = user::all();
        // share data to view
        view()->share('user', $data);
        $pdf = PDF::loadView('Admin_SGBD.pdf_view', $data = ['name', 'email', 'poste', 'created_at']);
        //  download PDF file with download method
        return $pdf->download('listeUser.pdf'); */

        if ($status != 'All') {
            $demande = demande::where('status_dmd', $status)
                ->whereBetween('date', [$fdate, $sdate])
                ->where('devise', $devise)
                ->get();
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
            view()->share('demande', $demande);
            $pdf = PDF::loadView('Admin_SGBD.pdf_view1', $demande = ['numero_doss', 'date', 'montant', 'devise', 'montant_con', 'staus_dmd']);
            return $pdf->download('listedemande.pdf');
        } else {
            $demande = demande::whereBetween('date', [$fdate, $sdate])
                ->where('devise', $devise)
                ->get();
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
            view()->share('demande', $demande);
            $pdf = PDF::loadView('Admin_SGBD.pdf_view1', $demande = ['numero_doss', 'date', 'montant', 'devise', 'montant_con', 'staus_dmd']);
            return $pdf->download('listedemande.pdf');
        }
    }



    public function lalisteetatsPDF($test)
    {
        // dd($test);

        if ($test == 'Devise') {
            $liste = listedevise::all();

            $devise = DB::table('demandes')
                ->select('devise', DB::raw('SUM(montant) as total'))
                ->groupBy('devise')
                ->get();

            view()->share([
                'devise' => $devise,
                'test' => $test,
            ]);

            $pdf = PDF::loadView('Admin_SGBD.pdf_view2', $devise = ['devise', 'nationalite', 'nomsociete', 'total']);
            return $pdf->download('listeetats.pdf');
        }







        if ($test == 'Pays') {

            $liste = listedevise::all();
            $devis = demande::all();
            $grouped = demandes::select('nationalite', DB::raw('SUM(montant) as total'))
                ->groupBy('nationalite')
                ->get();
            view()->share([
                'grouped' => $grouped,
                'test' => $test,
            ]);
            /*             foreach ($grouped as $group) {
                $nationalite = $group->nationalite;
                $devis = Demande::where('nationalite', $nationalite)->get();
                view()->share([
                    'grouped' => $grouped,
                    'test' => $test,
                    'devis' => $devis,
                ]);
            }
 */

            $pdf = PDF::loadView('Admin_SGBD.pdf_view2', $grouped = ['devise', 'nationalite', 'nomsociete', 'total']);
            return $pdf->download('listeetats.pdf');
        }


        if ($test == 'Société') {

            $liste = listedevise::all();
            $devise = demande::all();
            $group = demandes::select('nomsociete', 'montant', 'devise')
                ->groupBy('nomsociete', 'montant', 'devise')
                ->get();

            view()->share([
                'group' => $group,
                'test' => $test,
            ]);
            $pdf = PDF::loadView('Admin_SGBD.pdf_view2', $group = ['devise', 'montant', 'nomsociete']);
            return $pdf->download('listeetats.pdf');
        }
    }
}
