@extends('layout.pdf.header')

@section('content')
    <h1>Récépissé</h1>
    <div class="d-flex justify-content-end mb-4">
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th>N° Dossier</th>
                    <th>Date</th>
                    <th>Montant (Devise)</th>
                    <th>Montant (FCFA)</th>

                    @if ($nom_client)
                        <th>Nom du client</th>
                        <th>Prénom du client</th>
                    @endif

                    @if ($nomsociete)
                        <th>Nom société</th>
                        <th>Catégorie</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $numero_doss }}</td>
                    <td>{{ $date }}</td>
                    <td>{{ $montant}} ({{ $devise }})</td>
                    <td>{{ $montant_con }} (FCFA)</td>

                    @if ($nom_client)
                        <td>{{ $nom_client }}</td>
                        <td>{{ $prenom_client }}</td>
                    @endif
                    @if ($nomsociete)
                        <td>{{ $nomsociete }}</td>
                        <td>{{ $categorie ?? 'N/A' }}</td> <!-- Utilise la valeur par défaut si 'categorie' est manquant -->
                    @endif
                </tr>
            </tbody>
        </table>
        @php
            $dateOrigine = new DateTime($date);
            // Ajoute 2 jours
            $dateModifiee = $dateOrigine->modify('+2 days');
            $ladate = $dateModifiee->format('d-m-Y');
        @endphp
        <h3>Votre demande sera prête au plus tard le {{ $ladate }}</h3>
    </div>
    <hr>
    <h1>Informations de connexion</h1>
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
                    <td>{{ $email }}</td>
                    <td>{{ $password }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

{{-- @extends('layout.pdf.header')

@section('content')
<h1>{{$email}}</h1>
@endsection
 --}}