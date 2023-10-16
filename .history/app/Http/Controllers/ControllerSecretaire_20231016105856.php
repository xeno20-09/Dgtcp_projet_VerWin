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
        $apiKey = "b662fd153a32369c7a8e4966d7246ff0";
        $toCurrency = "XOF";
        $amount = $data['montant_in'];


        // set API Endpoint, access key, required parameters
        $endpoint = 'convert';
        $access_key = 'b662fd153a32369c7a8e4966d7246ff0';

        $from = 'USD';
        $to = 'XOF';
        $amount = $data['montant_in'];
        $date = date('Y-m-d');        // initialize CURL:
        $ch = curl_init('http://api.exchangerate.host/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //http://api.exchangerate.host/list'?access_key' = b662fd153a32369c7a8e4966d7246ff0
        $url = curl_init('http://api.exchangerate.host/historical?access_key=' . $access_key . '&date=' . $date . '&source=' . 'XOF'.'&currencies' = .$currencies);
        // get the (still encoded) JSON data:
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);

        $aa = curl_exec($url);
        curl_close($url);
        $r = json_decode($aa, true);
        $q = $r['quotes'];
        $val = [];
        $dev = [];

        foreach ($q as $devise => $valeur) {
            $val[] = 1 / $valeur;
            $dev[] = substr($devise, 3, 6);
        }


        $u = array_keys($q);

        $n = count($u);
        unset($u[132]);
        unset($u[153]);
        unset($u[159]);
        unset($u[160]);
        unset($u[161]);
        unset($u[162]);
        unset($u[163]);
        unset($u[166]);
        unset($u[21]);
        unset($u[25]);
        unset($u[30]);
        unset($u[35]);

        unset($dev[132]);
        unset($dev[153]);
        unset($dev[159]);
        unset($dev[160]);
        unset($dev[161]);
        unset($dev[162]);
        unset($dev[163]);
        unset($dev[166]);
        unset($dev[21]);
        unset($dev[25]);
        unset($dev[30]);
        unset($dev[35]);

        unset($val[132]);
        unset($val[153]);
        unset($val[159]);
        unset($val[160]);
        unset($val[161]);
        unset($val[162]);
        unset($val[163]);
        unset($val[166]);
        unset($val[21]);
        unset($val[25]);
        unset($val[30]);
        unset($val[35]);
        $unwantedKeys = [21, 25, 30, 35, 132, 153, 159, 160, 161, 162, 163, 166];

        $new = [];
        $valeur = [];
    
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
             */"GBP" => "Livre sterling",
            /* "GEL" => "Lari géorgien",
            "GGP" => "Livre de Guernesey",
             */"GHS" => "Cedi ghanéen",
            /* "GIP" => "Livre de Gibraltar",
            "GMD" => "Dalasi gambien",
             */"GNF" => "Franc guinéen",
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
            "USD" => "Dollar des États-Unis",
            "UYU" => "Peso uruguayen",
            "UZS" => "Som ouzbek",
            "VES" => "Bolivar vénézuélien",
            "VND" => "Dong vietnamien",
            "VUV" => "Vatu vanuatais",
            "WST" => "Tala samoan",
            */ "XAF" => "Franc CFA d'Afrique centrale",
           /*  "YER" => "Rial yéménite",
            "ZAR" => "Rand sud-africain",
            "ZMW" => "Kwacha zambien",
            "ZWL" => "Dollar zimbabwéen", */
        ];

        $pays = []; // Créez un tableau pour stocker les noms de devises

        foreach ($unwantedKeys as $key) {
            unset($u[$key]);
        }

        foreach ($u as $key => $value) {
            $casse = substr($value, 3, 6);
            $new[] = $casse;
        }

        foreach ($new as $key => $value) {
            foreach ($codeToDevise as $key1 => $value1) {
                if ($value == $key1) {
                    $pays[] = $value1;
                }
            }
        }

        foreach ($val as $key => $value) {
            $valeur[] = $value;
        }
        //$cmp = array_diff($dev, $pays);

        //  dd($cmp, $dev, $pays, $val, $valeur);

        foreach ($valeur as $index => $valeur) {
            $devise = $pays[$index];

            // Créez une nouvelle instance du modèle Devise
            $nouvelleDevise = new devises();
            $nouvelleDevise->id_user = Auth::user()->id;
            $nouvelleDevise->date = $date;
            $nouvelleDevise->devise = $devise;
            $nouvelleDevise->valeur = $valeur;

            // Enregistrez la nouvelle instance dans la base de données
            $nouvelleDevise->save();
        }
        $numbercode = count($pays);

        dd($nouvelleDevise);
        return redirect('/ListeDemandes')->with('demande', 'dmd_back', 'dmd_n_lu', 'user');
















        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $conversionResult = json_decode($json, true);

        // access the conversion result
        //echo $conversionResult['result'];
        dd($conversionResult);

        //dd($convertedObj);
        $dmd_secretaire->montant_con = $conversionResult['result'];
        //dd($convertedObj);
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

        /*    // Utilisez libphonenumber pour formater le numéro de téléphone
        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        $numero = $phoneNumberUtil->parse($data['tel_client'], null);

        // Récupérez le code de pays (par exemple, "US" pour les États-Unis)
        $codePays = $phoneNumberUtil->getRegionCodeForNumber($numero);
        //dd($codePays);

        // Tableau de tableaux avec des données de code de pays et de noms de pays
        $paysData = [
            ["Afghanistan", "af", "93"],
            ["Albania", "al", "355"],
            ["Algeria", "dz", "213"],
            ["American Samoa", "as", "684"],
            ["Andorra", "ad", "376"],
            ["Angola", "ao", "244"],
            ["Anguilla", "ai", "1"],
            ["Antigua and Barbuda", "ag", "1"],
            ["Argentina", "ar", "54"],
            ["Armenia", "am", "374"],
            ["Aruba", "aw", "297"],
            ["Ascension Island", "ac", "247"],
            ["Australia", "au", "61"],
            ["Austria", "at", "43"],
            ["Azerbaijan", "az", "994"],
            ["Bahamas", "bs", "1"],
            ["Bahrain", "bh", "973"],
            ["Bangladesh", "bd", "880"],
            ["Barbados", "bb", "1"],
            ["Belarus", "by", "375"],
            ["Belgium", "be", "32"],
            ["Belize", "bz", "501"],
            ["Benin", "bj", "229"],
            ["Bermuda", "bm", "1"],
            ["Bhutan", "bt", "975"],
            ["Bolivia", "bo", "591"],
            ["Bosnia and Herzegovina", "ba", "387"],
            ["Botswana", "bw", "267"],
            ["Brazil", "br", "55"],
            ["British Indian Ocean Territory", "io", "246"],
            ["British Virgin Islands", "vg", "1"],
            ["Brunei", "bn", "673"],
            ["Bulgaria", "bg", "359"],
            ["Burkina Faso", "bf", "226"],
            ["Burundi", "bi", "257"],
            ["Cambodia", "kh", "855"],
            ["Cameroon", "cm", "237"],
            ["Canada", "CA", "1"],
            ["Cape Verde", "cv", "238"],
            ["Caribbean Netherlands", "bq", "599", 1, ["3", "4", "7"]],
            ["Cayman Islands", "ky", "1", 12, ["345"]],
            ["Central African Republic", "cf", "236"],
            ["Chad (Tchad)", "td", "235"],
            ["Chile", "cl", "56"],
            ["China", "cn", "86"],
            ["Christmas Island", "cx", "61"],
            ["Cocos Islands", "cc", "61", 1, ["89162"]],
            ["Colombia", "co", "57"],
            ["Comoros", "km", "269"],
            ["Congo (DRC)", "cd", "243"],
            ["Congo (Congo-Brazzaville)", "cg", "242"],
            ["Cook Islands", "ck", "682"],
            ["Costa Rica", "cr", "506"],
            ["Côte d’Ivoire", "ci", "225"],
            ["Croatia (Hrvatska)", "hr", "385"],
            ["Cuba", "cu", "53"], ["Curaçao", "cw", "599", 0],
            ["Cyprus ", "cy", "357"],
            ["Czech Republic", "cz", "420"],
            ["Denmark", "dk", "45"],
            ["Djibouti", "dj", "253"],
            ["Dominica", "dm", "1", 13, ["767"]],
            ["Dominican Republic ", "do", "1", 2, ["809", "829", "849"]],
            ["Ecuador", "ec", "593"],
            ["Egypt", "eg", "20"],
            ["El Salvador", "sv", "503"],
            ["Equatorial Guinea ", "gq", "240"],
            ["Eritrea", "er", "291"],
            ["Estonia", "ee", "372"],
            ["Eswatini", "sz", "268"],
            ["Ethiopia", "et", "251"],
            ["Falkland Islands", "fk", "500"],
            ["Faroe Islands", "fo", "298"],
            ["Fiji", "fj", "679"],
            ["Finland", "fi", "358", 0],
            ["France", "fr", "33"],
            ["French Guiana", "gf", "594"],
            ["French Polynesia", "pf", "689"],
            ["Gabon", "ga", "241"],
            ["Gambia", "gm", "220"],
            ["Georgia", "ge", "995"],
            ["Germany", "de", "49"],
            ["Ghana", "gh", "233"],
            ["Gibraltar", "gi", "350"],
            ["Greece", "gr", "30"],
            ["Greenland", "gl", "299"],
            ["Grenada", "gd", "1", 14, ["473"]],
            ["Guadeloupe", "gp", "590", 0],
            ["Guam", "gu", "1", 15, ["671"]],
            ["Guatemala", "gt", "502"],
            ["Guernsey", "gg", "44", 1, ["1481", "7781", "7839", "7911"]],
            ["Guinea ", "gn", "224"],
            ["Guinea-Bissau ", "gw", "245"],
            ["Guyana", "gy", "592"],
            ["Haiti", "ht", "509"],
            ["Honduras", "hn", "504"],
            ["Hong Kong", "hk", "852"],
            ["Hungary", "hu", "36"],
            ["Iceland", "is", "354"],
            ["India", "in", "91"],
            ["Indonesia", "id", "62"],
            ["Iran", "ir", "98"],
            ["Iraq", "iq", "964"],
            ["Ireland", "ie", "353"],
            ["Isle of Man", "im", "44", 2, ["1624", "74576", "7524", "7924", "7624"]],
            ["Israel", "il", "972"],
            ["Italy (Italia)", "it", "39", 0],
            ["Jamaica", "jm", "1", 4, ["876", "658"]],
            ["Japan", "jp", "81"],
            ["Jersey", "je", "44", 3, ["1534", "7509", "7700", "7797", "7829", "7937"]],
            ["Jordan", "jo", "962"],
            ["Kazakhstan", "kz", "7", 1, ["33", "7"]],
            ["Kenya", "ke", "254"],
            ["Kiribati", "ki", "686"],
            ["Kosovo", "xk", "383"], ["Kuwait", "kw", "965"],
            ["Kyrgyzstan", "kg", "996"],
            ["Laos", "la", "856"],
            ["Latvia", "lv", "371"],
            ["Lebanon", "lb", "961"],
            ["Lesotho", "ls", "266"],
            ["Liberia", "lr", "231"],
            ["Libya ", "ly", "218"],
            ["Liechtenstein", "li", "423"],
            ["Lithuania", "lt", "370"],
            ["Luxembourg", "lu", "352"],
            ["Macau", "mo", "853"],
            ["Madagascar", "mg", "261"],
            ["Malawi", "mw", "265"],
            ["Malaysia", "my", "60"],
            ["Maldives", "mv", "960"],
            ["Mali", "ml", "223"],
            ["Malta", "mt", "356"],
            ["Marshall Islands", "mh", "692"],
            ["Martinique", "mq", "596"],
            ["Mauritania", "mr", "222"],
            ["Mauritius", "mu", "230"],
            ["Mayotte", "yt", "262", 1, ["269", "639"]],
            ["Mexico ", "mx", "52"],
            ["Micronesia", "fm", "691"],
            ["Moldova", "md", "373"],
            ["Monaco", "mc", "377"],
            ["Mongolia", "mn", "976"],
            ["Montenegro", "me", "382"],
            ["Montserrat", "ms", "1", 16, ["664"]],
            ["Morocco ", "ma", "212", 0],
            ["Mozambique (Moçambique)", "mz", "258"],
            ["Myanmar", "mm", "95"],
            ["Namibia ", "na", "264"],
            ["Nauru", "nr", "674"],
            ["Nepal", "np", "977"],
            ["Netherlands", "nl", "31"],
            ["New Caledonia", "nc", "687"],
            ["New Zealand", "nz", "64"],
            ["Nicaragua", "ni", "505"],
            ["Niger", "ne", "227"],
            ["Nigeria", "ng", "234"],
            ["Niue", "nu", "683"],
            ["Norfolk Island", "nf", "672"],
            ["North Korea", "kp", "850"],
            ["North Macedonia", "mk", "389"],
            ["Northern Mariana Islands", "mp", "1", 17, ["670"]],
            ["Norway ", "no", "47", 0],
            ["Oman ", "om", "968"],
            ["Pakistan", "pk", "92"],
            ["Palau", "pw", "680"],
            ["Palestine", "ps", "970"],
            ["Panama", "pa", "507"],
            ["Papua New Guinea", "pg", "675"],
            ["Paraguay", "py", "595"],
            ["Peru", "pe", "51"],
            ["Philippines", "ph", "63"],
            ["Poland", "pl", "48"],
            ["Portugal", "pt", "351"],
            ["Puerto Rico", "pr", "1", 3, ["787", "939"]],
            ["Qatar", "qa", "974"],
            ["Réunion", "re", "262", 0],
            ["Romania", "ro", "40"],
            ["Russia", "ru", "7", 0],
            ["Rwanda", "rw", "250"],
            ["Saint Barthélemy", "bl", "590", 1],
            ["Saint Helena", "sh", "290"],
            ["Saint Kitts and Nevis", "kn", "1", 18, ["869"]],
            ["Saint Lucia", "lc", "1", 19, ["758"]],
            ["Saint Martin ", "mf", "590", 2],
            ["Saint Pierre and Miquelon ", "pm", "508"],
            ["Saint Vincent and the Grenadines", "vc", "1", 20, ["784"]],
            ["Samoa", "ws", "685"],
            ["San Marino", "sm", "378"],
            ["São Tomé and Príncipe", "st", "239"],
            ["Saudi Arabia", "sa", "966"],
            ["Senegal", "sn", "221"],
            ["Serbia", "rs", "381"],
            ["Seychelles", "sc", "248"],
            ["Sierra Leone", "sl", "232"],
            ["Singapore", "sg", "65"],
            ["Sint Maarten", "sx", "1", 21, ["721"]],
            ["Slovakia ", "sk", "421"],
            ["Slovenia ", "si", "386"],
            ["Solomon Islands", "sb", "677"],
            ["Somalia ", "so", "252"],
            ["South Africa", "za", "27"],
            ["South Korea", "kr", "82"],
            ["South Sudan", "ss", "211"],
            ["Spain", "es", "34"],
            ["Sri Lanka", "lk", "94"],
            ["Sudan", "sd", "249"],
            ["Suriname", "sr", "597"],
            ["Svalbard and Jan Mayen", "sj", "47", 1, ["79"]],
            ["Sweden", "se", "46"],
            ["Switzerland", "ch", "41"],
            ["Syria", "sy", "963"],
            ["Taiwan", "tw", "886"],
            ["Tajikistan", "tj", "992"],
            ["Tanzania", "tz", "255"],
            ["Thailand", "th", "66"],
            ["Timor-Leste", "tl", "670"],
            ["Togo", "tg", "228"],
            ["Tokelau", "tk", "690"],
            ["Tonga", "to", "676"],
            ["Trinidad and Tobago", "tt", "1", 22, ["868"]],
            ["Tunisia", "tn", "216"],
            ["Turkey", "tr", "90"],
            ["Turkmenistan", "tm", "993"],
            ["Turks and Caicos Islands", "tc", "1", 23, ["649"]],
            ["Tuvalu", "tv", "688"],
            ["U.S. Virgin Islands", "vi", "1", 24, ["340"]],
            ["Uganda", "ug", "256"],
            ["Ukraine ", "ua", "380"],
            ["United Arab Emirates", "ae", "971"],
            ["United Kingdom", "gb", "44", 0],
            ["United States", "us", "1", 0],
            ["Uruguay", "uy", "598"],
            ["Uzbekistan ", "uz", "998"],
            ["Vanuatu", "vu", "678"],
            ["Vatican City", "va", "39", 1, ["06698"]],
            ["Venezuela", "ve", "58"],
            ["Vietnam ", "vn", "84"],
            ["Wallis and Futuna", "wf", "681"],
            ["Western Sahara ", "eh", "212", 1, ["5288", "5289"]],
            ["Yemen", "ye", "967"],
            ["Zambia", "zm", "260"],
            ["Zimbabwe", "zw", "263"],
            ["Åland Islands", "ax", "358"]
        ]; */
        /*         $nomPays = null;
        // Parcourez le tableau de tableaux pour trouver le nom du pays correspondant
        for ($i = 0; $i < count($paysData); $i++) {
            if ($paysData[$i][1] === $codePays) {
                $nomPays = $paysData[$i][0];
                break;
            }
        }

        if ($nomPays === null) {
            // Si le code de pays n'est pas trouvé dans le tableau, vous pouvez définir une valeur par défaut
            $nomPays = "Pays inconnu";
        }
 */
        //dd($dmd_secretaire);
        // Sauvegarde du modèle en base de données
        $dmd_secretaire->save();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_secret', '=', $id)->where('vu_secret', '=', 1)->get();
        $le_n_dmd = count($demande);
        $dmd_back = count(demande::where('back_secret', '=', 1)->where('vu_secret', '=', 0)->get());
        //return view('secretaire.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }
    /************************************Sauvegarder une demande************************************************ */

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
