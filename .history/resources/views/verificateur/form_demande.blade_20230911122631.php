@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} <span
                        class="badge rounded-pill badge-notification bg-danger"
                        style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
            @endforeach
        </h1>
        @foreach ($demande as $item_c)
            <h1>Demande N° {{ $item_c->numero_doss }} </h1>


            <form action="{{ url('FormulaireSave_verificateur', $item_c->id) }}" method="Post"
                class="card-body cardbody-color p-lg-5" enctype="multipart/form-data">

                @csrf


                <div class="row">
                    <legend>Checker l'enregistrement</legend>
                    <hr>


                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                            <input value="{{ $item_c->date }}" name="date_depot" type="date" class="form-control"
                                id="" aria-describedby="" placeholder="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nature des opérations</label>

                            <input value="{{ $item_c->nature_op }}" name="nature_op" type="text" class="form-control"
                                id="" placeholder="Nature des opérations">

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nature des produits</label>

                            <input value="{{ $item_c->nature_p }}" name="nature_pro" type="text" class="form-control"
                                id="" placeholder="Nature des produits">

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Devise </label>
                            <input value="{{ $item_c->devise }}" name="currency_from" type="text" class="form-control"
                                id="" placeholder="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Montant </label>
                            <input value="{{ $item_c->montant }}" name="montant_in" type="number" class="form-control"
                                id="" placeholder="Montant en Francs">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Montant en Francs</label>
                            <input value="{{ $item_c->montant_con }}" name="montant_out" type="number" class="form-control"
                                id="" placeholder="Montant converti">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nom client</label>
                            <input value="{{ $item_c->nom_client }}" name="nom_client" type="text" class="form-control"
                                id="" placeholder="Nom client">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Prenom client</label>
                            <input value="{{ $item_c->prenom_client }}" name="prenom_client" type="text"
                                class="form-control" id="" placeholder="Prenom client">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Telephone client</label>
                            <input value="{{ $item_c->tel_client }}" name="tel_client" type="text"
                                class="form-control" id="" placeholder="TelClient">
                        </div>
                    </div>

                </div>

                <div class="row">



                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Banque</label>
                            <input value="{{ $item_c->banque_client }}" name="banque_client" type="text"
                                class="form-control" id="" placeholder="Banque">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Profession client</label>
                            <input value="{{ $item_c->profess_client }}" name="profess_client" type="text"
                                class="form-control" id="" placeholder="ProfClient">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Numéro de compte</label>
                            <input value="{{ $item_c->num_compt_client }}" name="num_compt_client" type="text"
                                class="form-control" id="" placeholder="Numéro de compte">
                        </div>
                    </div>
                </div>



                <br><br>
                <legend>Saisir d'une demande</legend>
                <hr>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nom du beneficiaire</label>
                            <input name="nom_benifi" type="text" class="form-control" id=""
                                placeholder="Nom du beneficiaire">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Prenom du beneficiaire</label>
                            <input name="prenom_benifi" type="text" class="form-control" id=""
                                placeholder="Prenom du beneficiaire">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Profession du beneficiaire</label>
                            <input name="profess_benifi" type="text" class="form-control" id=""
                                placeholder="Profession du beneficiaire">
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Pays benificiaire</label>
                            <input name="pays_benifi" type="text" class="form-control" id=""
                                placeholder="PaysClient">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Banque beneficiaire</label>
                            <input name="banque_benifi" type="text" class="form-control" id=""
                                placeholder="Banque">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Numéro de compte beneficiaire</label>

                            <input maxlength="12" minlength="12" name="num_compt_benifi" type="text"
                                class="form-control" id="" placeholder="Numéro de compte">

                        </div>
                    </div>


                </div>
                <div id="container" style="  width: 1362px;">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Pieces</label>
                                <input name="pieces_doss[]" type="text" class="form-control" id="pieces" placeholder="pieces">
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Reference piece</label>
                                <input name="ref_doss[]" type="text" class="form-control" id="refs" placeholder="ref pieces">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Montant ligne</label>
                                <input name="montantligne[]" type="number" class="form-control" id="mligne" placeholder="Montant ligne">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Date d'expiration de la piece</label>
                                <input name="exp_pieces[]" value=" " type="date" class="form-control" id="expi" placeholder="date expiration pieces">
                            </div>
                        </div>
                    {{-- </div>
                    <div class="row"> --}}
                      
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Ajouter une autre piece</label>
                                <button style="position: relative; top: 36px; right: 100px;" type="button" class="btn btn-primary" id="ajouterChamp">+</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                               
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <br>


                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
            <a href="{{ route('retour_s', $item_c->id) }}"><button class="btn btn-danger">Retournez la
                    demande au Secretaire </button></a>
        @endforeach


    </div>


    <br>
    <br>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Sélectionnez le bouton "Ajouter"
        var boutonAjouter = document.getElementById("ajouterChamp");

        // Sélectionnez le conteneur des rangées
        var container = document.getElementById("container");

        // Compteur de clics

        // Ajoutez un gestionnaire d'événement au bouton "Ajouter"
        boutonAjouter.addEventListener("click", function () {
            // Incrémente le compteur de clics

            // Clonez la première rangée
            var clonedRow = container.querySelector(".row").cloneNode(true);

            // Effacez les valeurs des champs clonés
            var inputs = clonedRow.querySelectorAll("input");
            inputs.forEach(function (input) {
                input.value = "";
            });

            // Changez les noms des champs et réinitialisez les valeurs
            var piece = clonedRow.querySelector("#pieces");
            var refs = clonedRow.querySelector("#refs");
            var datex = clonedRow.querySelector("#expi");
            var mligne = clonedRow.querySelector("#mligne");

            piece.value = "";
            refs.value = "";
            datex.value = "";
            mligne.value=" ";
            piece.name = "pieces_doss[]";
            refs.name = "ref_doss[]";
            datex.name = "exp_pieces[]";
            mligne.name = "montantligne[]";
            moins.id="moins";
            moins.value="-"
            // Ajoutez le clone au conteneur
            container.appendChild(clonedRow);

            // Affichez le nombre de clics dans la console
        });
    });
</script>
