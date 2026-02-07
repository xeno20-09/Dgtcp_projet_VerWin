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
                                        <i class="fas fa-file-invoice-dollar text-white opacity-10"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">Récapitulatif des montants</h5>
                                        <p class="text-sm mb-0">Comparaison des montants des demandes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Comparaison Montants / Montants
                                        Initiaux</h6>
                                    <p class="text-sm">Voir le détail des montants par dossier</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <!-- Filtres ou actions supplémentaires peuvent être ajoutés ici -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                <div class="input-group w-sm-25 ms-auto">
                                    <span class="input-group-text text-body">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Rechercher un dossier...">
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">N° Dossier
                                            </th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Client</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Montant Demande</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Montant Initial</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Différence</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($demande as $itemd)
                                            @php
                                                $matchingPiece = null;
                                                foreach ($piece as $itemp) {
                                                    if ($itemp->numero_doss === $itemd->numero_doss) {
                                                        $matchingPiece = $itemp;
                                                        break;
                                                    }
                                                }

                                                // Calculer la différence
                                                $montantDemande = $itemd->montant;
                                                $montantInitial = $matchingPiece ? $matchingPiece->montantinitial : 0;
                                                $difference = $montantInitial - $montantDemande;

                                                // Déterminer le statut et la couleur
                                                if ($montantDemande == 0 && $montantInitial == 0) {
                                                    $statut = 'Aucun montant';
                                                    $badgeClass = 'border border-secondary text-secondary bg-secondary';
                                                } elseif ($difference == 0) {
                                                    $statut = 'Complet';
                                                    $badgeClass = 'border border-success text-success bg-success';
                                                } elseif ($difference > 0) {
                                                    $statut = 'Excédent';
                                                    $badgeClass = 'border border-warning text-warning bg-warning';
                                                } else {
                                                    $statut = 'Déficit';
                                                    $badgeClass = 'border border-danger text-danger bg-danger';
                                                }
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-sm font-weight-semibold">
                                                                {{ $itemd->numero_doss }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">
                                                        {{ $itemd->nom_client }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-dark text-sm font-weight-bold">
                                                        {{ number_format($montantDemande, 2, ',', ' ') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-dark text-sm font-weight-bold">
                                                        @if ($matchingPiece)
                                                            {{ number_format($montantInitial, 2, ',', ' ') }}
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-sm font-weight-bold 
                                                        {{ $difference > 0 ? 'text-success' : ($difference < 0 ? 'text-danger' : 'text-dark') }}">
                                                        {{ number_format($difference, 2, ',', ' ') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge badge-sm {{ $badgeClass }}">
                                                        {{ $statut }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Résumé et actions -->
                            <div class="card-footer border-top py-3 px-3">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="d-flex flex-column">
                                            <h6 class="text-dark mb-2">Récapitulatif</h6>
                                            @foreach ($demande as $itemd)
                                                @php
                                                    $matchingPiece = null;
                                                    foreach ($piece as $itemp) {
                                                        if ($itemp->numero_doss === $itemd->numero_doss) {
                                                            $matchingPiece = $itemp;
                                                            break;
                                                        }
                                                    }
                                                    $montantInitial = $matchingPiece
                                                        ? $matchingPiece->montantinitial
                                                        : 0;
                                                @endphp
                                                <p class="text-sm mb-1">
                                                    Selon le récapitulatif, Mr/Mme
                                                    <strong>{{ $itemd->nom_client }}</strong>
                                                    pour le dossier <strong>{{ $itemd->numero_doss }}</strong>,
                                                    le montant restant initial est de
                                                    <strong>{{ number_format($montantInitial, 2, ',', ' ') }}</strong>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-end align-items-center h-100">
                                            <div class="text-end">
                                                <p class="text-sm mb-1">
                                                    <strong>Total demandes:</strong> {{ count($demande) }}
                                                </p>
                                                <p class="text-sm mb-0">
                                                    <strong>Total pièces:</strong> {{ count($piece) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cartes de statistiques -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border shadow-xs">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Dossiers traités</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ count($demande) }}
                                            <span class="text-success text-sm font-weight-bolder">+0%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-xl">
                                        <i class="fas fa-folder text-white opacity-10"></i>
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
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Pièces jointes</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ count($piece) }}
                                            <span class="text-success text-sm font-weight-bolder">+0%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow text-center border-radius-xl">
                                        <i class="fas fa-paperclip text-white opacity-10"></i>
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
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Correspondances</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            @php
                                                $correspondances = 0;
                                                foreach ($demande as $itemd) {
                                                    foreach ($piece as $itemp) {
                                                        if ($itemp->numero_doss === $itemd->numero_doss) {
                                                            $correspondances++;
                                                            break;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            {{ $correspondances }}
                                            <span class="text-success text-sm font-weight-bolder">+0%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow text-center border-radius-xl">
                                        <i class="fas fa-check-circle text-white opacity-10"></i>
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
