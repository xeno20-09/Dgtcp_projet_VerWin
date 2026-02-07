<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <!-- En-tête avec navigation -->
                        <div class="card-header border-bottom pb-3">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                <div>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-2">
                                            <li class="breadcrumb-item">
                                                <a href="{{ url()->previous() }}" class="text-secondary">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                                         stroke="currentColor" stroke-width="2" class="me-1">
                                                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                                                    </svg>
                                                    Retour
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{ url('HSecretaire') }}">Tableau de bord</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Détails de la demande</li>
                                        </ol>
                                    </nav>
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
                                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                @foreach ($demande as $item)
                                                    Créée le {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y à H:i') }}
                                                @endforeach
                                            </p>
                                        </div>
                                        @foreach($demande as $item)
                                            @php
                                                $statusClass = match($item->status_dmd) {
                                                    'Autorisée' => 'bg-success',
                                                    'Rejetée' => 'bg-danger',
                                                    'Suspendu' => 'bg-warning',
                                                    'En cours' => 'bg-info',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }} align-self-start">
                                                {{ $item->status_dmd }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                    
                            </div>
                        </div>

                        <!-- Corps de la carte -->
                        <div class="card-body p-4">
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
                                                        <label class="form-label text-sm text-muted mb-1">N° Dossier</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->numero_doss }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label text-sm text-muted mb-1">Date d'enregistrement</label>
                                                        <p class="mb-0 text-dark font-weight-bold">
                                                            {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label text-sm text-muted mb-1">Nature des produits</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->nature_p }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label text-sm text-muted mb-1">Nature des opérations</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->nature_op }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label text-sm text-muted mb-1">Montant</label>
                                                        <p class="mb-0 text-dark font-weight-bold">
                                                            {{ number_format($item->montant, 2, ',', ' ') }} {{ $item->devise }}
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label text-sm text-muted mb-1">Contre montant</label>
                                                        <p class="mb-0 text-dark font-weight-bold text-success">
                                                            {{ number_format($item->montant_con, 0, ',', ' ') }} FCFA
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
                                            <div class="timeline">
                                                @foreach ($demande as $item)
                                                    <div class="timeline-item @if($item->vu_secret) completed @endif">
                                                        <div class="timeline-marker bg-primary"></div>
                                                        <div class="timeline-content">
                                                            <h6 class="mb-1">Sécrétaire</h6>
                                                            <p class="text-sm text-muted mb-0">
                                                                @if($item->vu_secret)
                                                                    <span class="text-success">
                                                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" class="me-1">
                                                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                                                        </svg>
                                                                        Traité le {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                                                    </span>
                                                                @else
                                                                    <span class="text-warning">En attente</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item @if($item->vu_verifi) completed @endif">
                                                        <div class="timeline-marker bg-info"></div>
                                                        <div class="timeline-content">
                                                            <h6 class="mb-1">Vérificateur</h6>
                                                            <p class="text-sm text-muted mb-0">
                                                                @if($item->vu_verifi)
                                                                    <span class="text-success">Traité</span>
                                                                @else
                                                                    <span class="text-warning">En attente</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item @if($item->vu_chef_division) completed @endif">
                                                        <div class="timeline-marker bg-warning"></div>
                                                        <div class="timeline-content">
                                                            <h6 class="mb-1">Chef division</h6>
                                                            <p class="text-sm text-muted mb-0">
                                                                @if($item->vu_chef_division)
                                                                    <span class="text-success">Traité</span>
                                                                @else
                                                                    <span class="text-warning">En attente</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item @if($item->vu_chef_bureau) completed @endif">
                                                        <div class="timeline-marker bg-danger"></div>
                                                        <div class="timeline-content">
                                                            <h6 class="mb-1">Chef bureau</h6>
                                                            <p class="text-sm text-muted mb-0">
                                                                @if($item->vu_chef_bureau)
                                                                    <span class="text-success">Traité</span>
                                                                @else
                                                                    <span class="text-warning">En attente</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item @if($item->vu_damf) completed @endif">
                                                        <div class="timeline-marker bg-success"></div>
                                                        <div class="timeline-content">
                                                            <h6 class="mb-1">Directeur</h6>
                                                            <p class="text-sm text-muted mb-0">
                                                                @if($item->vu_damf)
                                                                    <span class="text-success">Décision finale prise</span>
                                                                @else
                                                                    <span class="text-warning">En attente de décision</span>
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
                                            <h6 class="mb-0">Informations du demandeur</h6>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($demande as $item)
                                                @if ($item->nom_client)
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <div class="alert alert-info bg-info bg-opacity-10 border border-info">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar avatar-sm bg-info me-3">
                                                                        <span class="text-white">PP</span>
                                                                    </div>
                                                                    <div>
                                                                        <p class="mb-0 text-dark font-weight-bold">Personne Physique</p>
                                                                        <small class="text-muted">Type de demandeur</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Nom</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->nom_client }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Prénom</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->prenom_client }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Profession</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->profess_client }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Téléphone</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                <a href="tel:{{ $item->tel_client }}" class="text-decoration-none">
                                                                    {{ $item->tel_client }}
                                                                </a>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Banque</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->banque_client }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Numéro de compte</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->num_compt_client }}</p>
                                                        </div>
                                                        @if($item->nationalite)
                                                            <div class="col-md-4">
                                                                <label class="form-label text-sm text-muted mb-1">Nationalité</label>
                                                                <p class="mb-0 text-dark font-weight-bold">{{ $item->nationalite }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @elseif ($item->nomsociete)
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <div class="alert alert-warning bg-warning bg-opacity-10 border border-warning">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar avatar-sm bg-warning me-3">
                                                                        <span class="text-white">PM</span>
                                                                    </div>
                                                                    <div>
                                                                        <p class="mb-0 text-dark font-weight-bold">Personne Morale</p>
                                                                        <small class="text-muted">Type de demandeur</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Nom de la société</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->nomsociete }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Catégorie</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->categorie }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Adresse</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->adresse }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Téléphone</label>
                                                            <p class="mb-0 text-dark font-weight-bold">
                                                                <a href="tel:{{ $item->tel_client }}" class="text-decoration-none">
                                                                    {{ $item->tel_client }}
                                                                </a>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Banque</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->banque_client }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-sm text-muted mb-1">Numéro de compte</label>
                                                            <p class="mb-0 text-dark font-weight-bold">{{ $item->num_compt_client }}</p>
                                                        </div>
                                                        @if($item->boite)
                                                            <div class="col-md-4">
                                                                <label class="form-label text-sm text-muted mb-1">Boîte postale</label>
                                                                <p class="mb-0 text-dark font-weight-bold">{{ $item->boite }}</p>
                                                            </div>
                                                        @endif
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
                                                        <label class="form-label text-sm text-muted mb-1">Nom</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->nom_benefi }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label text-sm text-muted mb-1">Prénom</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->prenom_benefi }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label text-sm text-muted mb-1">Profession</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->profess_benefi ?? 'Non spécifié' }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label text-sm text-muted mb-1">Banque</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->banque_benefi }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label text-sm text-muted mb-1">Pays</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->pays_benifi }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label text-sm text-muted mb-1">Numéro de compte</label>
                                                        <p class="mb-0 text-dark font-weight-bold">{{ $item->num_compt_benefi }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section pièces jointes -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Pièces jointes</h6>
                                            @if($pieces)
                                                <span class="badge bg-primary">{{ count($pieces) }} pièce(s)</span>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            @if($pieces)
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Intitulé</th>
                                                                <th>Référence</th>
                                                                <th>Montant initial</th>
                                                                <th>Montant ligne</th>
                                                                <th>Montant restant</th>
                                                                <th>Date d'expiration</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($pieces as $piece)
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" 
                                                                                 stroke="currentColor" stroke-width="2" class="text-primary me-2">
                                                                                <path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/>
                                                                                <polyline points="13 2 13 9 20 9"/>
                                                                            </svg>
                                                                            <span>{{ $piece->libellepiece }}</span>
                                                                        </div>
                                                                    </td>
                                                                    <td><code>{{ $piece->referencespiece }}</code></td>
                                                                    <td>{{ number_format($piece->montantinitial, 2, ',', ' ') }}</td>
                                                                    <td>{{ number_format($piece->montantligne, 2, ',', ' ') }}</td>
                                                                    <td>{{ number_format($piece->montantrestant, 2, ',', ' ') }}</td>
                                                                    <td>
                                                                        @if($piece->dateexpi)
                                                                            {{ \Carbon\Carbon::parse($piece->dateexpi)->format('d/m/Y') }}
                                                                        @else
                                                                            <span class="text-muted">Non spécifiée</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-sm btn-outline-primary">
                                                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" 
                                                                                 stroke="currentColor" stroke-width="2">
                                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                                                <circle cx="12" cy="12" r="3"/>
                                                                            </svg>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <div class="text-center py-4">
                                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" 
                                                         stroke="currentColor" stroke-width="1" class="text-muted mb-3">
                                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                                              d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                                                    </svg>
                                                    <p class="text-muted mb-0">Aucune pièce jointe disponible</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pied de page avec actions -->
                        <div class="card-footer border-top pt-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ url('HSecretaire') }}" class="btn btn-outline-primary">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                             stroke="currentColor" stroke-width="2" class="me-2">
                                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        Tableau de bord
                                    </a>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                             stroke="currentColor" stroke-width="2" class="me-2">
                                            <path d="M19 12H5M12 19l-7-7 7-7"/>
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
