@extends('layout.secretaire.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} <span
                        class="badge rounded-pill badge-notification bg-danger"
                        style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
            @endforeach
        </h1>
        @foreach ($demande as $item)

        <h1>Detailles de la demande {{ $item['numero_doss'] }} </h1>
        @endforeach

        <div class="table-responsive">
            <style>
                .table-responsive {
    overflow-x: auto;
    max-width: 100%;
}

            </style>
            <table class="table">
            <thead>
                <tr>
                    <th>N° Dossier</th>
                    <th>Date d'enregistrement</th>
                    <th>Nature des produits</th>
                    <th>Nature des opérations</th>
                    <th>Montant (Devise)</th>
                    <th>Contre montant (FCFA)</th>
                    <th>Nom du client</th>
                    <th>Pieces jointes</th>
                    <th>Prénom du client</th>
                    <th>Profession du client</th>
                    <th>Téléphone du client</th>
                    <th>Banque du client</th>
                    <th>Numéro de compte du client</th>
                    <th>Statut de la demande</th>
        {{--             <th>Motif</th>
                    <th>Vu par le vérificateur</th>
                    <th>Vu par le chef division</th>
                    <th>Date de décision</th>
                    <th>Vu par le chef bureau</th>
                    <th>Vu par le DAMF</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($demande as $item)
                    <tr>
                        <td>{{ $item['numero_doss'] }}</td>
                        <td>{{ $item['date'] }}</td>
                        <td>{{ $item['nature_p'] }}</td>
                        <td>{{ $item['nature_op'] }}</td>
                        <td>{{ $item['montant'] }} {{ $item['devise'] }}</td>
                        <td>{{ $item['montant_con'] }}</td>
                        <td>{{ $item['nom_client'] }}</td>
                        <td>
                            @if ($piece)
                                {{ $piece }}
                            @else
                                Il n'y a pas de pièces jointes
                            @endif
                        </td>
                        <td>{{ $item['prenom_client'] }}</td>
                        <td>{{ $item['profess_client'] }}</td>
                        <td>{{ $item['tel_client'] }}</td>
                        <td>{{ $item['banque_client'] }}</td>
                        <td>{{ $item['num_compt_client'] }}</td>
                        @php
                            $status_dmd=" ";
                            if ($item['vu_verifi']==0) &&($item['vu_chef_division']==0) && ($item['vu_chef_bureau']==0) && ($item['vu_damf']==0){
                                
                            }
                        @endphp
                        <td>{{ $item['status_dmd'] }}</td>
                        <td>
                            @if ($item['status_dmd'] == 'Suspendre' || $item['status_dmd'] == 'Rejetée')
                                {{ $item['motif'] }}
                            @endif
                        </td>

                        <td>
                            @if ($item['vu_verifi'] ==0 )
                              {{  }}
                            @endif
                        </td>
                        <td>{{ $item['vu_verifi'] != 0 ? 'Vu par le vérificateur' : 'Non vu par le vérificateur' }}</td>
                        <td>{{ $item['vu_chef_division'] != 0 ? 'Vu par le chef division' : 'Non vu par le chef division' }}</td>
                        <td>{{ $item['date_decision'] }}</td>
                        <td>{{ $item['vu_chef_bureau'] != 0 ? 'Vu par le chef bureau' : 'Non vu par le chef bureau' }}</td>
                        <td>{{ $item['vu_damf'] != 0 ? 'Vu par le DAMF' : 'Non vu par le DAMF' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        






        @foreach ($user as $item)
            <a style="width: auto; height:fit-content;" href="{{ url('HSecretaire') }}"
                class="btn btn-primary">Statistique</a>
        @endforeach
    </div>


    <br>
    <br>
@endsection
