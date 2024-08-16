@extends('layout.secretaire.header')
{{-- <pre>{{ print_r($data, true) }}</pre>
 --}}
@section('content')
    <a
        href="{{ route('get_rec_ask', ['email' => $data['email'], 'password' => $data['password'], 'numero_doss' => $data['numero_doss']]) }}">
        <button>
            Télécharger le pdf
        </button>
    </a>
    <div class="container">

        <h1 class="mb-4">Récépissé</h1>
        <div class="d-flex justify-content-end mb-4">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-danger">
                        <th>N° Dossier</th>
                        <th>Date</th>
                        <th>Montant (Devise)</th>
                        <th>Montant (FCFA)</th>

                        @if ($data['nom_client'])
                            <th>Nom du client</th>
                            <th>Prénom du client</th>
                        @endif

                        @if ($data['nomsociete'])
                            <th>Nom société</th>
                            <th>Catégorie</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data['numero_doss'] }}</td>
                        <td>{{ $data['date'] }}</td>
                        <td>{{ $data['montant'] }} ({{ $data['devise'] }})</td>
                        <td>{{ $data['montant_con'] }} (FCFA)</td>

                        @if ($data['nom_client'])
                            <td>{{ $data['nom_client'] }}</td>
                            <td>{{ $data['prenom_client'] }}</td>
                        @endif
                        @if ($data['nomsociete'])
                            <td>{{ $data['nomsociete'] }}</td>
                            <td>{{ $data['categorie'] ?? 'N/A' }}</td>
                            <!-- Utilise la valeur par défaut si 'categorie' est manquant -->
                        @endif
                    </tr>
                </tbody>
            </table>
            @php
                $dateOrigine = new DateTime($data['date']);
                // Ajoute 2 jours
                $dateModifiee = $dateOrigine->modify('+2 days');
                $ladate = $dateModifiee->format('d-m-Y');
            @endphp
            <h3>Votre demande sera prête au plus tard le {{ $ladate }}</h3>
        </div>
        <hr>
        <h1 class="mb-4">Informations de connexion</h1>
        <div class="d-flex justify-content-end mb-4">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-danger">
                        <th>Email</th>
                        <th>Mot de passe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data['email'] }}</td>
                        <td>{{ $data['password'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
