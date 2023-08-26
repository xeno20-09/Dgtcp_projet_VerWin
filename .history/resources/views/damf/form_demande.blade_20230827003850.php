@extends('layout.damf.header')
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


            <form action="{{ route('store_formulaire_dmd', $item_c->id) }}" method="Post"
                class="card-body cardbody-color p-lg-5">

                @csrf
                <legend>Checker l'enregistrement</legend>

                <div class="row">
                    <legend>Demande secretaire</legend>
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
                            <input value="{{ $item_c->tel_client }}" name="tel_client" type="text" class="form-control"
                                id="" placeholder="TelClient">
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
                <legend>Demande du verificateur</legend>
                <hr>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nom du beneficiaire</label>
                            <input name="nom_benifi" value="{{ $item_c->nom_benefi }}" type="text"
                                class="form-control" id="" placeholder="Nom du beneficiaire">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Prenom du beneficiaire</label>
                            <input name="prenom_benifi" value="{{ $item_c->prenom_benefi }}" type="text"
                                class="form-control" id="" placeholder="Prenom du beneficiaire">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Profession du beneficiaire</label>
                            <input name="profess_benifi" value="{{ $item_c->profess_benefi }}" type="text"
                                class="form-control" id="" placeholder="Profession du beneficiaire">
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Pays benificiaire</label>
                            <input name="pays_benifi" type="text" class="form-control" id=""
                                value="{{ $item_c->pays_benifi }}" placeholder="PaysClient">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Banque beneficiaire</label>
                            <input name="banque_benifi" value="{{ $item_c->banque_benefi }}" type="text"
                                class="form-control" id="" placeholder="Banque">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Numéro de compte beneficiaire</label>
                            <input name="num_compt_benifi" value="{{ $item_c->num_compt_benefi }}" type="text"
                                class="form-control" id="" placeholder="Numéro de compte">
                        </div>
                    </div>

                </div>




                <br><br>
                <legend>Demande Chef division</legend>
                <hr>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Date de decision</label>
                            <input name="date_decision" value="{{ $item_c->date_decision }}" type="text"
                                class="form-control" id="" placeholder="Date de decision">
                        </div>
                    </div>

                    <br><br>
                    <legend>Demande du Chef Bureau</legend>
                    <hr>



                    <div class="row">

                        <div class="col">

                            <div class="form-group">

                                <label for="" class="form-label mt-4">Autorisation</label>
                                <input name="motif" value="{{ $item_c->status_dmd_cb }}" type="text"
                                    class="form-control" id="" placeholder="">
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Motif du rejet ou de la suspension</label>
                                <input name="motif" value="{{ $item_c->motif_cb }}" type="text"
                                    class="form-control" id="" placeholder="Motif">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>



                    <br><br>
                    <legend>Saisir d'une demande</legend>
                    <hr>

                    <div class="row">

                        <div class="col">

                            <div class="form-group">
                                <label for="exampleSelect1" class="form-label mt-4">Example disabled select</label>
                                <select name="status" class="form-select" id="exampleDisabledSelect1">
                                    <option>Autorisée</option>
                                    <option>Rejetée</option>
                                    <option>Suspendu</option>
                                </select>
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Motif du rejet ou de la suspension</label>
                                <input name="motif" value="{{ $item_c->motif }}" type="text" class="form-control"
                                    id="" placeholder="Motif">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>

           




                    <br>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
          <a href=""><button class="btn btn-danger" >Retournez la
                demande au Chef Bureau </button></a>  

        @endforeach







    </div>


    <br>
    <br>
@endsection
