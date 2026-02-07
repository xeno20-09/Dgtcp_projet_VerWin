<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            @foreach ($demande as $item_c)
                <form action="{{ route('store_formulaire_dmd', $item_c->id) }}" method="Post"
                    class="card-body cardbody-color p-lg-5">
                    @csrf

                    <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
                        <div class="col-lg-9 col-12">
                            <div class="card card-body" id="profile">
                                <div class="row z-index-2 justify-content-center align-items-center">
                                    <div class="col-sm-auto col-4"></div>
                                    <div class="col-sm-auto col-8 my-auto">
                                        <div class="h-100">
                                            <p class="mb-0 font-weight-bold text-sm">Demande N°
                                                {{ $item_c->numero_doss }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-9 col-12">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert" id="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success" role="alert" id="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-5 row justify-content-center">
                        <div class="col-lg-11 col-12">
                            <div class="card" id="basic-info">
                                <div class="card-header">
                                    <h5>2ème Etape</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <!-- Première partie du formulaire -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Date de dépôt du
                                                    dossier</label>
                                                <input name="date_depot" type="text" value="{{ $item_c->date }}"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Type personne</label>
                                                <input name="type_prs" type="text" value="{{ $item_c->type_prs }}"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">IFU</label>
                                                <input name="ifu" type="text" value="{{ $ifu }}"
                                                    class="form-control" maxlength="13" minlength="12" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">N°
                                                    enregistrement</label>
                                                <input name="num_save" type="text" value="{{ $item_c->numero_doss }}"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($item_c->type_prs == 'physique')
                                        <!-- Section Personne Physique -->
                                        <div id="physique">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nature des
                                                            opérations</label>
                                                        <input name="nature_op" type="text" class="form-control"
                                                            value="{{ $item_c->nature_op }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nature des
                                                            produits</label>
                                                        <input name="nature_pro" type="text" class="form-control"
                                                            value="{{ $item_c->nature_p }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nationalité du
                                                            demandeur</label>
                                                        <input name="nationalite" type="text" class="form-control"
                                                            value="{{ $item_c->nationalite }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Devise</label>
                                                        <input name="currency_from" value="{{ $item_c->devise }}"
                                                            type="text" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Montant de la
                                                            transaction</label>
                                                        <input name="montant_in" type="number" class="form-control"
                                                            value="{{ $item_c->montant }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Coût de la
                                                            devise</label>
                                                        <input name="valeur" type="text" class="form-control"
                                                            value="{{ $taux_d }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Contre
                                                            montant</label>
                                                        <input name="mont_fcfa" type="text" class="form-control"
                                                            value="{{ $item_c->montant_con }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nom du
                                                            demandeur</label>
                                                        <input name="nom_client" type="text" class="form-control"
                                                            value="{{ $item_c->nom_client }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Prenom du
                                                            demandeur</label>
                                                        <input name="prenom_client" type="text"
                                                            class="form-control" value="{{ $item_c->prenom_client }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Profession du
                                                            demandeur</label>
                                                        <input name="profess_client" type="text"
                                                            class="form-control"
                                                            value="{{ $item_c->profess_client }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Telephone du
                                                            demandeur</label>
                                                        <input type="tel" name="tel_client" class="form-control"
                                                            value="{{ $item_c->tel_client }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Banque du
                                                            demandeur</label>
                                                        <input type="text" name="banque_client"
                                                            class="form-control" value="{{ $item_c->banque_client }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Numéro de compte
                                                            du demandeur</label>
                                                        <input name="num_compt_client" type="text"
                                                            class="form-control"
                                                            value="{{ $item_c->num_compt_client }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($item_c->type_prs == 'morale')
                                        <!-- Section Personne Morale -->
                                        <div id="morale">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nature des
                                                            opérations</label>
                                                        <input name="nature_op" type="text" class="form-control"
                                                            value="{{ $item_c->nature_op }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nature des
                                                            produits</label>
                                                        <input name="nature_pro" type="text" class="form-control"
                                                            value="{{ $item_c->nature_p }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Boite postale de
                                                            la société</label>
                                                        <input name="boite" type="text" class="form-control"
                                                            value="{{ $item_c->boite }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Devise</label>
                                                        <input name="currency_from" value="{{ $item_c->devise }}"
                                                            type="text" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Montant de la
                                                            transaction</label>
                                                        <input name="montant_in" type="number" class="form-control"
                                                            value="{{ $item_c->montant }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Coût de la
                                                            devise</label>
                                                        <input name="valeur" type="text" class="form-control"
                                                            value="{{ $taux_d }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Contre montant
                                                            de la transaction</label>
                                                        <input name="mont_fcfa" type="text" class="form-control"
                                                            value="{{ $item_c->montant_con }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nom de la
                                                            société</label>
                                                        <input name="nomsociete" type="text" class="form-control"
                                                            value="{{ $item_c->nomsociete }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Catégorie de la
                                                            société</label>
                                                        <input name="categorie" type="text" class="form-control"
                                                            value="{{ $item_c->categorie }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Adresse de la
                                                            société</label>
                                                        <input name="adresse" type="text" class="form-control"
                                                            value="{{ $item_c->adresse }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group" style="position: relative;top: 15px;">
                                                        <label for="" class="form-label mt-4">Entrez le
                                                            numéro de téléphone de la société:</label>
                                                        <input type="tel" name="tel_client" class="form-control"
                                                            value="{{ $item_c->tel_client }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Banque de la
                                                            société</label>
                                                        <input type="text" name="banque_client"
                                                            class="form-control" value="{{ $item_c->banque_client }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Numéro de compte
                                                            de la société</label>
                                                        <input name="num_compt_client" type="text"
                                                            class="form-control"
                                                            value="{{ $item_c->num_compt_client }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-header">
                                    <h5>Bénéficiaire</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nom du
                                                    bénéficiaire</label>
                                                <input name="nom_benifi" type="text" class="form-control"
                                                    value="{{ $item_c->nom_benefi }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Prénom du
                                                    bénéficiaire</label>
                                                <input name="prenom_benifi" type="text" class="form-control"
                                                    value="{{ $item_c->prenom_benefi }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Profession du
                                                    bénéficiaire</label>
                                                <input name="profess_benifi" type="text" class="form-control"
                                                    value="{{ $item_c->profess_benefi }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Pays
                                                    bénéficiaire</label>
                                                <input maxlength="12" minlength="12" name="num_compt_benifi"
                                                    type="number" class="form-control"
                                                    value="{{ $item_c->pays_benifi }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Banque
                                                    bénéficiaire</label>
                                                <input maxlength="12" minlength="12" name="num_compt_benifi"
                                                    type="number" class="form-control"
                                                    value="{{ $item_c->banque_benefi }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Numéro de compte
                                                    bénéficiaire</label>
                                                <input maxlength="12" minlength="12" name="num_compt_benifi"
                                                    type="number" class="form-control"
                                                    value="{{ $item_c->num_compt_benefi }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-11 col-12">
                            <div class="card" id="basic-info">
                                <div class="card-header">
                                    <h5>Pièces jointes</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <div id="container">



                                        <!-- Pièces existantes -->
                                        @foreach ($piece as $item_d)
                                            <div class="row piece-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label mt-4">Intitulé de la pièce</label>
                                                        <input name="pieces_doss[]" type="text"
                                                            class="form-control piece-input"
                                                            value="{{ $item_d->libellepiece }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label mt-4">Référence</label>
                                                        <input name="ref_doss[]" type="text"
                                                            class="form-control ref-input"
                                                            value="{{ $item_d->referencespiece }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-label mt-4">Montant ligne</label>
                                                        <div class="input-group">
                                                            <input name="montantligne[]" type="number"
                                                                class="form-control amount-input"
                                                                value="{{ $item_d->montantligne }}" readonly>
                                                            <span
                                                                class="input-group-text">{{ $item_c->devise }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label mt-4">Date d'expiration</label>
                                                        <input name="exp_pieces[]" type="date"
                                                            class="form-control date-input"
                                                            value="{{ $item_d->dateexpi }}" readonly>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-lg-11 col-12">
                            <div class="card" id="basic-info">
                                <div class="card-header">
                                    <h5>Date de décision</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <div id="container">



                                        <!--  -->
                                        <div class="row ">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label mt-4">Date de decision</label>
                                                    <input name="date_decision" type="date"
                                                        class="form-control piece-input"
                                                        value="{{ $item_c->date_decision }}" readonly>
                                                </div>
                                            </div>



                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>



                        <div class="col-lg-11 col-12">
                            <div class="card" id="basic-info">
                                <div class="card-header">
                                    <h5>Visa</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <div id="container">



                                        <!--  -->
                                        <div class="row ">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label mt-4">Visa</label>

                                                    <input name="motif" value="{{ $item_c->status_dmd_cb }}"
                                                        type="text" class="form-control" id="motif"
                                                        placeholder="Motif" readonly>
                                                </div>
                                            </div>
                                            <div id="p" class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="form-label mt-4">Motif du rejet ou de
                                                        la suspension</label>
                                                    <input name="motif" value="{{ $item_c->motif_cb }}"
                                                        type="text" class="form-control" id="motif"
                                                        placeholder="Motif" readonly>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>



                        <div class="col-lg-11 col-12">
                            <div class="card" id="basic-info">
                                <div class="card-header">
                                    <h5>Saisir d'une demande</h5>
                                </div>
                                <div class="pt-0 card-body">

                                    <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-start">Vu &
                                        approuvé !</button>

                                </div>

                            </div>
                        </div>




                    </div>
                </form>
            @endforeach
        </div>
    </main>
</x-app-layout>
