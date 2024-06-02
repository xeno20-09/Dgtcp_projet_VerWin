<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user as user;
use App\Models\demandes as demande;
use App\Models\pieces as piece;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\devises;
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
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
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
        $demande = demande::where('status_dmd', '=', 'En cours')
            ->where('vu_secret', '=', 1)
            ->where('nom_benefi', '=', null)
            ->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.liste_demande_n', compact('user', 'dmd_back', 'demande', 'jointure', 'dmd_n_lu'));
    }
    public function formulaire(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
       // $devise = demande::where('id', '=', $id)->get();

       $devise=$demande[0]['devise'];
        dd($devise);
$taux_d=devises::where('devise' '=' ,$devise)->l
        $le_n_dmd = count($demande);

        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
        $piece = piece::where('id_dmd', '=', $id)->get();

        return view('verificateur.form_demande', compact('demande', 'piece', 'dmd_back', 'user', 'dmd_n_lu'));
    }

    public function form(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $demande = demande::where('id', '=', $id_dmd)->get();
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
        $piece = piece::where('id_dmd', '=', $id_dmd)
            ->where('vu_verif', '=', 1)
            ->get();

        $test = piece::where('id_dmd', '=', $id_dmd)
            ->where('vu_verif', '=', 0)
            ->get();

        return view('verificateur.formv_demande_mj', compact('demande', 'test', 'piece', 'dmd_back', 'dmd_n_lu', 'user'));
    }

    public function form_corre(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $demande = demande::where('id', '=', $id_dmd)->get();
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.formv_demande_corr', compact('demande', 'dmd_back', 'dmd_n_lu', 'user'));
    }
    public function checkref($libellePiece, $referencePiece, $datePiece, $montantligne, $dateExpi, $idm)
    {
        $found = 0;
        $notfound = 0;

        for ($i = count($referencePiece) - 1; $i >= 0; $i--) {
            $dmd_verificateur = piece::where('referencespiece', '=', $referencePiece[$i])
                //->latest('id') // Triez par ordre décroissant de la colonne 'id'
                ->first(); // Obtenez le premier résultat, qui est le dernier enregistrement
            if ($dmd_verificateur) {
                $found++;
            } else {
                $notfound++;
            }
        }
        $montant = demande::where('id', '=', $idm)->first();
        $montantdmd = $montant->montant;
        if (count($referencePiece) == $notfound) {
            $restant = array_sum($montantligne) - $montantdmd;
        }
        if (count($referencePiece) == $found) {
            // $lesrestant= $dmd_verificateur->montantrestant;

            $restant = $dmd_verificateur->montantrestant;
        }
        //dd($restant);
        //
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $demande = demande::where('id', '=', $idm)->get();
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
        return view('verificateur.infopiece', compact('montantligne' /* , 'lesrestant' */, 'restant', 'found', 'notfound', 'libellePiece', 'datePiece', 'montantdmd', 'referencePiece', 'dmd_back', 'demande', 'dmd_n_lu', 'user'));
    }

    public function store_piece_dmd(Request $request, $id_d)
    {
        // Supposons que l'ID de l'utilisateur connecté est 1
        $id = Auth::id();
        $verificateur = user::find($id);
        $l_verificateur = $verificateur->lastname;
        $f_verificateur = $verificateur->firstname;

        // Récupération de toutes les données du formulaire soumises par l'utilisateur

        // Supposons que les données du formulaire sont correctement structurées

        // Récupération des données de la demande parente
        $dmd_verificateur = Demande::find($id_d);
        $data = $request->all();
        //dd($data);
        // Supposons que vous avez déjà effectué des vérifications sur l'existence des pièces avec les références fournies
        $themontant = 0;
        // Parcourez toutes les pièces soumises

        foreach ($data['libellepiece'] as $key => $llibellepiece) {
            $themontant = array_sum($data['montantligne']);
        }

        //dd(count($data['libellepiece']));
        // Parcourez toutes les pièces soumises
        for ($key = 0; $key <= count($data['libellepiece']) - 1; $key++) {
            $dmd_pieces = new Piece();
            $dmd_pieces->id_dmd = $id_d;
            $dmd_pieces->libellepiece = $data['libellepiece'][$key];
            $dmd_pieces->referencespiece = $data['referencespiece'][$key];

            if (isset($data['montantligne'][$key])) {
                $dmd_pieces->montantligne = $data['montantligne'][$key];
            } else {
                $dmd_pieces->montantligne = null;
            }

            $dmd_pieces->date = $data['date_piece'][$key];

            if (isset($data['date_expi'][$key]) && !isset($data['montantligne'][$key])) {
                $dmd_pieces->dateexpi = $data['date_expi'][$key];
            }

            $n_verificateur = $l_verificateur . ' ' . $f_verificateur;
            $dmd_pieces->nom_v = $l_verificateur . ' ' . $f_verificateur;

            $lastPiece = Piece::where('referencespiece', $data['referencespiece'][$key])->first();
            if ($lastPiece != null) {
                if ($lastPiece->montantrestant == 0) {
                    $dmd_pieces->montantrestant = 0;
                    //dd( $dmd_pieces->montantrestant);
                } else {
                    $dmd_pieces->montantinitial = $dmd_verificateur->montant;
                    $dmd_pieces->montantrestant = $lastPiece->montantrestant - $dmd_verificateur->montant;
                    //dd( $dmd_pieces->montantrestant);
                }
            } else {
                $dmd_pieces->montantrestant = $themontant - $dmd_verificateur->montant;
                $dmd_pieces->montantinitial = $dmd_verificateur->montant;
                //dd( $dmd_pieces->montantrestant);
            }
            $dmd_pieces->numero_doss = $dmd_verificateur->numero_doss;
            $dmd_pieces->save();
        }

        //dd($dmd_pieces);
        $demande = Piece::where('nom_v', $n_verificateur)->get();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
        return redirect('Listepiece')->with('demande', 'dmd_back', 'dmd_n_lu', 'user');
    }

    public function store(Request $request, $idc)
    {
        $id = Auth::id();

        // Récupérer toutes les données du formulaire
        $data = $request->all();

        // Trouver la demande parente
        $dmd_verificateur = Demande::find($idc);
        if (!array_key_exists('pieces_doss', $data)) {
            $data['pieces_doss'][0] = null;
            $data['ref_doss'][0] = null;
            $data['exp_pieces'][0] = null;
            $data['montantligne'][0] = null;
        }

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
            $montantligne = $data['montantligne'],
            $dateExpi = $data['exp_pieces'], // $datePiece
            $idc, // $idm
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
        $dmd_verificateur->profess_benefi = $data['profess_benifi'];
        $dmd_verificateur->pays_benifi = $data['pays_benifi'];

        if ($dmd_verificateur->back_verifi == 1) {
            $dmd_verificateur->back_verifi = 0;
        } else {
            $dmd_verificateur->back_verifi = 0;
        }
        $dmd_verificateur->banque_benefi = $data['banque_benifi'];
        $dmd_verificateur->num_compt_benefi = $data['num_compt_benifi'];
        $dmd_verificateur->id_verifi = $id;

        if ($request->hasFile('file')) {
            $fileNames = [];

            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $destinationPath = 'files/';
                    $filewithoutext[] = $file->getClientOriginalName();
                    $profileFile = time() . '_' . $file->getClientOriginalName();
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
            $dmd_n_lu = count(
                demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                    ->where('vu_secret', '=', 1)
                    ->get(),
            );
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
        $users = user::find($id);
        $user = User::where('id', '=', $id)->get();

        $l_verificateur = $users->lastname;
        $f_verificateur = $users->firstname;
        $n_verificateur = $l_verificateur . ' ' . $f_verificateur;
        $pieces = piece::where('nom_v', '=', $n_verificateur)->get();
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());
        $name_v = $n_verificateur;

        return view('verificateur.listepiece', compact('pieces', 'dmd_back', 'dmd_n_lu', 'name_v', 'user'));
    }
    public function liste(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits
        $demande = demande::where('id_verifi', '=', $id)
            ->where('vu_verifi', '=', 1)
            ->where('vu_secret', '=', 1)
            ->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.liste_demande', compact('demande', 'dmd_back', 'dmd_n_lu', 'user', 'jointure'));
    }

    public function detaille(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);
        $piece = piece::where('id_dmd', '=', $id)->first();
        if ($piece) {
            $pieces = $piece->libellepiece;
        } else {
            $pieces = 0;
        }

        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.detaille_demande', compact('demande', 'pieces', 'piece', 'dmd_back', 'user', 'dmd_n_lu', 'jointure'));
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
        $demande = demande::where('status_dmd', '=', 'En cours')
            ->where('vu_secret', '=', 1)
            ->where('nom_benefi', '=', null)
            ->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.liste_demande_n', compact('user', 'dmd_back', 'demande', 'jointure', 'dmd_n_lu'));
    }

    public function listeretour(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits
        $demande = demande::where('id_verifi', '=', $id)
            ->where('back_verifi', '=', 1)
            ->get();
        $le_n_dmd = count($demande);

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(
            demande::/* where('id_verifi', '=', $id)-> */where('vu_verifi', '=', 0)
                ->where('vu_secret', '=', 1)
                ->get(),
        );
        $dmd_back = count(demande::where('back_verifi', '=', 1)->get());

        return view('verificateur.liste_dmd_back', compact('demande', 'dmd_back', 'user', 'jointure', 'dmd_n_lu'));
    }
    public function rejet(Request $request, $idm)
    {
        $id = Auth::id();
        $user = User::find($id);
        $rejt = Demande::find($idm);
        $rejt = demande::where('id', $idm)->first();
        // Mise à jour du statut et du motif de la demande
        $rejt->status_dmd = 'Rejetée';
        $rejt->motif = 'Rejetée pour non-conformité des montants';
        $rejt->update();

        // Récupération des pièces associées à la demande
        $pieces = Piece::where('id_dmd', $idm)->get();

        // Calcul de dmd_n_lu et dmd_back (je ne vois pas où vous les utilisez)
        $dmd_n_lu = count(
            Demande::where('vu_verifi', 0)
                ->where('vu_secret', 1)
                ->get(),
        );
        $dmd_back = count(Demande::where('back_verifi', 1)->get());

        // Supposons que l'ID de l'utilisateur connecté est 1
        $verificateur = User::find($id);
        $l_verificateur = $verificateur->lastname;
        $f_verificateur = $verificateur->firstname;

        $data = $request->all();
        //dd($data);
        $themontant = 0;
        // dd($data);
        // Parcourez toutes les pièces soumises
        foreach ($data['libellepiec'] as $key => $libellepiece) {
            $themontant += $data['montantlign'][$key];
        }

        // Parcourez toutes les pièces soumises
        for ($key = 0; $key <= count($data['libellepiec']) - 1; $key++) {
            $dmd_pieces = new Piece();
            $dmd_pieces->id_dmd = $idm;
            $dmd_pieces->libellepiece = $data['libellepiec'][$key];
            $dmd_pieces->referencespiece = $data['referencepiec'][$key];

            if (isset($data['montantlign'][$key])) {
                $dmd_pieces->montantligne = $data['montantlign'][$key];
                $dmd_pieces->montantrestant = $data['montantrestan'];
                $dmd_pieces->montantinitial = $data['montantinitia'];
            } else {
                $dmd_pieces->montantligne = 'NEANT';
            }

            $dmd_pieces->date = $data['dat'];

            if (isset($data['datePiec'][$key])) {
                $dmd_pieces->dateexpi = $data['datePiec'];
            }

            $n_verificateur = $l_verificateur . ' ' . $f_verificateur;
            $dmd_pieces->nom_v = $n_verificateur;
            $dmd_pieces->numero_doss = $rejt->numero_doss;

            $lastPiece = Piece::where('referencespiece', $data['referencepiec'][$key])->first();

            if ($lastPiece != null) {
                if ($lastPiece->montantrestant == 0) {
                    $dmd_pieces->montantrestant = 0;
                } else {
                    $dmd_pieces->montantinitial = $lastPiece->montantrestant;
                    $dmd_pieces->montantrestant = $themontant - $lastPiece->montantrestant;
                }
            } else {
                $dmd_pieces->montantrestant = $themontant - $dmd_pieces->montantinitial;
            }
            // dd($dmd_pieces);
            $dmd_pieces->save();
        }

        return redirect('Listepiece')->with(['dmd_back' => $dmd_back, 'dmd_n_lu' => $dmd_n_lu, 'user' => $user]);
    }
}
