<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            @foreach ($user as $item)
                <form action="{{ route('store_form_ask', $item->id) }}" method="post"
                    class="card-body cardbody-color p-lg-5">

                    @csrf
            @endforeach
            <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="card card-body" id="profile">


                        <div class="row z-index-2 justify-content-center align-items-center">
                            <div class="col-sm-auto col-4">

                            </div>
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">

                                    <p class="mb-0 font-weight-bold text-sm">
                                        Enregistrement d'une demande </p>
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
                            <h5>1ere Etape</h5>
                        </div>
                        <div class="pt-0 card-body">
                            <!-- Première partie du formulaire -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                                        <input name="date_depot" type="texte" value="{{ $date }}"
                                            class="form-control" id="" aria-describedby="" placeholder=""
                                            required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Type personne</label>
                                        <select class="form-select position-relative"
                                            aria-label="Default select example" id="type" onchange="toggleFields()"
                                            name="type" required>
                                            <option value="null">Personne?</option>
                                            <option value="morale">Personne morale</option>
                                            <option value="physique">Personne physique</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">IFU</label>
                                        <input name="ifu" type="texte" value="" class="form-control"
                                            id="ifu" aria-describedby="" maxlength="13" minlength="12"
                                            onchange="infopers()" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">N° enregistrement</label>
                                        <input name="num_save" type="texte" value="" class="form-control"
                                            id="" aria-describedby="" placeholder="" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Personne Physique -->
                            <div id="physique" style="display: none;">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Nature des opérations</label>
                                            <input name="nature_op" type="text" class="form-control" id=""
                                                placeholder="Nature des opérations">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Nature des produits</label>
                                            <input name="nature_pro" type="text" class="form-control" id=""
                                                placeholder="Nature des produits">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Nationalité du
                                                demandeur</label>
                                            <input name="nationalite" type="text" class="form-control"
                                                id="nationalite_id_p" placeholder="Nationalité">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Devise</label>
                                            <select style="top: 0px;" class="form-select position-relative"
                                                name='currency_from' aria-label="Default select example"
                                                onchange="valeur_p()" id='currency_from_p' required>
                                                <option value="null">Selectionner une devise</option>
                                                <option value="Euro">Euro</option>
                                                <option value="Dollar des États-Unis">Dollar us</option>
                                                <option value="Yen japonais">Yen japonais</option>
                                                <option value="Livre sterling">Livre sterling</option>
                                                <option value="Dollar canadien">Dollar canadien</option>
                                                <option value="Yuan chinois">Yuan chinois</option>
                                                <option value="Dirham des Émirats arabes unis">Dirham Emirats Arabes
                                                    Unis</option>
                                                <option value="Dinar algérien">Dinar algérien</option>
                                                <option value="Livre égyptienne">Livre égyptienne</option>
                                                <option value="Cedi ghanéen">Cedi ghanéen</option>
                                                <option value="Franc guinéen">Franc guinéen</option>
                                                <option value="Quetzal guatémaltèque">Quetzal guatémaltèque</option>
                                                <option value="Naira nigérian">Naira nigérian</option>
                                                <option value="Dollar néo-zélandais">Dollar néo-zélandais</option>
                                                <option value="Franc rwandais">Franc rwandais</option>
                                                <option value="Riyal saoudien">Riyal saoudien</option>
                                                <option value="Franc CFA d'Afrique centrale">Franc CFA d'Afrique
                                                    centrale</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Montant de la
                                                transaction</label>
                                            <input name="montant_in" type="number" oninput="test()"
                                                class="form-control" id="montant_in" placeholder="Montant">
                                        </div>
                                    </div>
                                    <div class="col" id="valeur_p">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Coût de la devise</label>
                                            <input name="valeur" type="text" id="val" class="form-control"
                                                placeholder="Valeur" readonly>
                                        </div>
                                    </div>
                                    <div class="col" id="mont_fcfa_p">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Contre montant</label>
                                            <input name="mont_fcfa" type="text" class="form-control"
                                                id="montant_fcfa" placeholder="Contre montant" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Nom du demandeur</label>
                                            <input name="nom_client" type="text" class="form-control"
                                                id="nom_id_p" placeholder="Nom client">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Prenom du demandeur</label>
                                            <input name="prenom_client" type="text" class="form-control"
                                                id="prenom_id_p" placeholder="Prenom client">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Profession du
                                                demandeur</label>
                                            <input name="profess_client" type="text" class="form-control"
                                                id="profess_id_p" placeholder="ProfClient">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Telephone du
                                                demandeur</label>
                                            <input id="tel_id_p" type="tel" name="tel_client"
                                                class="form-control" placeholder="TelClient">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Banque du demandeur</label>
                                            <input id="banque_id_p" type="texte" name="banque_client"
                                                class="form-control" placeholder="Banque">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Numéro de compte du
                                                demandeur</label>
                                            <input name="num_compt_client" type="text" min="11"
                                                max="12" class="form-control" id="num_compt_id_p"
                                                placeholder="Numéro de compte">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Personne Morale -->
                            <div id="morale" style="display: none;">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Nature des
                                                opérations</label>
                                            <input name="nature_op" type="text" class="form-control"
                                                id="" placeholder="Nature des opérations">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Nature des produits</label>
                                            <input name="nature_pro" type="text" class="form-control"
                                                id="" placeholder="Nature des produits">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Boite postale de la
                                                société</label>
                                            <input name="boite" type="text" class="form-control"
                                                id="boite_id_m" placeholder="Boite postale">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Devise</label>
                                            <select style="top: 0px;" id="currency_from_m"
                                                class="form-select position-relative" name='currency_from'
                                                aria-label="Default select example" onchange="valeur_m()" required>
                                                <option value="null">Selectionner une devise</option>
                                                <option value="Euro">Euro</option>
                                                <option value="Dollar des États-Unis">Dollar us</option>
                                                <option value="Yen japonais">Yen japonais</option>
                                                <option value="Livre sterling">Livre sterling</option>
                                                <option value="Dollar canadien">Dollar canadien</option>
                                                <option value="Yuan chinois">Yuan chinois</option>
                                                <option value="Dirham des Émirats arabes unis">Dirham Emirats Arabes
                                                    Unis</option>
                                                <option value="Dinar algérien">Dinar algérien</option>
                                                <option value="Livre égyptienne">Livre égyptienne</option>
                                                <option value="Cedi ghanéen">Cedi ghanéen</option>
                                                <option value="Franc guinéen">Franc guinéen</option>
                                                <option value="Quetzal guatémaltèque">Quetzal guatémaltèque</option>
                                                <option value="Naira nigérian">Naira nigérian</option>
                                                <option value="Dollar néo-zélandais">Dollar néo-zélandais</option>
                                                <option value="Franc rwandais">Franc rwandais</option>
                                                <option value="Riyal saoudien">Riyal saoudien</option>
                                                <option value="Franc CFA d'Afrique centrale">Franc CFA d'Afrique
                                                    centrale</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Montant de la
                                                transaction</label>
                                            <input name="montant_in" type="number" class="form-control"
                                                oninput="test1()" id="montant_in_m" placeholder="Montant">
                                        </div>
                                    </div>
                                    <div class="col" id="valeur_m">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Coût de la devise</label>
                                            <input name="valeur" type="text" class="form-control" id="val1"
                                                placeholder="Valeur" readonly>
                                        </div>
                                    </div>
                                    <div class="col" id="mont_fcfa_m">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Contre montant de la
                                                transaction</label>
                                            <input name="mont_fcfa" type="text" class="form-control"
                                                id="montant_fcfa_m" placeholder="Contre montant" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Nom de la société</label>
                                            <input name="nomsociete" type="text" class="form-control"
                                                id="nom_id_m" placeholder="Nom societe">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Catégorie de la
                                                société</label>
                                            <input name="categorie" type="text" class="form-control"
                                                id="categorie_id_m" placeholder="Catégorie">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Adresse de la
                                                société</label>
                                            <input name="adresse" type="text" class="form-control"
                                                id="adresse_id_m" placeholder="Adresse">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group" style="position: relative;top: 15px;">

                                            <label for="" class="form-label mt-4">Entrez le numéro de
                                                téléphone de la société:</label>

                                            <input id="tel_id_m" type="tel" name="tel_client"
                                                class="form-control" placeholder="TelClient">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Banque de la société</label>
                                            <input id="banque_id_m" type="texte" name="banque_client"
                                                class="form-control" placeholder="Banque">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="form-label mt-4">Numéro de compte de la
                                                société</label>
                                            <input name="num_compt_client" type="text" class="form-control"
                                                id="num_compt_id_m" placeholder="Numéro de compte">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </main>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function valeur_p() {
        // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
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
            //  console.log(monnaie);

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
        // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
        var montant = document.getElementById('montant_in').value || 0;
        var valeur = document.getElementById('val').value || 0;


        // Calcul de la multiplication des deux nombres.
        var resultat = montant * valeur;
        // Mise à jour du champ Résultat avec le résultat de la multiplication.
        document.getElementById('montant_fcfa').value = resultat;
    }
    test();


    function valeur_m() {
        // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
        var devise = document.getElementById('currency_from_m').value;
        var valeur = document.getElementById('valeur_m');
        var mont_fcfa = document.getElementById('mont_fcfa_m');

        var monnaie = document.getElementById('currency_from_m').value;
        //console.log(monnaie);

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


    function infopers() {

        var ifutake = document.getElementById('ifu').value;
        var val = document.getElementById('boss');

        if (ifutake !== '') {
            $.ajax({
                type: 'POST',
                url: '/get-info',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ifutake: ifutake,
                },

                dataType: 'JSON',
                success: function(info) {

                    // $('#val0').val(info.val0.nom);
                    $('#num_compt_id_p').val(info.val0.num_compt);
                    $('#tel_id_p').val(info.val0.tel);
                    $('#adresse_id_p').val(info.val0.adresse);
                    $('#boite_id_p').val(info.val0.boite);
                    $('#nom_id_p').val(info.val0.nom);
                    $('#prenom_id_p').val(info.val0.prenom);
                    // $('#email_id_p').val(info.val0.email);
                    $('#banque_id_p').val(info.val0.banque);
                    $('#profess_id_p').val(info.val0.profess);
                    // $('#type').val(info.val0.type_prs);
                    $('#nationalite_id_p').val(info.val0.nationalite);


                    $('#num_compt_id_m').val(info.val0.num_compt);
                    $('#tel_id_m').val(info.val0.tel);
                    $('#adresse_id_m').val(info.val0.adresse);
                    $('#boite_id_m').val(info.val0.boite);
                    $('#nom_id_m').val(info.val0.nomsociete);
                    $('#categorie_id_m').val(info.val0.categorie);
                    //  $('#email_id_m').val(info.val0.email);
                    $('#banque_id_m').val(info.val0.banque);
                    // $('#type').val(info.val0.type_prs);
                    console.log(info);
                    /*      val.style.display = 'block';
                         testfunction = 1; */


                },
                error: function(info) {
                    // Vérifie si des données sont reçues dans l'objet info
                    if (info) {
                        // Configuration des options Toastr
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-center",
                            "preventDuplicates": false,
                            "onclick": true,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };

                        // Affiche un message d'erreur avec Toastr
                        toastr.error("IFU incorrecte ou Veuillez contacter la direction de l'ANIP.");
                    }
                },
                /*        error: function() {
            // En cas d'erreur lors de la requête AJAX
                          console.error(xhr.responseText);
           toastr.error("Une erreur s'est produite lors de la récupération des informations.");
        }, */
            });
        }


    }
    infopers();

    function toggleFields() {
        var type = document.getElementById('type').value;
        var letype = document.getElementById('type');
        var societe = document.getElementById('morale');
        var particulier = document.getElementById('physique');

        if (type === 'morale') {
            societe.style.display = 'block';
            particulier.style.display = 'none';
            while (particulier.firstChild) {
                particulier.removeChild(particulier.firstChild);

            }
        } else if (type === 'physique') {
            societe.style.display = 'none';
            particulier.style.display = 'block';
            while (societe.firstChild) {
                societe.removeChild(societe.firstChild);
            }
        } else {
            societe.style.display = 'none';
            particulier.style.display = 'none';
        }
    }

    toggleFields();

    function test1() {
        // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
        var montant = document.getElementById('montant_in_m').value || 0;
        var valeur = document.getElementById('val1').value || 0;


        // Calcul de la multiplication des deux nombres.
        var resultat = montant * valeur;
        // Mise à jour du champ Résultat avec le résultat de la multiplication.
        document.getElementById('montant_fcfa_m').value = resultat;
    }
    test1();
</script>
