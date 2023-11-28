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
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', 1)->where('vu_chef_bureau', '=', 0)->get());
        $dmd_back = count(demande::where('back_chef_bureau', '=', 1)->get());
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


        return view('Admin_SGBD.etatpays', compact('grouped', 'devise', 'user', 'le_n_dmd_c', 'dmd_back', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }


    public function getdevis()
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
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', 1)->where('vu_chef_bureau', '=', 0)->get());
        $dmd_back = count(demande::where('back_chef_bureau', '=', 1)->get());
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
        $codeToDevise = [
            "AED" => "Dirham des Émirats arabes unis",
            /*   "AFN" => "Afghani afghan",
                "ALL" => "Lek albanais",
                "AMD" => "Dram arménien",
                "ANG" => "Florin des Antilles néerlandaises",
                "AOA" => "Kwanza angolais",
                "ARS" => "Peso argentin",
                "AUD" => "Dollar australien",
                "AWG" => "Florin arubais",
                "AZN" => "Manat azéri",
                "BAM" => "Mark convertible de Bosnie-Herzégovine",
                "BBD" => "Dollar barbadien",
                "BDT" => "Taka bangladais",
                "BGN" => "Lev bulgare",
                "BHD" => "Dinar bahreïni",
                "BIF" => "Franc burundais",
                "BMD" => "Dollar bermudien",
                "BND" => "Dollar de Brunei",
                "BOB" => "Boliviano bolivien",
                "BRL" => "Réel brésilien",
                "BSD" => "Dollar bahaméen",
                "BTN" => "Ngultrum bhoutanais",
                "BWP" => "Pula botswanaise",
                "BYN" => "Rouble biélorusse",
                "BZD" => "Dollar bélizien",
               */  "CAD" => "Dollar canadien",
            /*  "CDF" => "Franc congolais",
                "CHF" => "Franc suisse",
                "CLP" => "Peso chilien", */
            "CNY" => "Yuan chinois",
            /*   "COP" => "Peso colombien",
                "CRC" => "Colón costaricien",
                "CUP" => "Peso cubain",
                "CVE" => "Escudo capverdien",
                "CZK" => "Couronne tchèque",
                "DJF" => "Franc djiboutien",
                "DKK" => "Couronne danoise",
                "DOP" => "Peso dominicain",
               */  "DZD" => "Dinar algérien",
            "EGP" => "Livre égyptienne",
            /*     "ERN" => "Nakfa érythréen",
                "ETB" => "Birr éthiopien", */
            "EUR" => "Euro",
            /* "FJD" => "Dollar fidjien",
                "FKP" => "Livre des îles Malouines",
                 */ "GBP" => "Livre sterling",
            /* "GEL" => "Lari géorgien",
                "GGP" => "Livre de Guernesey",
                 */ "GHS" => "Cedi ghanéen",
            /* "GIP" => "Livre de Gibraltar",
                "GMD" => "Dalasi gambien",
                 */ "GNF" => "Franc guinéen",
            "GTQ" => "Quetzal guatémaltèque",
            /*  "GYD" => "Dollar guyanais",
                "HKD" => "Dollar de Hong Kong",
                "HNL" => "Lempira hondurien",
                "HRK" => "Kuna croate",
                "HTG" => "Gourde haïtienne",
                "HUF" => "Forint hongrois",
                "IDR" => "Roupie indonésienne",
                "ILS" => "Nouveau shekel israélien",
                "IMP" => "Livre de l'île de Man",
                "INR" => "Roupie indienne",
                "IQD" => "Dinar irakien",
                "IRR" => "Rial iranien",
                "ISK" => "Couronne islandaise",
                "JEP" => "Livre de Jersey",
                "JMD" => "Dollar jamaïcain",
                "JOD" => "Dinar jordanien",
                */ "JPY" => "Yen japonais",
            /*  "KES" => "Shilling kényan",
                "KGS" => "Som kirghize",
                "KHR" => "Riel cambodgien",
                "KMF" => "Franc comorien",
                "KPW" => "Won nord-coréen",
                "KRW" => "Won sud-coréen",
                "KWD" => "Dinar koweïtien",
                "KYD" => "Dollar des îles Caïmans",
                "KZT" => "Tenge kazakh",
                "LAK" => "Kip lao",
                "LBP" => "Livre libanaise",
                "LKR" => "Roupie srilankaise",
                "LRD" => "Dollar libérien",
                "LSL" => "Loti lesothan",
                "LTL" => "Litas lituanien",
                "LVL" => "Lats letton",
                "LYD" => "Dinar libyen",
                "MAD" => "Dirham marocain",
                "MDL" => "Leu moldave",
                "MGA" => "Ariary malgache",
                "MKD" => "Denar macédonien",
                "MMK" => "Kyat birman",
                "MNT" => "Tugrik mongol",
                "MOP" => "Pataca de Macao",
                "MRO" => "Ouguiya mauritanien",
                "MUR" => "Roupie mauricienne",
                "MVR" => "Rufiyaa maldivienne",
                "MWK" => "Kwacha malawien",
                "MXN" => "Peso mexicain",
                "MYR" => "Ringgit malais",
                "MZN" => "Métical mozambicain",
                "NAD" => "Dollar namibien",
                */ "NGN" => "Naira nigérian",
            /*  "NIO" => "Cordoba nicaraguayen",
                "NOK" => "Couronne norvégienne",
                "NPR" => "Roupie népalaise",
                */ "NZD" => "Dollar néo-zélandais",
            /*    "OMR" => "Rial omanais",
                "PAB" => "Balboa panaméen",
                "PEN" => "Nouveau sol péruvien",
                "PGK" => "Kina papouanéoguinéen",
                "PHP" => "Peso philippin",
                "PKR" => "Roupie pakistanaise",
                "PLN" => "Zloty polonais",
                "PYG" => "Guarani paraguayen",
                "QAR" => "Rial qatari",
                "RON" => "Leu roumain",
                "RSD" => "Dinar serbe",
                "RUB" => "Rouble russe", */
            "RWF" => "Franc rwandais",
            "SAR" => "Riyal saoudien",
            /*  "SBD" => "Dollar des îles Salomon",
                "SCR" => "Roupie des Seychelles",
                "SDG" => "Livre soudanaise",
                "SEK" => "Couronne suédoise",
                "SGD" => "Dollar de Singapour",
                "SHP" => "Livre de Sainte-Hélène",
                "SLE" => "Leone sierra-léonais",
                "SOS" => "Shilling somalien",
                "SRD" => "Dollar du Surinam",
                "STD" => "Dobra santoméen",
                "SSP" => "Livre sud-soudanaise",
                "SYP" => "Livre syrienne",
                "SZL" => "Lilangeni swazi",
                "THB" => "Baht thaïlandais",
                "TJS" => "Somoni tadjik",
                "TMT" => "Manat turkmène",
                "TND" => "Dinar tunisien",
                "TOP" => "Pa'anga tongan",
                "TRY" => "Livre turque",
                "TTD" => "Dollar de Trinité-et-Tobago",
                "TWD" => "Dollar taïwanais",
                "TZS" => "Shilling tanzanien",
                "UAH" => "Hryvnia ukrainienne",
                "UGX" => "Shilling ougandais",
                "UYU" => "Peso uruguayen",
                "UZS" => "Som ouzbek",
                "VES" => "Bolivar vénézuélien",
                "VND" => "Dong vietnamien",
                "VUV" => "Vatu vanuatais",
                "WST" => "Tala samoan",
    
                */ "XAF" => "Franc CFA d'Afrique centrale",
            "USD" => "Dollar des États-Unis",

            /*  "YER" => "Rial yéménite",
                "ZAR" => "Rand sud-africain",
                "ZMW" => "Kwacha zambien",
                "ZWL" => "Dollar zimbabwéen", */
        ];
        return view('Admin_SGBD.etatdevise', compact('codeToDevise', 'groupedDemandes', 'categories', 'user', 'le_n_dmd_c', 'dmd_back', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }


    public function getsociete()
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
        $dmd_n_lu = count(demande::where('status_dmd', '=', 'En cours')->where('vu_chef_division', '=', 1)->where('vu_chef_bureau', '=', 0)->get());
        $dmd_back = count(demande::where('back_chef_bureau', '=', 1)->get());

        $liste = listedevise::all();
        $devise = demande::all();
        // Utilisez la méthode groupBy pour regrouper les demandes par devise
        /* DB::raw('SUM(montant) as total') signifie "calcule la somme de la colonne 'montant' dans la table de la base de données
         et donne-lui le nom 'total'".Cela permet de récupérer le total calculé dans les résultats de la requête avec le nom 
         "total". */

        $group = demandes::select('nomsociete', DB::raw('SUM(montant) as total'))
            ->groupBy('nomsociete',)
            //->orderBy('devise', 'desc')
            ->get();

        return view('Admin_SGBD.etatsociete', compact('group', 'devise', 'user', 'le_n_dmd_c', 'dmd_back', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
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
            $x = $devis->nationalite;

            $grouped = demandes::select('nationalite', 'montant', 'devise')
                ->groupBy('nationalite', 'montant', 'devise')
                ->get();
            view()->share([
                'grouped' => $grouped,
                'test' => $test,
                'devis' => $devis,
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

            $pdf = PDF::loadView('Admin_SGBD.pdf_view2', $grouped = ['devise', 'nationalite', 'montant', 'nomsociete'], $devis = ['devise', 'nationalite', 'montant']);
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
