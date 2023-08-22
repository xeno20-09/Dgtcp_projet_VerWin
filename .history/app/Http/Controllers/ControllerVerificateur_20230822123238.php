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

        $sum = Piece::where('id_dmd', $id_d)->sum('montantinitial');

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
            $dmd_pieces->montantinitial = $dmd_verificateur->montant;
            $dmd_pieces->montantrestant = $sum;

            // Enregistrer dans la base de données
            $dmd_pieces->save();
        }
    }
}
