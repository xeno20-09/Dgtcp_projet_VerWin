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
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        $le_n_dmd_c = count($demande_encours);
        $le_n_dmd_v = count($demande_valider);
        $le_n_dmd_e = count($demande_echec);
        $le_n_dmd_s = count($demande_suspendre);
        return view('verificateur.Home', compact('user', 'le_n_dmd_c', 'le_n_dmd_v', 'le_n_dmd_e', 'le_n_dmd_s', 'dmd_n_lu'));
    }

    public function liste_demande_n(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $demande = demande::where('status_dmd', '=', 'En cours')->where('nom_benefi', '=', null)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        return view('verificateur.liste_demande_n', compact('user', 'demande', 'jointure', 'dmd_n_lu'));
    }
    public function formulaire(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $dmd_verificateur = demande::find($id);
        $dmd_verificateur->vu_verifi = 1;
        $le_n_dmd = count($demande);
        $dmd_verificateur->update();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        return view('verificateur.form_demande', compact('demande', 'user', 'dmd_n_lu'));
    }

    public function  form(Request $request, $id_dmd)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();
        $dmd_n_lu = count(demande::where('reponse_damf', '=', 1)->get());
        $demande = (demande::where('id', '=', $id_dmd)->get());

        return view('verificateur.formv_demande_mj', compact('demande', 'dmd_n_lu', 'user'));
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
            $idv = $dmd_verificateur->id_verifi;
            $id_verificateur = User::find($idv);
            $n_verificateur = $id_verificateur->name;
            $num = $dmd_verificateur->numero_doss;

            for ($i = 0; $i < count($libellePieces); $i++) {
                $dmd_pieces = new Piece();
                $dmd_pieces->id_dmd = $id_d;
                $dmd_pieces->libellepiece = $libellePieces[$i];
                $dmd_pieces->referencespiece = $referencesPieces[$i];
                $dmd_pieces->date_piece = $datesPieces[$i];
                $dmd_pieces->montantligne = $montantLignes[$i];
                $dmd_pieces->nom_d = $dmd_verificateur->nom_client;
                $dmd_pieces->nom_b = $dmd_verificateur->nom_benefi;
                $dmd_pieces->nom_v = $n_verificateur;
                $dmd_pieces->numero_doss = $num;
                $dmd_pieces->montantinitial = $dmd_verificateur->montant;

                if ($i == 0) {
                    /*    if (Piece::where('libellepiece', $libellePieces[$i])->orderByDesc('created_at')->first()) {
                        $test = Piece::where('libellepiece', $libellePieces[$i])->orderByDesc('created_at')->first();
                        $dmd_pieces->montantrestant = $test->montantrestant - $montantLignes[$i];
                    } else { */
                    // Pour la première itération, calculez montantrestant en fonction de montantinitial
                    $dmd_pieces->montantrestant = $dmd_pieces->montantinitial - $montantLignes[$i];
                    /* } */
                }


                if ($i != 0) {
                    // Pour les itérations suivantes, obtenez le montantrestant du dernier enregistrement de pièce enregistré
                    $dernier_piece_enregistre = Piece::where('id_dmd', $id_d)->orderByDesc('created_at')->first();
                    if ($dernier_piece_enregistre) {
                        $dmd_pieces->montantrestant = $dernier_piece_enregistre->montantrestant - $montantLignes[$i];
                    } else {
                        // Aucun enregistrement de pièce précédent, utilisez montantinitial
                        $dmd_pieces->montantrestant = $dmd_pieces->montantinitial - $montantLignes[$i];
                    }
                }




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
        $sum = Piece::where('id_dmd', $id_d)->sum('montantligne');
        $dmd_verificateur->montant = $sum;
        $devise = $dmd_verificateur->devise;

        $convertedObj = Currency::convert()
            ->from($devise)
            ->to('XOF')
            ->amount($sum);
        $montant_con = $convertedObj->get();
        $dmd_verificateur->montant_con = $montant_con;
        $dmd_verificateur->update();
        return view('verificateur.infopiece', compact('numberinput', 'filewithoutext', 'file', 'date', 'demande', 'dmd_n_lu', 'user', 'jointure'));
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


        // Sauvegarde du modèle en base de données
        $dmd_verificateur->update();
        $demande = demande::where('id_verifi', '=', $id)->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        $user = User::where('id', '=', $id)->get();
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();



        if ($request->hasFile('file')) {
            $numberinput = count($fileNames);
            $demande = demande::where('id', '=', $idc)->get();
            $demand = demande::where('id', '=', $idc)->first();
            $file = $fileNames;
            $date = now();
            return view('verificateur.infopiece', compact('numberinput', 'filewithoutext', 'file', 'date', 'demande', 'dmd_n_lu', 'user', 'jointure'));
        } else {
            $demand = demande::where('id', '=', $idc)->first();
            $num = $demand->numero_doss;
            $montant = $demand->montant;
            // $change = piece::where('numero_doss', '=', $num)->get();
            $changes = piece::where('numero_doss', '=', $num)->first();
            $change = piece::find($num);
            dd($num);
            $montantrestant = $change->montantrestant - $montant;

            $changes->update();


            return view('verificateur.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure'));
        }
    }

    public function liste(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', '=', $id)->get();

        // Redirection vers la page de liste des produits  
        $demande = demande::where('id_verifi', '=', $id)->get();
        $le_n_dmd = count($demande);
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());

        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        return view('verificateur.liste_demande', compact('demande', 'dmd_n_lu', 'user', 'jointure', 'dmd_n_lu'));
    }

    public function   detaille(Request $request, $id)
    {
        $id_c = Auth::id();
        $user = User::where('id', '=', $id_c)->get();
        $demande = demande::where('id', '=', $id)->get();
        $le_n_dmd = count($demande);

        $dmd_n_lu = demande::where('vu_secret', '=', 0)->get();
        $dmd_n_lu = count($dmd_n_lu);
        $jointure = DB::table('users')
            ->join('demandes', 'users.id', '=', 'demandes.id_secret')
            ->select('demandes.*', 'users.*')
            ->get();
        $dmd_n_lu = count(demande::where('vu_verifi', '=', 0)->get());
        return view('verificateur.detaille_demande', compact('demande', 'user', 'dmd_n_lu', 'jointure', 'dmd_n_lu'));
    }
}
