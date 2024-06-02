@extends('layout.chef_bureau.header')
@section('content')
<div class="container">
    <h1 style="text-align: center;">
        @foreach ($user as $item)
        <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} <span
                class="badge rounded-pill badge-notification bg-danger"
                style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
        @endforeach
    </h1>
    @foreach ($demande as $item_c)
    <h1>Demande N° {{ $item_c->numero_doss }} </h1>


    <form action="{{ route('store_formulaire_demand', $item_c->id) }}" method="Post"
        class="card-body cardbody-color p-lg-5">

        @csrf
        <div class="row">

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                    <input name="date_depot" type="texte" value="{{ $item_c->date }}" class="form-control" id=""
                        aria-describedby="" placeholder="">

                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Type personne</label>

                    <input name="type_prs" type="texte" value="{{ $item_c->type_prs }}" class="form-control" id=""
                        aria-describedby="" placeholder="">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">N° enregistrement</label>
                    <input name="num_save" type="texte" value="{{ $item_c->num_save }}" class="form-control" id=""
                        aria-describedby="" placeholder="">

                </div>
            </div>

        </div>
        @if ($item_c->type_prs == 'morale')
        <div id="morale">

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Nature des opérations</label>
                        <input name="nature_op" value="{{ $item_c->nature_op }}" type="text" class="form-control" id=""
                            placeholder="Nature des opérations" readonly>

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Nature des produits</label>
                        <input name="nature_pro" value="{{ $item_c->nature_p }}" type="text" class="form-control" id=""
                            placeholder="Nature des produits" readonly>

                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Boite postale</label>
                        <input name="boite" type="text" value="{{ $item_c->boite }}" class="form-control" id=""
                            placeholder="Boite postale" readonly>

                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Devises</label>

                        <input name="currency_from" value="{{ $item_c->devise }}" type="text" class="form-control"
                            readonly>

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Montant </label>
                        <input name="montant_in" value="{{ $item_c->montant }}" type="number" class="form-control"
                            oninput="test1()" id="montant_in_m" placeholder="Montant " readonly>
                    </div>
                </div>


                <div class="col" id="valeur_m">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Valeur </label>
                        <input name="valeur" type="text" class="form-control" value="{{ $taux_d}}" id="val1"
                            placeholder="Valeur" readonly>
                    </div>
                </div>
                <div class="col" id="mont_fcfa_m">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Contre montant </label>
                        <input name="mont_fcfa" type="text" class="form-control" value="{{ $item_c->montant_con }}"
                            id="montant_fcfa_m" placeholder="Contre montant" readonly>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Nom de la société</label>
                        <input name="nomsociete" type="text" class="form-control" value={{ $item_c->nomsociete }}
                        id="nom" placeholder="Nom societe" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Catégorie de la société</label>
                        <input name="categorie" type="text" value={{ $item_c->categorie }}
                        class="form-control" id="prenom" placeholder="Catégorie" readonly>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Adresse de la société</label>
                        <input name="adresse" type="text" value="{{ $item_c->adresse }}" class="form-control" id=""
                            placeholder="Adresse" readonly>
                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col">
                    <div class="form-group" style="position: relative;top: 15px;">
                        <p>Numéro de téléphone de la société:</p>
                        <input id="phone" type="tel" name="tel_client" value="{{ $item_c->tel_client }}"
                            class="form-control" style="" placeholder="TelClient" readonly>
                    </div>
                </div>


                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Banque de la société</label>

                        <input name="banque_client" value="{{ $item_c->banque_client }}" type="text"
                            class="form-control" readonly>

                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Numéro de compte de la société</label>
                        <input name="num_compt_client" value={{ $item_c->num_compt_client }} type="text"
                        class="form-control" id="" placeholder="Numéro de compte" readonly>
                    </div>
                </div>

            </div>

        </div>
        @elseif ($item_c->type_prs == 'physique')
        <div id="physique">
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Nature des opérations</label>
                        <input name="nature_op" value="{{ $item_c->nature_op }}" type="text" class="form-control" id=""
                            placeholder="Nature des opérations" readonly>

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Nature des produits</label>

                        <input name="nature_pro" value="{{ $item_c->nature_p }}" type="text" class="form-control" id=""
                            placeholder="Nature des produits" readonly>

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Nationalité du demandeur</label>


                        <input name="nationalite" value="{{ $item_c->nationalite }}" type="text" class="form-control"
                            id="" placeholder="" readonly>


                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Devise </label>

                        <input name="currency_from" value="{{ $item_c->devise }}" type="text" class="form-control"
                            readonly>

                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Montant de la transaction </label>
                        <input name="montant_in" value="{{ $item_c->montant }}" type="number" oninput="test()"
                            class="form-control" id="montant_in" placeholder="Montant " readonly>
                    </div>
                </div>

                <div class="col" id="valeur_p">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Coût de la devise </label>
                        <input name="valeur" type="text" class="form-control" value="{{ $taux_d}}" id="val1"
                            placeholder="Valeur" readonly>
                    </div>
                </div>
                <div class="col" id="mont_fcfa_p">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Contre montant de la transaction </label>
                        <input name="mont_fcfa" type="text" class="form-control" value="{{ $item_c->montant_con }}"
                            id="montant_fcfa" placeholder="Contre montant" readonly>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Nom du demandeur</label>
                        <input name="nom_client" type="text" value="{{ $item_c->nom_client }}" class="form-control"
                            id="nom" placeholder="Nom client" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Prenom du demandeur</label>
                        <input name="prenom_client" type="text" value="{{ $item_c->prenom_client }}"
                            class="form-control" id="prenom" placeholder="Prenom client" readonly>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Profession du demandeur</label>
                        <input name="profess_client" type="text" value="{{ $item_c->profess_client }}"
                            class="form-control" id="" placeholder="ProfClient" readonly>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Telephone du demandeur</label>
                        <input maxlength="14" minlength="12" value="{{ $item_c->tel_client }}" name="tel_client"
                            type="number" class="form-control" id="" placeholder="TelClient" readonly>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Banque du demandeur</label>
                        <input name="banque_client" type="text" value="{{ $item_c->banque_client }}"
                            class="form-control" id="" placeholder="Banque" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Numéro de compte du demandeur</label>
                        <input maxlength="12" minlength="12" name="num_compt_client"
                            value="{{ $item_c->num_compt_client }}" type="number" class="form-control" id=""
                            placeholder="Numéro de compte" readonly>
                    </div>
                </div>
            </div>


        </div>
        @endif

        <br><br>
        <legend>Demande du verificateur</legend>
        <hr>

        <div class="row">

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Nom du beneficiaire</label>
                    <input name="nom_benifi" value="{{ $item_c->nom_benefi }}" type="text" class="form-control" id=""
                        placeholder="Nom du beneficiaire" readonly>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Prenom du beneficiaire</label>
                    <input name="prenom_benifi" value="{{ $item_c->prenom_benefi }}" type="text" class="form-control"
                        id="" placeholder="Prenom du beneficiaire" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Profession du beneficiaire</label>
                    <input name="profess_benifi" value="{{ $item_c->profess_benefi }}" type="text" class="form-control"
                        id="" placeholder="Profession du beneficiaire" readonly>
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Pays benificiaire</label>
                    <input name="pays_benifi" type="text" class="form-control" id="" value="{{ $item_c->pays_benifi }}"
                        placeholder="PaysClient" readonly>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Banque du beneficiaire</label>
                    <input name="banque_benifi" value="{{ $item_c->banque_benefi }}" type="text" class="form-control"
                        id="" placeholder="Banque" readonly>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Numéro de compte du beneficiaire</label>
                    <input name="num_compt_benifi" value="{{ $item_c->num_compt_benefi }}" type="text"
                        class="form-control" id="" placeholder="Numéro de compte" readonly>
                </div>
            </div>
            @foreach ($piece as $item_d)
            <div id="container" style="  width: 1362px;">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Pièces</label>
                            <input name="pieces_doss[]" type="text" value="{{ $item_d->libellepiece }}"
                                class="form-control" id="pieces" placeholder="pieces" readonly>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Reference de la pièce</label>
                            <input name="ref_doss[]" type="text" class="form-control"
                                value="{{ $item_d->referencespiece }}" id="refs" placeholder="ref pieces" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Montant ligne</label>
                            <input name="montantligne[]" type="number" class="form-control"
                                value="{{ $item_d->montantligne }}" id="mligne" placeholder="Montant ligne" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Date d'expiration de la
                                piece</label>
                            <input name="exp_pieces[]" value="{{ $item_d->dateexpi }}" type="date" class="form-control"
                                id="expi" placeholder="date expiration pieces">
                        </div>
                    </div>


                </div>
            </div>
            @endforeach
            <br>
        </div>
        @php
        $pi = count($piece);
        if ($pi == 0) {
        echo ' <h3>Il y a pas de pieces joint pour cette demande</h3> ';
        }
        @endphp





        <br><br>
        <legend>Demande Chef division</legend>
        <hr>

        <div class="row">

            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Date de decision</label>
                    <input name="date_decision" value="{{ $item_c->date_decision }}" type="text" class="form-control"
                        id="" placeholder="Date de decision">
                </div>
            </div>
        </div>
        <br><br>
        <legend>Saisir d'une demande</legend>
        <hr>


        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleSelect1" class="form-label mt-4">Visa</label>
                    <select name="status" onchange="test()" class="form-select" id="visa">
                        <option value="Autorisée">Autorisée</option>
                        <option value="Rejetée">Rejetée</option>
                        <option value="Suspendu">Suspendu</option>
                    </select>
                </div>
            </div>
            <div id="p" class="col">
                <div class="form-group">
                    <label for="" class="form-label mt-4">Motif du rejet ou de la suspension</label>
                    <input name="motif" value="{{ $item_c->motif }}" type="text" class="form-control" id="motif"
                        placeholder="Motif">
                </div>
            </div>





        </div>


        <br>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    <a href="{{ route('retour_cd', $item_c->id) }}"> <button class="btn btn-danger">Retournez la
            demande au Chef Division </button></a>
    @endforeach







</div>


<br>
<br>

<script>
    function test() {
            var visa = document.getElementById('visa').value;
            var motif = document.getElementById('p');
            ///console.log( motif.style.display.none;)

            if (visa == "Autorisée") {
                motif.style.display.none;
            } else {
                motif.style.display.block;

            }

        }
</script>
@endsection