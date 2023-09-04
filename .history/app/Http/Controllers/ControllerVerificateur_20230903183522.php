<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use App\Models\pieces as piece;
use AmrShawky\LaravelCurrency\Facade\Currency;

use Illuminate\Support\Facades\DB;
use Nette\Utils\FileInfo;

class ControllerVerificateur extends Controller
{
    public function home()
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
        $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
        $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
        $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.Home', compact('user', 'dmd_back', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function liste_demande_n(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('status_dmd', '=', 'En cours')->where('vu_secret', '=', 1)->where('nom_benefi', '=', null)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.liste_demande_n', compact('user', 'dmd_back', 'demande', 'jointure', 'dmd_n_lu'));
    }
    public function formulaire(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();

        $le_n_dmd = count($demande);

        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.form_demande', compact('demande', 'dmd_back', 'user', 'dmd_n_lu'));
    }

    public function  form(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());


        return view('verificateur.formv_demande_mj', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }

    public function   form_corre(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());


        return view('verificateur.formv_demande_corr', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }
    public function checkref(Request $request, $idm)
    {
        $id = Auth::id();
        $data = $request->all();

        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $demande = (demande::where('id', '=', $idm)->get());
        $demand = (demande::where('id', '=', $idm)->first());
        $montantdmd = $demand->montant;
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
        $date = now();
        $bon = 0;
        $bad = 0;
        $referencesPieces = $data['reference'];
        for ($i = 0; $i < count($referencesPieces); $i++) {

            $dmd_verificateur = piece::where('referencespiece', '=', $referencesPieces[$i])->first()/* find($referencesPieces[$i]) */;
            if ($dmd_verificateur != null) {

                if (($dmd_verificateur != null) || ($dmd_verificateur == null)) {

                    if (($dmd_verificateur->montantrestant != 0) && ($dmd_verificateur->montantligne != 0)) {
                        $bon++;
                    }
                    if (($dmd_verificateur->montantrestant == null) && ($dmd_verificateur->montantligne != 0)) {
                        $bad++;
                    }
                }
            }

            if (($bon == $demand->nombre_doc)) {
                $e = 'ok';
                $restant = $dmd_verificateur->montantrestant;

                return view('verificateur.infopiece', compact('montantdmd', 'restant', 'referencesPieces', 'e', 'dmd_back', 'date', 'demande', 'dmd_n_lu', 'user'));
            }
            if (($bon == 0) && ($bad == 0)) {
                $restant = null;
                $e = 'non';
                return view('verificateur.infopiece', compact('montantdmd', 'restant', 'referencesPieces', 'e', 'dmd_back', 'date', 'demande', 'dmd_n_lu', 'user'));
            } else {

                return 'ya unn soucis';
            }
        }
        if ($dmd_verificateur == null) {
            return view('verificateur.infopiece', compact('montantdmd', 'referencesPieces', 'dmd_back', 'date', 'demande', 'dmd_n_lu', 'user'));
        }
    }

    public function store_piece_dmd(Request $request, $id_d)
    {
        $id = Auth::id();
        $data = $request->all();

        if (isset($data['libellepiece'])) {
            $libellePieces = $data['libellepiece'];
            $referencesPieces = $data['referencespiece'];
            $datesPieces = $data['date_piece'];
            $montantLignes = $data['montantligne'];

            $dmd_verificateur = Demande::find($id_d);
            $montantdmd = $dmd_verificateur->montant;
            $idv = $dmd_verificateur->id_verifi;
            $id_verificateur = User::find($idv);
            $n_verificateur = $id_verificateur->name;
            $num = $dmd_verificateur->numero_doss;

            for ($i = 0; $i < count($libellePieces); $i++) {
                $dmd_pieces = new Piece();
                $dmd_pieces->id_dmd = $id_d;
                $checkexist = Piece::where('referencespiece', $referencesPieces[$i])->where('referencespiece', $referencesPieces[$i])->first();

                $dmd_pieces->libellepiece = $libellePieces[$i];
                $dmd_pieces->referencespiece = $referencesPieces[$i];
                $dmd_pieces->date = $datesPieces[$i];
                $dmd_pieces->montantligne = $montantLignes[$i];
                $dmd_pieces->nom_d = $dmd_verificateur->nom_client;
                $dmd_pieces->nom_b = $dmd_verificateur->nom_benefi;
                $dmd_pieces->nom_v = $n_verificateur;
                $dmd_pieces->numero_doss = $num;
                if ($checkexist == null) {
                    $dmd_pieces->montantinitial = $dmd_verificateur->montant;
                } else {
                    $dmd_pieces->montantinitial = $checkexist->montantrestant;
                }
                $dernier_piece_enregistre = Piece::where('id_dmd', $id_d)->orderByDesc('created_at')->first();

                if ($i == 0) {
                    /*    if (Piece::where('libellepiece', $libellePieces[$i])->orderByDesc('created_at')->first()) {
                        $test = Piece::where('libellepiece', $libellePieces[$i])->orderByDesc('created_at')->first();
                        $dmd_pieces->montantrestant = $test->montantrestant - $montantLignes[$i];
                    } else { */
                    // Pour la première itération, calculez montantrestant en fonction de montantinitial
                    if ($dernier_piece_enregistre) {
                        $dmd_pieces->montantrestant =   $dmd_pieces->montantrestant -  $montantdmd;
                    } else {
                        $dmd_pieces->montantrestant =  $montantLignes[$i] - $dmd_pieces->montantinitial;
                    }
                    /* } */
                }


                if ($i != 0) {
                    // Pour les itérations suivantes, obtenez le montantrestant du dernier enregistrement de pièce enregistré
                    dd($checkexist);
                    if ($dernier_piece_enregistre) {

                        $dmd_pieces->montantrestant = $montantLignes[$i] - $dernier_piece_enregistre->montantrestant;
                    } else {
                        // Aucun enregistrement de pièce précédent, utilisez montantinitial
                        $dmd_pieces->montantrestant = $montantLignes[$i] - $dmd_pieces->montantinitial;
                    }
                }


                //  dd($dmd_pieces);

                // Enregistrer dans la base de données
                $dmd_pieces->save();
            }
            /*     for ($i = 0; $i < count($libellePieces); $i++) {

                $sum = Piece::where('id_dmd', $id_d)->first();

                if ($montantLignes[$i] == null) {

                    $dmd_pieces->montantrestant = $sum->montantrestant;
                } else {
                    $dmd_pieces->montantrestant = $sum->montantinitial - $montantLignes[$i];
                }
            }
            $dmd_pieces->update(); */
        }
        /*      $sum = Piece::where('id_dmd', $id_d)->sum('montantligne');
        $dmd_verificateur->montant = $sum;
        $devise = $dmd_verificateur->devise;

        $convertedObj = Currency::convert()
            ->from($devise)
            ->to('XOF')
            ->amount($sum);
        $montant_con = $convertedObj->get();
        $dmd_verificateur->montant_con = $montant_con;
        $dmd_verificateur->update(); */
        $demande = Piece::where('nom_v', $n_verificateur)->get();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
         
        return view('verificateur.recap_pieces', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }

    public function store(Request $request, $idc)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();


        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_verificateur = demande::find($idc);
        $dmd_verificateur->nom_benefi = $data['nom_benifi'];
        $dmd_verificateur->prenom_benefi = $data['prenom_benifi'];
        $dmd_verificateur->profess_benefi =  $data['profess_benifi'];
        $dmd_verificateur->pays_benifi = $data['pays_benifi'];

        if ($dmd_verificateur->back_verifi == 1) {
            $dmd_verificateur->back_verifi = 0;
        } else {
            $dmd_verificateur->back_verifi = 0;
        }
        $dmd_verificateur->banque_benefi = $data['banque_benifi'];
        $dmd_verificateur->num_compt_benefi = $data['num_compt_benifi'];
        $dmd_verificateur->id_verifi =  $id;

        $dmd_verificateur->pieces = $data['pieces_doss'];

        // Utilisez la fonction explode pour diviser la chaîne en mots en utilisant la virgule comme délimiteur
        $mots = $data['pieces_doss'];

        // Comptez les mots
        //$nombreDeMots = count($mots);

        $compteurVirgule = 0;

        // Parcours de la chaîne de caractères
        for ($i = 0; $i < strlen($mots); $i++) {
            if ($mots[$i] === ',') {
                // Si le caractère courant est une virgule, incrémentez le compteur
                $compteurVirgule++;
                $compteurVirgules = $compteurVirgule + 1;
            } else {
                $compteurVirgules = 1;
            }
        }
        if ($mots == null) {
            $compteurVirgules = 0;
        }
        /*       if ($request->hasFile('file')) {
            $fileNames = [];

            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $destinationPath = 'files/';
                    $filewithoutext[] = $file->getClientOriginalName();
                    $profileFile = time() . "_" . $file->getClientOriginalName();
                    $file->move($destinationPath, $profileFile);

                    $fileNames[] = $profileFile;
                }
            }

            // Convertir le tableau de noms de fichiers en JSON
            $fileNamesJson = json_encode($fileNames);

            // Enregistrer les noms des fichiers au format JSON dans votre modèle
            $dmd_verificateur->file = $fileNamesJson;
        } */
        $dmd_verificateur->nombre_doc = $compteurVirgules;
        $dmd_verificateur->vu_verifi = 1;
        // Sauvegarde du modèle en base de données
        $dmd_verificateur->update();
        $num = $dmd_verificateur->numero_doss;
        $demande = demande::where('id_verifi', '=', $id)->where('numero_doss', '=', $num)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $user = User::where('id', '=', $id)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();



        /*    if ($request->hasFile('file')) {
            $numberinput = count($fileNames);
            $demande = demande::where('id', '=', $idc)->get();
            $demand = demande::where('id', '=', $idc)->first();
            $num = $demand->numero_doss;
            $montant = $demand->montant;
            $numo = substr($num, 0, 7);
            $changes = piece::where('numero_doss', '=', $numo)->first();
            if ($changes != null) {
                $montantrestant_a = $changes->montantrestant;
                $changes->montantrestant = $montantrestant_a - $montantrestant_a;

                $changes->save();
            }

            $file = $fileNames;
            $date = now();
            $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

            return view('verificateur.infopiece', compact('numberinput', 'dmd_back', 'filewithoutext', 'file', 'date', 'demande', 'dmd_n_lu', 'user', 'jointure'));
        } else */
        $demand = demande::where('id', '=', $idc)->first();
        $num = $demand->numero_doss;
        $montant = $demand->montant;
        /*   $numo = substr($num, 0, 7);
            $changes = piece::where('numero_doss', '=', $numo)->first();
            // $change = piece::find($num);
            // $change = piece::where('numero_doss', '=', $numo)->get();
            if ($changes != null) {
                $montantrestant_a = $changes->montantrestant;
                $changes->montantrestant = $montantrestant_a - $montant;

                $changes->save();
            } */
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
        $numberinput = $compteurVirgules;
        if ($numberinput != 0) {
            return view('verificateur.savepiece', compact('numberinput', 'demande', 'dmd_back', 'dmd_n_lu', 'user', 'jointure'));
        } else {
            return view('verificateur.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user', 'jointure'));
        }
    }

    public function store_corr(Request $request, $idc)
    {
        $id = Auth::id();
        // Récupérer toutes les données du formulaire
        $data = $request->all();


        // Création d'un nouveau modèle avec les données du formulaire
        $dmd_verificateur = demande::find($idc);
        $dmd_verificateur->nom_benefi = $data['nom_benifi'];
        $dmd_verificateur->prenom_benefi = $data['prenom_benifi'];
        $dmd_verificateur->profess_benefi =  $data['profess_benifi'];
        $dmd_verificateur->pays_benifi = $data['pays_benifi'];

        if ($dmd_verificateur->back_verifi == 1) {
            $dmd_verificateur->back_verifi = 0;
        } else {
            $dmd_verificateur->back_verifi = 0;
        }
        $dmd_verificateur->banque_benefi = $data['banque_benifi'];
        $dmd_verificateur->num_compt_benefi = $data['num_compt_benifi'];
        $dmd_verificateur->id_verifi =  $id;

        if ($request->hasFile('file')) {
            $fileNames = [];

            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $destinationPath = 'files/';
                    $filewithoutext[] = $file->getClientOriginalName();
                    $profileFile = time() . "_" . $file->getClientOriginalName();
                    $file->move($destinationPath, $profileFile);

                    $fileNames[] = $profileFile;
                }
            }

            // Convertir le tableau de noms de fichiers en JSON
            $fileNamesJson = json_encode($fileNames);

            // Enregistrer les noms des fichiers au format JSON dans votre modèle
            $dmd_verificateur->file = $fileNamesJson;
        }

        $dmd_verificateur->vu_verifi = 1;
        // Sauvegarde du modèle en base de données
        //   dd($dmd_verificateur);
        $dmd_verificateur->update();
        $demande = demande::where('id_verifi', '=', $id)->get();
        $user = User::where('id', '=', $id)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();

        /* 

        if ($request->hasFile('file')) {
            $numberinput = count($fileNames);
            $demande = demande::where('id', '=', $idc)->get();
            $demand = demande::where('id', '=', $idc)->first();
            $num = $demand->numero_doss;
            $montant = $demand->montant;
            $numo = substr($num, 0, 7);
            $changes = piece::where('numero_doss', '=', $numo)->first();
            if ($changes != null) {
                $montantrestant_a = $changes->montantrestant;
                $changes->montantrestant = $montantrestant_a - $montantrestant_a;

                $changes->save();
            }

            $file = $fileNames;
            $date = now();
            $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

            return view('verificateur.infopiece', compact('numberinput', 'dmd_back', 'filewithoutext', 'file', 'date', 'demande', 'dmd_n_lu', 'user', 'jointure'));
        } else { */
        $demand = demande::where('id', '=', $idc)->first();
        $num = $demand->numero_doss;
        $montant = $demand->montant;
        $numo = substr($num, 0, 7);
        $changes = piece::where('numero_doss', '=', $numo)->first();
        // $change = piece::find($num);
        // $change = piece::where('numero_doss', '=', $numo)->get();
        if ($changes != null) {
            $montantrestant_a = $changes->montantrestant;
            $changes->montantrestant = $montantrestant_a - $montant;

            $changes->save();


            $demande_encours = demande::where('status_dmd', '=', 'en cours')->get();
            $demande_valider = demande::where('status_dmd', '=', 'Autorisée')->get();
            $demande_echec = demande::where('status_dmd', '=', 'Rejetée')->get();
            $demande_suspendre = demande::where('status_dmd', '=', 'suspendre')->get();
            $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
            $le_n_dmd_c = count($demande_encours);
            $le_n_dmd_v = count($demande_valider);
            $le_n_dmd_e = count($demande_echec);
            $le_n_dmd_s = count($demande_suspendre);
            $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

            return view('verificateur.Home', compact('user', 'dmd_back', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
        }
    }

    public function listep()
    {
        $id = Auth::id();
        $users = User::where('id', '=', $id)->first();
        $user = User::where('id', '=', $id)->get();

        $name_v =  $users->name;
        $pieces = piece::where('nom_v', '=', $name_v)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());


        return view('verificateur.listepiece', compact('pieces', 'dmd_back', 'dmd_n_lu', 'name_v', 'user'));
    }
    public function liste(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_verifi', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user', 'jointure'));
    }

    public function   detaille(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);

        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.detaille_demande', 'dmd_back', compact('demande', 'user', 'dmd_n_lu', 'jointure'));
    }
    public function retour(Request $request, $idc)
    {

        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande = demande::find($idc);
        $demande->back_secret = 1;
        $demande->vu_verifi = 0;
        $demande->vu_secret = 0;
        //dd($demande);
        $demande->update();
        $demande = demande::where('status_dmd', '=', 'En cours')->where('vu_secret', '=', 1)->where('nom_benefi', '=', null)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.liste_demande_n', compact('user', 'dmd_back', 'demande', 'jointure', 'dmd_n_lu'));
    }

    public function listeretour(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_verifi', '=', $id)->where('back_verifi', '=', 1)->get();
        $le_n_dmd = count($demande);

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.liste_dmd_back', compact('demande', 'dmd_back', 'user', 'jointure', 'dmd_n_lu'));
    }
}
