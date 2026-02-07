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
                                        Enregistrement d'une demande - Suite
                                    </h5>
                                    @foreach ($demande as $item1)
                                        <p class="mb-0 text-sm">Dossier N°: {{ $numeroDossier }}</p>
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

            <!-- Formulaire de suite d'enregistrement -->
            @foreach ($user as $item)
                <form action="{{ route('store_form_ask_suite') }}" method="post">
                    <input type="hidden" name="id_user" value="{{ $item->id }}">
                    <input type="hidden" name="nom_demandeur" value="{{ $item->nom }}">
                    <input type="hidden" name="mail_demandeur" value="{{ $item->mail }}">
                    <input type="hidden" name="poste_demandeur" value="{{ $item->poste }}">
                    @csrf
            @endforeach

            @foreach ($demande as $item1)
                <input type="hidden" name="num_doss" value="{{ $numeroDossier }}">
                <input type="hidden" name="id_doss" value="{{ $item1->id }}">
            @endforeach

            <div class="mb-5 row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="card" id="basic-info">
                        <div class="card-header">
                            <h5>Informations de la demande</h5>
                        </div>
                        <div class="pt-0 card-body">
                            <!-- Informations de base -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                                        @foreach ($demande as $item1)
                                            <input name="date_depot" type="texte" value="{{ $item1->date }}"
                                                class="form-control" placeholder="Date de dépôt" readonly>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Nature des opérations</label>
                                        @foreach ($demande as $item1)
                                            <input name="nature_op" value="{{ $item1->nature_op }}" type="text"
                                                class="form-control" placeholder="Nature des opérations">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Nature des produits</label>
                                        @foreach ($demande as $item1)
                                            <input name="nature_pro" value="{{ $item1->nature_p }}" type="text"
                                                class="form-control" placeholder="Nature des produits">
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Informations financières -->
                            <div class="row mt-4">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Devise source</label>
                                        @php
                                            $devise = $item1->devise ?? '';
                                        @endphp
                                        <select class="form-select position-relative" name='currency_from' required>
                                            <option value="{{ $devise }}" selected>{{ $devise }}</option>
                                            <option value="AUD">Australia Dollar</option>
                                            <option value="EUR">Euro</option>
                                            <option value="GBP">Great Britain Pound</option>
                                            <option value="INR">India Rupee</option>
                                            <option value="USD">USA Dollar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Montant</label>
                                        <input name="montant_in" type="number" class="form-control"
                                            value="{{ $montantr ?? 0 }}" placeholder="Montant" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Devise cible</label>
                                        <select class="form-select position-relative" name='currency_to' required>
                                            <option value="XOF" selected>Francs CFA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Montant converti</label>
                                        <input name="montant_out" type="text" class="form-control"
                                            placeholder="Montant converti (calculé automatiquement)" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations du client -->
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Nom client</label>
                                        @foreach ($demande as $item1)
                                            <input name="nom_client" type="text" class="form-control"
                                                value="{{ $item1->nom_client }}" placeholder="Nom client" required>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Prénom client</label>
                                        @foreach ($demande as $item1)
                                            <input name="prenom_client" value="{{ $item1->prenom_client }}"
                                                type="text" class="form-control" placeholder="Prénom client"
                                                required>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Profession client</label>
                                        @foreach ($demande as $item1)
                                            <input name="profess_client" value="{{ $item1->profess_client }}"
                                                type="text" class="form-control" placeholder="Profession client">
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Informations de contact -->
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Téléphone client</label>
                                        @foreach ($demande as $item1)
                                            <input maxlength="14" minlength="12" value="{{ $item1->tel_client }}"
                                                name="tel_client" type="text" class="form-control"
                                                placeholder="Téléphone client" required>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Banque</label>
                                        @foreach ($demande as $item1)
                                            <input name="banque_client" type="text"
                                                value="{{ $item1->banque_client }}" class="form-control"
                                                placeholder="Banque" required>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label mt-4">Numéro de compte</label>
                                        @foreach ($demande as $item1)
                                            <input maxlength="12" minlength="12" name="num_compt_client"
                                                value="{{ $item1->num_compt_client }}" type="text"
                                                class="form-control" placeholder="Numéro de compte" required>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="row mt-5">
                                <div class="col">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
                                        <button type="submit" class="btn btn-primary">Finaliser
                                            l'enregistrement</button>
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
