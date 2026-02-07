<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <!-- En-tête avec navigation -->
                        <div class="card-header border-bottom pb-3">
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                <div>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-2">
                                            <li class="breadcrumb-item">
                                                <a href="{{ url()->previous() }}" class="text-secondary">
                                                    <svg width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        class="me-1">
                                                        <path d="M19 12H5M12 19l-7-7 7-7" />
                                                    </svg>
                                                    Retour
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{ url('Admin') }}">Tableau de
                                                    bord</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Modification
                                                d'utilisateur</li>
                                        </ol>
                                    </nav>
                                    <div class="d-flex align-items-center gap-3">
                                        <div>
                                            <h1 class="h4 mb-1">
                                                @foreach ($user as $item_c)
                                                    Modification de l'utilisateur {{ $item_c['firstname'] }}
                                                    {{ $item_c['lastname'] }}
                                                @endforeach
                                            </h1>
                                            <p class="text-sm text-muted mb-0">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" class="me-1">
                                                    <path
                                                        d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                                </svg>
                                                Mise à jour des informations et du rôle
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulaire -->
                        <div class="card-body p-4">
                            @foreach ($user as $item_c)
                                <form action="{{ route('store_user', $item_c->id) }}" method="Post">
                                    @csrf

                                    <!-- Informations principales -->
                                    <div class="row mb-4">
                                        <div class="col-md-6 mb-3">
                                            <div class="card border h-100">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0">Informations personnelles</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="form-label text-sm text-muted mb-1">Nom
                                                                    complet</label>
                                                                <input
                                                                    value="{{ $item_c['firstname'] }} {{ $item_c['lastname'] }}"
                                                                    name="name" type="text" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="form-label text-sm text-muted mb-1">Email</label>
                                                                <input value="{{ $item_c->email }}" name="Email"
                                                                    type="text" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="form-label text-sm text-muted mb-1">Date
                                                                    d'inscription</label>
                                                                <input
                                                                    value="{{ \Carbon\Carbon::parse($item_c->created_at)->format('d/m/Y H:i') }}"
                                                                    name="date" type="text" class="form-control"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="card border h-100">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0">Rôle et permissions</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="form-label text-sm text-muted mb-1">Poste
                                                                    actuel</label>
                                                                <div class="input-group input-group-outline">
                                                                    <select name="poste"
                                                                        class="form-control border-start-0"
                                                                        id="posteSelect" required>
                                                                        <option value="Agent de saisir"
                                                                            {{ $item_c->poste == 'Agent de saisir' ? 'selected' : '' }}>
                                                                            Agent de saisir</option>
                                                                        <option value="Vérificateur"
                                                                            {{ $item_c->poste == 'Vérificateur' ? 'selected' : '' }}>
                                                                            Vérificateur</option>
                                                                        <option value="Chef division"
                                                                            {{ $item_c->poste == 'Chef division' ? 'selected' : '' }}>
                                                                            Chef division</option>
                                                                        <option value="Chef service"
                                                                            {{ $item_c->poste == 'Chef service' ? 'selected' : '' }}>
                                                                            Chef service</option>
                                                                        <option value="Directeur"
                                                                            {{ $item_c->poste == 'Directeur' ? 'selected' : '' }}>
                                                                            Directeur</option>
                                                                        <option value="Client"
                                                                            {{ $item_c->poste == 'Client' ? 'selected' : '' }}>
                                                                            Client</option>
                                                                        <option value="ADMIN"
                                                                            {{ $item_c->poste == 'ADMIN' ? 'selected' : '' }}>
                                                                            Administrateur</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-3">
                                                            <div
                                                                class="alert alert-info bg-info bg-opacity-10 border border-info">
                                                                <div class="d-flex align-items-center">
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="text-info me-2">
                                                                        <path
                                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                    <small>Le changement de rôle affecte les permissions
                                                                        d'accès de l'utilisateur.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informations de statut -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="card border">
                                                <div
                                                    class="card-header bg-light d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Statut de l'utilisateur</h6>
                                                    @php
                                                        $statusClass = match ($item_c->status) {
                                                            'actif' => 'bg-success',
                                                            'inactif' => 'bg-danger',
                                                            'suspendu' => 'bg-warning',
                                                            default => 'bg-secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $statusClass }}">
                                                        {{ ucfirst($item_c->status ?? 'actif') }}
                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="form-label text-sm text-muted mb-1">Statut
                                                                    du compte</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="actif"
                                                                        {{ ($item_c->status ?? 'actif') == 'actif' ? 'selected' : '' }}>
                                                                        Actif</option>
                                                                    <option value="inactif"
                                                                        {{ ($item_c->status ?? 'actif') == 'inactif' ? 'selected' : '' }}>
                                                                        Inactif</option>
                                                                    <option value="suspendu"
                                                                        {{ ($item_c->status ?? 'actif') == 'suspendu' ? 'selected' : '' }}>
                                                                        Suspendu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""
                                                                    class="form-label text-sm text-muted mb-1">Dernière
                                                                    connexion</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $item_c->last_login_at ? \Carbon\Carbon::parse($item_c->last_login_at)->format('d/m/Y H:i') : 'Jamais' }}"
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description des rôles -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="card border">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0">Description des rôles</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-sm text-muted">Rôle</th>
                                                                    <th class="text-sm text-muted">Description</th>
                                                                    <th class="text-sm text-muted">Permissions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><span class="badge bg-primary">Agent de
                                                                            saisir</span></td>
                                                                    <td class="text-sm">Saisie initiale des demandes
                                                                    </td>
                                                                    <td class="text-sm">Création, consultation</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="badge bg-info">Vérificateur</span>
                                                                    </td>
                                                                    <td class="text-sm">Vérification des données</td>
                                                                    <td class="text-sm">Validation, rejet</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="badge bg-warning">Chef
                                                                            division</span></td>
                                                                    <td class="text-sm">Supervision des vérificateurs
                                                                    </td>
                                                                    <td class="text-sm">Approbation, gestion</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="badge bg-danger">Chef
                                                                            service</span></td>
                                                                    <td class="text-sm">Gestion des divisions</td>
                                                                    <td class="text-sm">Supervision, rapports</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="badge bg-success">Directeur</span>
                                                                    </td>
                                                                    <td class="text-sm">Décision finale</td>
                                                                    <td class="text-sm">Décision, archives</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="badge bg-secondary">Client</span>
                                                                    </td>
                                                                    <td class="text-sm">Consultation des demandes</td>
                                                                    <td class="text-sm">Lecture seule</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span class="badge bg-dark">ADMIN</span></td>
                                                                    <td class="text-sm">Administration complète</td>
                                                                    <td class="text-sm">Toutes permissions</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card border">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <a href="{{ url()->previous() }}"
                                                                class="btn btn-outline-secondary">
                                                                <svg width="16" height="16"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    class="me-2">
                                                                    <path d="M19 12H5M12 19l-7-7 7-7" />
                                                                </svg>
                                                                Annuler
                                                            </a>
                                                        </div>
                                                        <div class="d-flex gap-2">

                                                            <button type="submit" class="btn btn-primary">
                                                                <svg width="16" height="16"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    class="me-2">
                                                                    <path
                                                                        d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                                                                    <polyline points="17 21 17 13 7 13 7 21" />
                                                                    <polyline points="7 3 7 8 15 8" />
                                                                </svg>
                                                                Enregistrer les modifications
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
