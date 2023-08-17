@extends('layout.secretaire.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        <h1>Liste des demandes </h1>
        @foreach ($demande as $item)
            <h3 class="card-header">N°Dossier :{{ $item['numero_doss'] }}</h3>
            <div style="max-width: fit-content;" class="card mb-3 d-flex flex-row">
                <ul class="list-group list-group-flush flex-column gap-3">
                    <li class="list-group-item">Date d'enregistrement: {{ $item['date'] }}</li>
                    <li class="list-group-item">Nature des produits: {{ $item['nature_p'] }}</li>
                    <li class="list-group-item">Nature des opérations: {{ $item['nature_op'] }}</li>
                    <li class="list-group-item">Montant en FCFA: {{ $item['montant'] }}</li>
                    <li class="list-group-item">Contre montant: {{ $item['montant_con'] }}</li>
                    <li class="list-group-item">Devise: {{ $item['devise'] }}</li>
                    <li class="list-group-item">Nom du client: {{ $item['nom_client'] }}</li>
                    @php
                        $i = $item['file'];
                        $items = json_decode($i, true);
                    @endphp

                    <li class="list-group-item">Pieces joint:
                        @foreach ($items as $file)
                            <a href="https://www.flaticon.com/free-icons/eye" title="eye icons">Eye icons created by Freepik
                                - Flaticon</a>
                            <a style="text-decoration: none ; display:block;text-align:center;"
                                href="{{ asset('files/' . $file) }}" target="_blank">{{ $file }}</a><br>
                        @endforeach

                    </li>


                    <li class="list-group-item">Prénom du client: {{ $item['prenom_client'] }}</li>
                    <li class="list-group-item">Profession du client: {{ $item['profess_client'] }}</li>
                    <li class="list-group-item">Téléphone du client: {{ $item['tel_client'] }}</li>
                    <li class="list-group-item">Banque du client: {{ $item['banque_client'] }}</li>
                    <li class="list-group-item">Numéro de compte du client: {{ $item['num_compt_client'] }}</li>
                    <li class="list-group-item">Statut de la demande: {{ $item['date_decision'] }}</li>
                    <li class="list-group-item">Statut de la demande: {{ $item['status_dmd'] }}</li>
                    @if ($item['status_dmd'] = 'Suspendu')
                        <li class="list-group-item">Motif de la suspension demande: {{ $item['motif'] }}</li>
                    @elseif ($item['status_dmd'] = 'Rejetée')
                        <li class="list-group-item">Motif du rejet demande: {{ $item['motif'] }}</li>
                    @endif
                    @if ($item['vu_verif'] != 0)
                        <li class="list-group-item">Vu par le vérificateur</li>
                    @else
                        <li class="list-group-item">Non vu par le vérificateur</li>
                    @endif
                </ul>
            </div>
        @endforeach






        @foreach ($user as $item)
            <a style="width: auto; height:fit-content;" href="{{ url('HSecretaire') }}"
                class="btn btn-primary">Statistique</a>
        @endforeach
    </div>


    <br>
    <br>
@endsection
