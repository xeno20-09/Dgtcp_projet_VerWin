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
    public function checkref($libellePiece, $referencePiece, $datePiece, $montantligne, $idm)
    {
        // dd($libellePiece);

        /*   $data['pieces_doss'][$key]
                $data['ref_doss'][$key]
                $data['exp_pieces'][$key] */
        $id = Auth::id();

        $user = User::where('id', '=', $id)->get();
        $users = User::where('id', '=', $id)->first();
        $n_verificateur = $users->name;


        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $demande = (demande::where('id', '=', $idm)->get());
        $demand = (demande::where('id', '=', $idm)->first());
        $montantdmd = $demand->montant;
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
        $date = now();
        $bon = 0;
        $bad = 0;
        $referencesPieces =  $referencePiece;
        // dd($referencePiece);
        //dd($referencePiece == null);

        for ($i = count($referencesPieces) - 1; $i >= 0; $i--) {
            $dmd_verificateur = piece::where('referencespiece', '=', $referencesPieces[$i])
                ->latest('id') // Triez par ordre décroissant de la colonne 'id'
                ->first(); // Obtenez le premier résultat, qui est le dernier enregistrement

            if ($dmd_verificateur != null) {
                if (($dmd_verificateur != null) || ($dmd_verificateur == null)) {

                    if (($dmd_verificateur->montantrestant != 0) && ($dmd_verificateur->montantligne != 0)) {
                        $bon++;
                    }
                    if (($dmd_verificateur->montantrestant == 0) && ($dmd_verificateur->montantligne != 0)) {
                        $bad++;
                    }
                }
            }
            // dd($dmd_verificateur->montantrestant);

            if ($dmd_verificateur == null) {
                $restant = ' r';
            } else {
                $restant = $dmd_verificateur->montantrestant;
            }
            //dd($bad);
            if (($bon == $demand->nombre_doc) || ($bad != 0)&&) {
                $e = 'ok';
                dd($restant);
                return view('verificateur.infopiece', compact('montantligne', 'libellePiece', 'referencePiece', 'datePiece', 'montantdmd', 'restant', 'referencesPieces', 'e', 'dmd_back', 'date', 'demande', 'dmd_n_lu', 'user'));
            }
            if ($demand->nombre_doc == 0) {
                // Set some initial values
                /*              $restant = null;
                $e = 'non';

                // Find the demand by $idm
                $dmd_verificateur = Demande::find($idm);

                // Create a new Piece instance with default values
                $dmd_pieces = new Piece();
                $dmd_pieces->id_dmd = $idm;
                $dmd_pieces->libellepiece = " ";
                $dmd_pieces->referencespiece = " ";
                $dmd_pieces->montantligne = 0;
                $dmd_pieces->date = " ";
                $dmd_pieces->nom_d = $dmd_verificateur->nom_client;
                $dmd_pieces->nom_b = $dmd_verificateur->nom_benefi;
                $dmd_pieces->nom_v = $n_verificateur;
                $dmd_pieces->numero_doss = $dmd_verificateur->numero_doss;
                $dmd_pieces->montantrestant = 0;
                $dmd_pieces->montantinitial = 0;

                // Save the new Piece instance
                $dmd_pieces->save();
*/
                // Get the authenticated user
                $id = Auth::id();
                $use = User::find($id);
                $user = User::where('id', '=', $id)->get();

                // Fetch relevant demand data
                $demande = Demande::where('id_verifi', $id)->get();

                $le_n_dmd = $demande->count();
                $dmd_n_lu = Demande::where('vu_verifi', 0)->where('vu_secret', 1)->count();

                // Perform a database join
                $jointure = DB::table('users')
                    ->join('demandes', 'users.id', '=', 'demandes.id_secret')
                    ->select('demandes.*', 'users.*')
                    ->get();

                $dmd_back = Demande::where('back_verifi', 1)->count();

                // Return the view with the necessary data
                return view('verificateur.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user', 'jointure'));
            }
            if ((!($bon == $demand->nombre_doc)) && ($libellePiece[0] != null) && ($referencePiece[0] != null)) {
                $e = 'non';
                dd($restant);
                return view('verificateur.infopiece', compact('montantligne', 'libellePiece', 'referencePiece', 'datePiece', 'montantdmd', 'restant', 'referencesPieces', 'e', 'dmd_back', 'date', 'demande', 'dmd_n_lu', 'user'));
            }
        }
        if (($dmd_verificateur == null) && ($demand->nombre_doc != 0)) {
            dd($dmd_verificateur);
            return view('verificateur.infopiece', compact('montantligne', 'libellePiece', 'referencePiece', 'datePiece', 'montantdmd', 'referencesPieces', 'dmd_back', 'date', 'demande', 'dmd_n_lu', 'user'));
        }
    }

    public function store_piece_dmd(Request $request, $id_d)
    {      // Supposons que l'ID de l'utilisateur connecté est 1
        $id = Auth::id();
        $verificateur = user::find($id);
        $n_verificateur = $verificateur->name;
        // Récupération de toutes les données du formulaire soumises par l'utilisateur

        // Supposons que les données du formulaire sont correctement structurées

        // Récupération des données de la demande parente
        $dmd_verificateur = Demande::find($id_d);
        $data = $request->all();

        // Supposons que vous avez déjà effectué des vérifications sur l'existence des pièces avec les références fournies
        $themontant = 0;
        // Parcourez toutes les pièces soumises

        foreach ($data['libellepiece'] as $key => $llibellepiece) {


            $themontant = array_sum($data['montantligne']);
        }

        //dd(count($data['libellepiece']));
        // Parcourez toutes les pièces soumises
        for ($key = 0; $key < count($data['libellepiece']); $key++) {
            $dmd_pieces = new Piece();
            $dmd_pieces->id_dmd = $id_d;
            $dmd_pieces->libellepiece = $data['libellepiece'][$key];
            $dmd_pieces->referencespiece =  $data['referencespiece'][$key];
            // $dmd_pieces->$libellePiece[$key];
            $dmd_pieces->montantligne =  $data['montantligne'][$key];

            $dmd_pieces->date =  $data['date_piece'][$key];
            //dd($data['date_expi']);
            if (isset($data['date_expi'])) {
                foreach ($data['date_expi'] as $dateExpi) {
                    $dmd_pieces->dateexpi =  $dateExpi;
                }
            }


            $dmd_pieces->nom_d = $dmd_verificateur->nom_client;
            $dmd_pieces->nom_b = $dmd_verificateur->nom_benefi;
            $dmd_pieces->nom_v = $n_verificateur;
            $dmd_pieces->numero_doss = $dmd_verificateur->numero_doss;
            // Montant initial et Montant restant
            if (isset($data['montantrestant'][$key])) {
                $lastPiece = Piece::where('montantrestant', $data['montantrestant'][$key])->latest()->first();
                // Faites quelque chose avec $lastPiece ici
            } else {
                $lastPiece = 0;
            }
            $lastPiece_s = Piece::where('numero_doss', $dmd_pieces->numero_doss)->orderByDesc('created_at')->first();

            if ($lastPiece) {
                $dmd_pieces->montantinitial = $lastPiece->montantrestant;
                $dmd_pieces->montantrestant = $dmd_verificateur->montant - $lastPiece->montantrestant;
                //dd($dmd_pieces->montantrestant);
            } else if ($lastPiece_s) {
                $dmd_pieces->montantinitial = $lastPiece_s->montantrestant;
                $dmd_pieces->montantrestant =    $dmd_verificateur->montant - $themontant;
                //dd($dmd_pieces->montantrestant);
            } else {
                /*valide*/
                $dmd_pieces->montantrestant =   $dmd_verificateur->montant - $themontant;
                $dmd_pieces->montantinitial = $dmd_verificateur->montant;

                //dd($themontant);
                // dd($dmd_verificateur->montant);
                //dd($dmd_pieces->montantrestant);
                // dd( $dmd_pieces->montantinitial  ); 
            }
            //dd($dmd_pieces);
            // Enregistrez la pièce dans la base de données
            $dmd_pieces->save();
            // 
        }
        // dd($dmd_pieces);
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

        // Trouver la demande parente
        $dmd_verificateur = Demande::find($idc);

        // Mettre à jour les propriétés de la demande parente
        $dmd_verificateur->nom_benefi = $data['nom_benifi'];
        $dmd_verificateur->prenom_benefi = $data['prenom_benifi'];
        $dmd_verificateur->profess_benefi = $data['profess_benifi'];
        $dmd_verificateur->pays_benifi = $data['pays_benifi'];
        $dmd_verificateur->banque_benefi = $data['banque_benifi'];
        $dmd_verificateur->num_compt_benefi = $data['num_compt_benifi'];
        $dmd_verificateur->id_verifi = $id;

        // Compter le nombre de pièces soumises dans la demande
        if ($data['pieces_doss'][0] != null) {
            $nbr_piece = count($data['pieces_doss']);
        } else {
            $nbr_piece = 0;
        }
        // Mettre à jour la propriété nombre_doc de la demande parente
        $dmd_verificateur->nombre_doc = $nbr_piece;
        $dmd_verificateur->vu_verifi = 1;

        // Enregistrer les modifications
        $dmd_verificateur->save();

        // Rediriger vers une vue spécifique avec des données
        /*     foreach ($data['pieces_doss'] as $key => $pieces_doss) {

            ($data['pieces_doss'][$key]);
            ($data['ref_doss'][$key]);

            ($data['exp_pieces'][$key]);
            //dd($dmd_verificateur);
            $this->checkref($data['pieces_doss'][$key], $data['ref_doss'][$key], $data['exp_pieces'][$key], $idc);
            dd($data['pieces_doss'][$key]);
        } */
        //dd($data['pieces_doss']);

        // ...
        // Autres traitements
        // ...

        // Appel de la fonction checkref à l'intérieur de la boucle
        $resultat = $this->checkref(
            $libellePiece = $data['pieces_doss'], // $libellePiece
            $referencePiece = $data['ref_doss'], // $referencePiece
            $datePiece = $data['exp_pieces'],
            $montantligne = $data['montantligne'], // $datePiece
            $idc // $idm
        );
        return $resultat;
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


        $demand = demande::where('id', '=', $idc)->first();
        $num = $demand->numero_doss;
        $montant = $demand->montant;
        $numo = substr($num, 0, 7);
        $changes = piece::where('numero_doss', '=', $numo)->first();

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

        return view('verificateur.detaille_demande', compact('demande', 'dmd_back', 'user', 'dmd_n_lu', 'jointure'));
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
    public function rejet(Request $request, $idm)
    {
        $id = Auth::id();
        $users = User::where('id', '=', $id)->first();
        $user = User::where('id', '=', $id)->get();
        $rejt = demande::where('id', '=', $idm)->first();

        $piece = $rejt->pieces;
        $p = piece::where('libellepiece', '=', $piece)->first();
        $num = $rejt->numero_doss;
        $rejt->status_dmd = 'Rejetée';
        $rejt->motif = 'Rejetée pour incorformité au niveau des montants';
        $data = $request->all();
        /*  $dmd_pieces = new Piece();
        $dmd_pieces->id_dmd = $idm;
        $dmd_pieces->libellepiece = $p->libellepiece;
        $dmd_pieces->referencespiece = $p->referencespiece;
        $date = now();
        $dmd_pieces->date = $date;
        $dmd_pieces->montantligne = $p->montantligne;
        $dmd_pieces->montantrestant = 0;
        $dmd_pieces->nom_d = $p->nom_d;
        $dmd_pieces->nom_b = $p->nom_b;
        $dmd_pieces->nom_v = $users->name;
        $dmd_pieces->numero_doss = $num; */
        $name_v =  $users->name;
        $pieces = piece::where('nom_v', '=', $name_v)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->where('vu_secret', '=', 1)->get());
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        //dd($dmd_pieces);
        //$dmd_pieces->save();
        //dd($rejt);
        $rejt->update();
        return view('verificateur.listepiece', compact('pieces', 'dmd_back', 'dmd_n_lu', 'name_v', 'user'));
    }
}
