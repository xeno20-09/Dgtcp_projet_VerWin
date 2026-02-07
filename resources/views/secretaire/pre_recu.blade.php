<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- En-tête de la page -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-xl">
                                        <i class="fas fa-receipt text-white opacity-10"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">Récépissé de demande</h5>
                                        <p class="text-sm mb-0">Détails et informations de connexion</p>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('get_rec_ask', ['email' => $data['email'], 'password' => $data['password'], 'numero_doss' => $data['numero_doss']]) }}"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M12 16.5l-5-5h3v-4h4v4h3l-5 5zm-7 4h14v-2H5v2zm0-6h14v-2H5v2z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Télécharger PDF</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section principale -->
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Détails du récépissé</h6>
                                    <p class="text-sm">Informations complètes sur la demande</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Informations du dossier -->
                            <div class="row mb-5">
                                <div class="col-12">
                                    <h5 class="mb-3">Informations du dossier</h5>
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">N°
                                                        Dossier</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                        Date</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Montant (Devise)</th>
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        Montant (FCFA)</th>
                                                    @if ($data['nom_client'])
                                                        <th
                                                            class="text-secondary text-xs font-weight-semibold opacity-7">
                                                            Nom du client</th>
                                                        <th
                                                            class="text-secondary text-xs font-weight-semibold opacity-7">
                                                            Prénom du client</th>
                                                    @endif
                                                    @if ($data['nomsociete'])
                                                        <th
                                                            class="text-secondary text-xs font-weight-semibold opacity-7">
                                                            Nom société</th>
                                                        <th
                                                            class="text-secondary text-xs font-weight-semibold opacity-7">
                                                            Catégorie</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                                <h6 class="mb-0 text-sm font-weight-semibold">
                                                                    {{ $data['numero_doss'] }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                                            {{ $data['date'] }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-dark text-sm font-weight-bold">
                                                            {{ $data['montant'] }} ({{ $data['devise'] }})
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-dark text-sm font-weight-bold">
                                                            {{ $data['montant_con'] }} FCFA
                                                        </span>
                                                    </td>
                                                    @if ($data['nom_client'])
                                                        <td>
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $data['nom_client'] }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $data['prenom_client'] }}
                                                            </p>
                                                        </td>
                                                    @endif
                                                    @if ($data['nomsociete'])
                                                        <td>
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $data['nomsociete'] }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">
                                                                {{ $data['categorie'] ?? 'N/A' }}
                                                            </p>
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Date de traitement -->
                                    @php
                                        $dateOrigine = new DateTime($data['date']);
                                        $dateModifiee = $dateOrigine->modify('+2 days');
                                        $ladate = $dateModifiee->format('d-m-Y');
                                    @endphp
                                    <div class="alert alert-info mt-3" role="alert">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="icon icon-shape icon-sm bg-info text-center border-radius-xl me-2">
                                                <i class="fas fa-calendar-check text-white opacity-10"></i>
                                            </div>
                                            <div>
                                                <span class="text-sm font-weight-bold">
                                                    Votre demande sera prête au plus tard le {{ $ladate }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations de connexion -->
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-3">Informations de connexion</h5>
                                    <div class="card border shadow-xs">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0">
                                                    <thead class="bg-gray-100">
                                                        <tr>
                                                            <th
                                                                class="text-secondary text-xs font-weight-semibold opacity-7">
                                                                Email</th>
                                                            <th
                                                                class="text-secondary text-xs font-weight-semibold opacity-7">
                                                                Mot de passe</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div
                                                                        class="icon icon-shape icon-sm bg-gradient-dark text-center border-radius-xl me-2">
                                                                        <i
                                                                            class="fas fa-envelope text-white opacity-10"></i>
                                                                    </div>
                                                                    <span class="text-sm font-weight-semibold">
                                                                        {{ $data['email'] }}
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div
                                                                        class="icon icon-shape icon-sm bg-gradient-success text-center border-radius-xl me-2">
                                                                        <i class="fas fa-key text-white opacity-10"></i>
                                                                    </div>
                                                                    <span class="text-sm font-weight-semibold">
                                                                        {{ $data['password'] }}
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="alert alert-warning mt-3" role="alert">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm bg-warning text-center border-radius-xl me-2">
                                                        <i
                                                            class="fas fa-exclamation-triangle text-white opacity-10"></i>
                                                    </div>
                                                    {{--      <div>
                                                        <span class="text-sm font-weight-bold">
                                                            Conservez ces informations en lieu sûr. Elles vous seront
                                                            nécessaires pour suivre votre demande.
                                                        </span>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Résumé en cartes -->
                            <div class="row mt-5">
                                <div class="col-md-4 mb-4">
                                    <div class="card border shadow-xs">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="numbers">
                                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Numéro
                                                            de dossier</p>
                                                        <h5 class="font-weight-bolder mb-0">
                                                            {{ $data['numero_doss'] }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <div
                                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-xl">
                                                        <i class="fas fa-file-alt text-white opacity-10"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="card border shadow-xs">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="numbers">
                                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                                            Montant total</p>
                                                        <h5 class="font-weight-bolder mb-0">
                                                            {{ $data['montant_con'] }} FCFA
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <div
                                                        class="icon icon-shape bg-gradient-success shadow text-center border-radius-xl">
                                                        <i class="fas fa-money-bill-wave text-white opacity-10"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="card border shadow-xs">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="numbers">
                                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Date
                                                            limite</p>
                                                        <h5 class="font-weight-bolder mb-0">
                                                            {{ $ladate }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <div
                                                        class="icon icon-shape bg-gradient-warning shadow text-center border-radius-xl">
                                                        <i class="fas fa-clock text-white opacity-10"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left me-2"></i> Retour
                                        </a>
                                        <div>
                                            <button onclick="window.print()" class="btn btn-outline-dark me-2">
                                                <i class="fas fa-print me-2"></i> Imprimer
                                            </button>
                                            <a href="{{ route('get_rec_ask', ['email' => $data['email'], 'password' => $data['password'], 'numero_doss' => $data['numero_doss']]) }}"
                                                class="btn btn-dark">
                                                <i class="fas fa-download me-2"></i> Télécharger PDF
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>

</x-app-layout>

<!-- Script pour l'impression -->
<script>
    function printReceipt() {
        window.print();
    }

    // Copier les informations de connexion
    function copyCredentials() {
        const credentials = `Email: {{ $data['email'] }}\nMot de passe: {{ $data['password'] }}`;
        navigator.clipboard.writeText(credentials)
            .then(() => {
                alert('Informations de connexion copiées dans le presse-papier !');
            })
            .catch(err => {
                console.error('Erreur lors de la copie: ', err);
            });
    }
</script>
