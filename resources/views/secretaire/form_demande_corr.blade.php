<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            
            <!-- En-tête de la page -->
            <div class="mb-4 row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="card card-body" id="profile">
                        <div class="row z-index-2 justify-content-center align-items-center">
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-0 font-weight-bold text-lg">
                                        Correction de la demande
                                    </h5>
                                    @foreach ($demande as $item1)
                                        <p class="mb-0 text-sm">Demande N°: {{ $item1->numero_doss }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages d'alerte -->
            <div class="row justify-content-center">
                <div class="col-lg-11 col-12">
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

            <!-- Formulaire de correction -->
            @foreach ($user as $item)
                @foreach ($demande as $item1)
                    <form action="{{ route('store_correction_form_ask', $item1->id) }}" method="post">
                        <input type="hidden" name="id_user" value="{{ $item->id }}">
                        <input type="hidden" name="nom_demandeur" value="{{ $item->nom }}">
                        <input type="hidden" name="mail_demandeur" value="{{ $item->mail }}">
                        <input type="hidden" name="poste_demandeur" value="{{ $item->poste }}">
                        @csrf
                @endforeach
            @endforeach

            <div class="mb-5 row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="card" id="basic-info">
                        <div class="card-header">
                            <h5>Informations de base</h5>
                        </div>
                        <div class="pt-0 card-body">
                            <!-- Première partie du formulaire -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                                        <input name="date_depot" type="texte" value="{{ $item1->date }}" 
                                            class="form-control" id="" placeholder="Date de dépôt">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Type personne</label>
                                        <select class="form-select position-relative" aria-label="Default select example" 
                                            id="type" onchange="toggleFields()" name="type_prs" required>
                                            <option value="{{ $item1->type_prs }}">Personne {{ $item1->type_prs }}</option>
                                            <option value="morale">Personne morale</option>
                                            <option value="physique">Personne physique</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">N° enregistrement</label>
                                        <input name="num_save" type="texte" value="{{ $item1->num_save }}" 
                                            class="form-control" id="" placeholder="Numéro d'enregistrement">
                                    </div>
                                </div>
                            </div>

                            @if ($item1->type_prs == 'morale')
                                <!-- Section Personne Morale -->
                                <div id="morale" style="display: block;">
                                    <div class="row mt-4">
                                        <div class="col">
                                            <h6 class="text-dark mb-3">Informations de la société</h6>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nature des opérations</label>
                                                <input name="nature_op" value="{{ $item1->nature_op }}" type="text" 
                                                    class="form-control" placeholder="Nature des opérations">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nature des produits</label>
                                                <input name="nature_pro" value="{{ $item1->nature_p }}" type="text" 
                                                    class="form-control" placeholder="Nature des produits">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Boite postale</label>
                                                <input name="boite" type="text" value="{{ $item1->boite }}" 
                                                    class="form-control" placeholder="Boite postale">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Devise</label>
                                                <select style="top: 0px;" id="currency_from_m" 
                                                    class="form-select position-relative" name='currency_from' 
                                                    aria-label="Default select example" onchange="valeur_m()" required>
                                                    <option value="{{ $item1->devise }}">{{ $item1->devise }}</option>
                                                    <option value="Euro">Euro</option>
                                                    <option value="Dollar us">Dollar us</option>
                                                    <option value="Yen japonais">Yen japonais</option>
                                                    <option value="Livre sterling">Livre sterling</option>
                                                    <option value="Franc suisse">Franc suisse</option>
                                                    <option value="Dollar canadien">Dollar canadien</option>
                                                    <option value="Yuan chinois">Yuan chinois</option>
                                                    <option value="Dirham Emirats Arabes Unis">Dirham Emirats Arabes Unis</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Montant</label>
                                                <input name="montant_in" value="{{ $item1->montant }}" type="number" 
                                                    class="form-control" oninput="test1()" id="montant_in_m" 
                                                    placeholder="Montant">
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="valeur_m">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Valeur</label>
                                                <input name="valeur" type="text" class="form-control" 
                                                    value="{{ $item1->valeur }}" id="val1" placeholder="Valeur" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="mont_fcfa_m">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Contre montant</label>
                                                <input name="mont_fcfa" type="text" class="form-control" 
                                                    value="{{ $item1->montant_con }}" id="montant_fcfa_m" 
                                                    placeholder="Contre montant" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nom de la société</label>
                                                <input name="nomsociete" type="text" class="form-control" 
                                                    value="{{ $item1->nomsociete }}" placeholder="Nom societe">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Catégorie</label>
                                                <input name="categorie" type="text" value="{{ $item1->categorie }}" 
                                                    class="form-control" placeholder="Catégorie">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Adresse</label>
                                                <input name="adresse" type="text" value="{{ $item1->adresse }}" 
                                                    class="form-control" placeholder="Adresse">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Téléphone</label>
                                                <input id="tel_id_m" type="tel" name="tel_client" 
                                                    value="{{ $item1->tel_client }}" class="form-control" 
                                                    placeholder="Téléphone">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Banque</label>
                                                <select style="top: 0px;" class="form-select position-relative" 
                                                    name="banque_client" aria-label="Default select example" required>
                                                    <option value="{{ $item1->banque_client }}">{{ $item1->banque_client }}</option>
                                                    <option value="Bank of Africa Bénin">Bank of Africa Bénin</option>
                                                    <option value="Banque internationale du Bénin">Banque internationale du Bénin</option>
                                                    <option value="Banque de l'habitat du Bénin">Banque de l'habitat du Bénin</option>
                                                    <option value="Ecobank">Ecobank</option>
                                                    <option value="Orabank Bénin">Orabank Bénin</option>
                                                    <option value="United Bank of Africa">United Bank of Africa</option>
                                                    <option value="Diamond Bank">Diamond Bank</option>
                                                    <option value="Société générale de banques du Bénin">Société générale de banques du Bénin</option>
                                                    <option value="Banque Sahélo-Saharienne pour l'Investissement et le Commerce">Banque Sahélo-Saharienne pour l'Investissement et le Commerce</option>
                                                    <option value="Banque atlantique du Bénin">Banque atlantique du Bénin</option>
                                                    <option value="BGFIBank Bénin">BGFIBank Bénin</option>
                                                    <option value="Afriland first bank benin">Afriland first bank benin</option>
                                                    <option value="Banque Africaine pour l'Investissement et le Commerce (BAIC)">Banque Africaine pour l'Investissement et le Commerce (BAIC)</option>
                                                    <option value="CBAO surcusale Attijariwafa Bank">CBAO surcusale Attijariwafa Bank</option>
                                                    <option value="Coris-Bank Bénin">Coris-Bank Bénin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Numéro de compte</label>
                                                <input name="num_compt_client" value="{{ $item1->num_compt_client }}" 
                                                    type="text" class="form-control" placeholder="Numéro de compte">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($item1->type_prs == 'physique')
                                <!-- Section Personne Physique -->
                                <div id="physique" style="display: block;">
                                    <div class="row mt-4">
                                        <div class="col">
                                            <h6 class="text-dark mb-3">Informations du demandeur</h6>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nature des opérations</label>
                                                <input name="nature_op" value="{{ $item1->nature_op }}" type="text" 
                                                    class="form-control" placeholder="Nature des opérations">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nature des produits</label>
                                                <input name="nature_pro" value="{{ $item1->nature_p }}" type="text" 
                                                    class="form-control" placeholder="Nature des produits">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nationalité</label>
                                                <select class="form-select position-relative" name="nationalite" 
                                                    aria-label="Default select example">
                                                    <option value="{{ $item1->nationalite }}">{{ $item1->nationalite }}</option>
                                                    <option value="Béninoise">Béninoise (Bénin)</option>
                                                    <option value="Française">Française (France)</option>
                                                    <option value="Americaine">Americaine (États-Unis)</option>
                                                    <option value="Allemande">Allemande (Allemagne)</option>
                                                    <!-- Autres options peuvent être ajoutées ici -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Devise</label>
                                                <select style="top: 0px;" class="form-select position-relative" 
                                                    name='currency_from' aria-label="Default select example" 
                                                    onchange="valeur_p()" id='currency_from_p' required>
                                                    <option value="{{ $item1->devise }}">{{ $item1->devise }}</option>
                                                    <option value="Euro">Euro</option>
                                                    <option value="Dollar us">Dollar us</option>
                                                    <option value="Yen japonais">Yen japonais</option>
                                                    <option value="Livre sterling">Livre sterling</option>
                                                    <option value="Franc suisse">Franc suisse</option>
                                                    <option value="Dollar canadien">Dollar canadien</option>
                                                    <option value="Yuan chinois">Yuan chinois</option>
                                                    <option value="Dirham Emirats Arabes Unis">Dirham Emirats Arabes Unis</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Montant</label>
                                                <input name="montant_in" value="{{ $item1->montant }}" type="number" 
                                                    oninput="test()" class="form-control" id="montant_in" 
                                                    placeholder="Montant">
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="valeur_p">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Valeur</label>
                                                <input name="valeur" type="text" id="val" 
                                                    value="{{ $item1->valeur }}" class="form-control" 
                                                    placeholder="Valeur" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="mont_fcfa_p">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Contre montant</label>
                                                <input name="mont_fcfa" type="text" class="form-control" 
                                                    value="{{ $item1->montant_con }}" id="montant_fcfa" 
                                                    placeholder="Contre montant" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nom client</label>
                                                <input name="nom_client" type="text" value="{{ $item1->nom_client }}" 
                                                    class="form-control" placeholder="Nom client">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Prénom client</label>
                                                <input name="prenom_client" type="text" value="{{ $item1->prenom_client }}" 
                                                    class="form-control" placeholder="Prénom client">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Profession client</label>
                                                <input name="profess_client" type="text" value="{{ $item1->profess_client }}" 
                                                    class="form-control" placeholder="Profession client">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Téléphone client</label>
                                                <input maxlength="14" minlength="12" value="{{ $item1->tel_client }}" 
                                                    name="tel_client" type="number" class="form-control" 
                                                    placeholder="Téléphone client">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Banque</label>
                                                <input name="banque_client" type="text" value="{{ $item1->banque_client }}" 
                                                    class="form-control" placeholder="Banque">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Numéro de compte</label>
                                                <input maxlength="12" minlength="12" name="num_compt_client" 
                                                    value="{{ $item1->num_compt_client }}" type="number" 
                                                    class="form-control" placeholder="Numéro de compte">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-5">
                                <div class="col">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
                                        <button type="submit" class="btn btn-primary">Enregistrer les corrections</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </main>

</x-app-layout>

<!-- Scripts JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fonctions JavaScript pour le formulaire de correction
    function toggleFields() {
        var type = document.getElementById('type').value;
        var societe = document.getElementById('morale');
        var particulier = document.getElementById('physique');

        if (type === 'morale') {
            societe.style.display = 'block';
            particulier.style.display = 'none';
        } else if (type === 'physique') {
            societe.style.display = 'none';
            particulier.style.display = 'block';
        } else {
            societe.style.display = 'none';
            particulier.style.display = 'none';
        }
    }

    // Appeler toggleFields() lors du chargement initial
    toggleFields();

    function valeur_p() {
        var devise = document.getElementById('currency_from_p').value;
        var valeur = document.getElementById('valeur_p');
        var mont_fcfa = document.getElementById('mont_fcfa_p');

        if (devise != "null") {
            valeur.style.display = 'block';
            mont_fcfa.style.display = 'block';
        }
        if (devise == "null") {
            valeur.style.display = 'none';
            mont_fcfa.style.display = 'none';
        }
    }
    valeur_p();

    $(document).ready(function() {
        $('#currency_from_p').on('change', function() {
            var monnaie = document.getElementById('currency_from_p').value;
            console.log(monnaie);

            if (monnaie !== 'null') {
                $.ajax({
                    type: 'POST',
                    url: '/get-devis',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        monnaie: monnaie,
                    },
                    dataType: 'JSON',
                    
                    success: function(data) {
                        $('#val').val(data.val);
                    },
                    error: function(response) {
                        $('#val').val('Erreur : devise introuvable.');
                    },
                });
            }
        });
    });

    function test() {
        var montant = document.getElementById('montant_in').value || 0;
        var valeur = document.getElementById('val').value || 0;
        var resultat = montant * valeur;
        console.log(valeur);
        document.getElementById('montant_fcfa').value = resultat;
    }
    test();

    function valeur_m() {
        var devise = document.getElementById('currency_from_m').value;
        var valeur = document.getElementById('valeur_m');
        var mont_fcfa = document.getElementById('mont_fcfa_m');

        var monnaie = document.getElementById('currency_from_m').value;
        console.log(monnaie);

        if (monnaie !== 'null') {
            $.ajax({
                type: 'POST',
                url: '/get-devis',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    monnaie: monnaie,
                },
                dataType: 'JSON',
                
                success: function(data) {
                    $('#val1').val(data.val);
                },
                error: function(response) {
                    $('#val1').val('Erreur : devise introuvable.');
                },
            });
        }
        if (devise != "null") {
            valeur.style.display = 'block';
            mont_fcfa.style.display = 'block';
        } else {
            valeur.style.display = 'none';
            mont_fcfa.style.display = 'none';
        }
    }
    valeur_m();

    function test1() {
        var montant = document.getElementById('montant_in_m').value || 0;
        var valeur = document.getElementById('val1').value || 0;
        var resultat = montant * valeur;
        console.log(valeur);
        document.getElementById('montant_fcfa_m').value = resultat;
    }
    test1();
</script>