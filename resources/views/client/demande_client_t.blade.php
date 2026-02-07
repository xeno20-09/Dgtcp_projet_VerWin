<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('/assets/img/header-blue-purple.jpg')"></div>

        <div class="container-fluid py-4 px-5">
            <div class="row mt-n6 mb-6">
                <div class="col-lg-12 col-sm-6">
                    <div class="card blur border border-white mb-4 shadow-xs">
                        <div class="card-body p-4">

                            <p class="text-sm mb-1">{{ Auth::user()->firstname }}
                                {{ Auth::user()->lastname }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="horizontal mb-4 dark">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <!-- En-tête avec navigation -->
                        <div class="card-header border-bottom pb-3">
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                <div>

                                    <div class="d-flex align-items-center gap-3">
                                        <div>
                                            <h1 class="h4 mb-1">
                                                @foreach ($demande as $item)
                                                    Demande {{ $item->numero_doss }}
                                                @endforeach
                                            </h1>
                                            <p class="text-sm text-muted mb-0">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" class="me-1">
                                                    <path
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                @foreach ($demande as $item)
                                                    Créée le
                                                    {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y à H:i') }}
                                                @endforeach
                                            </p>
                                        </div>
                                        @foreach ($demande as $item)
                                            @php
                                                $statusClass = match ($item->status_dmd_cb) {
                                                    'Autorisée' => 'bg-success',
                                                    'Rejetée' => 'bg-danger',
                                                    'Suspendu' => 'bg-warning',
                                                    'En cours' => 'bg-info',
                                                    default => 'bg-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }} align-self-start">
                                                {{ $item->status_dmd_cb }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Bouton d'export PDF -->
                                @if ($pic == 1)
                                    <div class="mt-3 mt-md-0">
                                        @foreach ($demande as $item)
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ URL::to('/demande/pdf', ['id' => $item->numero_doss]) }}">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" class="me-2">
                                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                                    <polyline points="14 2 14 8 20 8" />
                                                    <line x1="16" y1="13" x2="8" y2="13" />
                                                    <line x1="16" y1="17" x2="8" y2="17" />
                                                    <polyline points="10 9 9 9 8 9" />
                                                </svg>
                                                Exporter en PDF
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Corps de la carte -->
                        <div class="card-body p-4">
                            @if ($pic == 0)
                                <!-- Message d'attente -->
                                <div class="text-center py-5">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1" class="text-muted mb-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h5 class="text-muted mb-2">Votre demande est en cours de traitement</h5>
                                    <p class="text-muted mb-4">Veuillez revenir ultérieurement pour consulter les
                                        détails de votre demande.</p>

                                </div>
                            @else
                                <!-- Section d'informations principales -->
                                <div class="row mb-5">
                                    <div class="col-md-6 mb-4">
                                        <div class="card border h-100">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Informations de la demande</h6>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($demande as $item)
                                                    <div class="row g-3">
                                                        <div class="col-6">
                                                            <label class="form-label text-sm text-muted mb-1">N°
                                                                Dossier</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ $item->numero_doss }}</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label text-sm text-muted mb-1">Date
                                                                d'enregistrement</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y H:i') }}
                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label text-sm text-muted mb-1">Nature des
                                                                produits</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ $item->nature_p }}
                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label text-sm text-muted mb-1">Nature des
                                                                opérations</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ $item->nature_op }}</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <label
                                                                class="form-label text-sm text-muted mb-1">Montant</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ number_format($item->montant, 2, ',', ' ') }}
                                                                {{ $item->devise }}
                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label text-sm text-muted mb-1">Contre
                                                                montant</label>
                                                            <p class="mb-0 text-dark font-weight-bold text-success">
                                                                {{ number_format($item->montant_con, 0, ',', ' ') }}
                                                                FCFA
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section suivi de progression -->
                                    <div class="col-md-6 mb-4">
                                        <div class="card border h-100">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Suivi de la demande</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="">
                                                    @foreach ($demande as $item)
                                                        <div
                                                            class="timeline-item @if ($item->vu_secret) completed @endif">
                                                            <div class="timeline-marker bg-primary"></div>
                                                            <div class="timeline-content">
                                                                <h6 class="mb-1">Enregistrement</h6>
                                                                <p class="text-sm text-muted mb-0">
                                                                    @if ($item->vu_secret)
                                                                        <span class="text-success">
                                                                            <svg width="12" height="12"
                                                                                viewBox="0 0 24 24" fill="currentColor"
                                                                                class="me-1">
                                                                                <path
                                                                                    d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                                                                            </svg>
                                                                            Terminé
                                                                        </span>
                                                                    @else
                                                                        <span class="text-warning">En attente</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="timeline-item @if ($item->vu_verifi) completed @endif">
                                                            <div class="timeline-marker bg-info"></div>
                                                            <div class="timeline-content">
                                                                <h6 class="mb-1">Vérification</h6>
                                                                <p class="text-sm text-muted mb-0">
                                                                    @if ($item->vu_verifi)
                                                                        <span class="text-success">Terminé</span>
                                                                    @else
                                                                        <span class="text-warning">En attente</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="timeline-item @if ($item->vu_chef_division) completed @endif">
                                                            <div class="timeline-marker bg-warning"></div>
                                                            <div class="timeline-content">
                                                                <h6 class="mb-1">Validation</h6>
                                                                <p class="text-sm text-muted mb-0">
                                                                    @if ($item->vu_chef_division)
                                                                        <span class="text-success">Terminé</span>
                                                                    @else
                                                                        <span class="text-warning">En attente</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="timeline-item @if ($item->vu_chef_bureau) completed @endif">
                                                            <div class="timeline-marker bg-danger"></div>
                                                            <div class="timeline-content">
                                                                <h6 class="mb-1">Approbation</h6>
                                                                <p class="text-sm text-muted mb-0">
                                                                    @if ($item->vu_chef_bureau)
                                                                        <span class="text-success">Terminé</span>
                                                                    @else
                                                                        <span class="text-warning">En attente</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="timeline-item @if ($item->vu_damf) completed @endif">
                                                            <div class="timeline-marker bg-success"></div>
                                                            <div class="timeline-content">
                                                                <h6 class="mb-1">Décision finale</h6>
                                                                <p class="text-sm text-muted mb-0">
                                                                    @if ($item->vu_damf)
                                                                        <span class="text-success">Terminé</span>
                                                                    @else
                                                                        <span class="text-warning">En attente</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section détails du demandeur -->
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">
                                                    @foreach ($demande as $item)
                                                        @if ($item['type_prs'] != 'morale')
                                                            Informations du demandeur
                                                        @else
                                                            Informations de la société
                                                        @endif
                                                    @endforeach
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($demande as $item)
                                                    @if ($item['type_prs'] != 'morale')
                                                        <!-- Personne Physique -->
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <div
                                                                    class="alert alert-info bg-info bg-opacity-10 border border-info">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar avatar-sm bg-info me-3">
                                                                            <span class="text-white">PP</span>
                                                                        </div>
                                                                        <div>
                                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                                Personne Physique</p>
                                                                            <small class="text-muted">Type de
                                                                                demandeur</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <label
                                                                    class="form-label text-sm text-muted mb-1">Nom</label>
                                                                <p class="mb-0 text-dark font-weight-bold">
                                                                    {{ $item->nom_client }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label
                                                                    class="form-label text-sm text-muted mb-1">Prénom</label>
                                                                <p class="mb-0 text-dark font-weight-bold">
                                                                    {{ $item->prenom_client }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label
                                                                    class="form-label text-sm text-muted mb-1">Banque</label>
                                                                <p class="mb-0 text-dark font-weight-bold">
                                                                    {{ $item->banque_client }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label
                                                                    class="form-label text-sm text-muted mb-1">Numéro
                                                                    de
                                                                    compte</label>
                                                                <p class="mb-0 text-dark font-weight-bold">
                                                                    {{ $item->num_compt_client }}</p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <!-- Personne Morale -->
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <div
                                                                    class="alert alert-warning bg-warning bg-opacity-10 border border-warning">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar avatar-sm bg-warning me-3">
                                                                            <span class="text-white">PM</span>
                                                                        </div>
                                                                        <div>
                                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                                Personne Morale</p>
                                                                            <small class="text-muted">Type de
                                                                                demandeur</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label text-sm text-muted mb-1">Nom
                                                                    de la
                                                                    société</label>
                                                                <p class="mb-0 text-dark font-weight-bold">
                                                                    {{ $item->nomsociete }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label
                                                                    class="form-label text-sm text-muted mb-1">Banque</label>
                                                                <p class="mb-0 text-dark font-weight-bold">
                                                                    {{ $item->banque_client }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label
                                                                    class="form-label text-sm text-muted mb-1">Numéro
                                                                    de
                                                                    compte</label>
                                                                <p class="mb-0 text-dark font-weight-bold">
                                                                    {{ $item->num_compt_client }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section bénéficiaire -->
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Informations du bénéficiaire</h6>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($demande as $item)
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label
                                                                class="form-label text-sm text-muted mb-1">Nom</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ $item->nom_benefi }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label
                                                                class="form-label text-sm text-muted mb-1">Prénom</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ $item->prenom_benefi }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label
                                                                class="form-label text-sm text-muted mb-1">Banque</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ $item->banque_benefi }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Numéro de
                                                                compte</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ $item->num_compt_benefi }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section position et motif -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">État de la demande</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label text-sm text-muted mb-1">Position
                                                            actuelle</label>
                                                        @foreach ($demande as $item)
                                                            @php
                                                                $position = '';
                                                                if (
                                                                    $item['vu_secret'] == 1 &&
                                                                    $item['vu_verifi'] == 0 &&
                                                                    $item['vu_chef_division'] == 0 &&
                                                                    $item['vu_chef_bureau'] == 0 &&
                                                                    $item['vu_damf'] == 0
                                                                ) {
                                                                    $position = 'Vérificateur';
                                                                } elseif (
                                                                    $item['vu_secret'] == 1 &&
                                                                    $item['vu_verifi'] == 1 &&
                                                                    $item['vu_chef_division'] == 0 &&
                                                                    $item['vu_chef_bureau'] == 0 &&
                                                                    $item['vu_damf'] == 0
                                                                ) {
                                                                    $position = 'Chef division';
                                                                } elseif (
                                                                    $item['vu_secret'] == 1 &&
                                                                    $item['vu_verifi'] == 1 &&
                                                                    $item['vu_chef_division'] == 1 &&
                                                                    $item['vu_chef_bureau'] == 0 &&
                                                                    $item['vu_damf'] == 0
                                                                ) {
                                                                    $position = 'Chef bureau';
                                                                } elseif (
                                                                    $item['vu_secret'] == 1 &&
                                                                    $item['vu_verifi'] == 1 &&
                                                                    $item['vu_chef_division'] == 1 &&
                                                                    $item['vu_chef_bureau'] == 1 &&
                                                                    $item['vu_damf'] == 0
                                                                ) {
                                                                    $position = 'Directeur';
                                                                } elseif (
                                                                    $item['vu_secret'] == 1 &&
                                                                    $item['vu_verifi'] == 1 &&
                                                                    $item['vu_chef_division'] == 1 &&
                                                                    $item['vu_chef_bureau'] == 1 &&
                                                                    $item['vu_damf'] == 1
                                                                ) {
                                                                    $position = $item['status_dmd_cb'];
                                                                } else {
                                                                    $position = 'En attente';
                                                                }
                                                            @endphp
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                {{ $position }}</p>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-md-6">
                                                        @foreach ($demande as $item)
                                                            @if ($item['status_dmd_cb'] != 'Autorisée' && $item['motif'])
                                                                <label
                                                                    class="form-label text-sm text-muted mb-1">Motif</label>
                                                                <p
                                                                    class="mb-0 text-dark font-weight-bold {{ $item['status_dmd_cb'] == 'Rejetée' ? 'text-danger' : 'text-warning' }}">
                                                                    {{ $item['motif'] }}
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Pied de page avec actions -->
                        <div class="card-footer border-top pt-3">
                            <div class="d-flex justify-content-between">

                                <div class="d-flex gap-2">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" class="me-2">
                                            <path d="M19 12H5M12 19l-7-7 7-7" />
                                        </svg>
                                        Retour
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

@push('styles')
    <style>
        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e9ecef;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item.completed .timeline-marker {
            background-color: #28a745 !important;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
        }

        .timeline-marker {
            position: absolute;
            left: -2rem;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .timeline-content {
            margin-left: 1rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .border {
            border-color: #e9ecef !important;
        }
    </style>
@endpush
