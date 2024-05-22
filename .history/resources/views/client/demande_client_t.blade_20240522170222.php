@extends('layout.client.header')
@section('content')
<h1 style="text-align: center;">
    @foreach ($user as $item)
    <a class="nav-link" href="#"> Mr/Mrs {{ $item->firstname }} {{ $item->lastname }} </a>
    @endforeach
</h1>
<div class="container">
    @if ($pic == 1)
    <div class="table-responsive">
        <style>
            .table-responsive {
                overflow-x: auto;
                max-width: 100%;
            }
        </style>
        <table class="table-bordered">
            <thead>
                <tr>
                <tr>
                    <th>N°Dossier</th>
                    <th>Date d'enregistrement</th>
                    <th>Nature des produits</th>
                    <th>Nature des opérations</th>
                    <th>Montant en Devise</th>
                    <th>Contre montant en FCFA</th>

                    @foreach ($demande as $item)
                    @if ($item['type_prs'] != 'morale')
                    <th>Nom du demandeur</th>
                    <th>Prénom du demandeur</th>
                    <th>Banque du demandeur</th>
                    <th>Numéro de compte du demandeur</th>
                    @else
                    <th>Nom de la société</th>
                    <th>Banque de la société</th>
                    <th>Numéro de compte de la société</th>
                    @endif

                    @endforeach
                    <th>Nom du bénéficiaire</th>
                    <th>Prénom du bénéficiaire</th>
                    <th>Banque du bénéficiaire</th>
                    <th>Numéro de compte du bénéficiaire</th>
                    @foreach ($demande as $item)
                    @if ($item['status_dmd_cb'] != 'Autorisée')
                    <th>Motif de la demande</th>
                    <th>Position de la demande</th>
                    @else
                    <th>Position de la demande</th>

                    @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($demande as $item)
                <tr>
                    <td>{{ $item->numero_doss }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->nature_p }}</td>
                    <td>{{ $item->nature_op }}</td>
                    <td>{{ $item->devise }} {{ $item->montant }}</td>
                    <td>{{ $item->montant_con }}</td>
                    
                    @foreach ($demande as $item)
                    @if ($item['type_prs'] != 'morale')
                    <td>{{ $item->nom_client }}</td>
                    <td>{{ $item->prenom_client }}</td>
                    <td>{{ $item->banque_client }}</td>
                    <td>{{ $item->num_compt_client }}</td>
                    @else
                    <td>{{ $item->nomsociete }}</td>
                    <td>{{ $item->banque_client }}</td>
                    <td>{{ $item->num_compt_client }}</td>
                    @endif

                    @endforeach
             
                    <td>{{ $item['nom_benefi'] }}</td>
                    <td>{{ $item['prenom_benefi'] }}</td>
                    <td>{{ $item['banque_benefi'] }}</td>
                    <td>{{ $item['num_compt_benefi'] }}</td>

                    @php
                    if ($item['vu_secret'] == 1 && $item['vu_verifi'] == 0 && $item['vu_chef_division'] == 0 &&
                    $item['vu_chef_bureau'] == 0 && $item['vu_damf'] == 0) {
                    $position = 'Vérificateur';
                    echo "<td>$position</td>";
                    }
                    if ($item['vu_secret'] == 1 && $item['vu_verifi'] == 1 && $item['vu_chef_division'] == 0 &&
                    $item['vu_chef_bureau'] == 0 && $item['vu_damf'] == 0) {
                    $position = 'Chef division';
                    echo "<td>$position</td>";
                    }
                    if ($item['vu_secret'] == 1 && $item['vu_verifi'] == 1 && $item['vu_chef_division'] == 1 &&
                    $item['vu_chef_bureau'] == 0 && $item['vu_damf'] == 0) {
                    $position = 'Chef service';
                    echo "<td>$position</td>";
                    }
                    if ($item['vu_secret'] == 1 && $item['vu_verifi'] == 1 && $item['vu_chef_division'] == 1 &&
                    $item['vu_chef_bureau'] == 1 && $item['vu_damf'] == 0) {
                    $position = 'Directeur';
                    echo "<td>$position</td>";
                    }
                    if ($item['vu_secret'] == 1 && $item['vu_verifi'] == 1 && $item['vu_chef_division'] == 1 &&
                    $item['vu_chef_bureau'] == 1 && $item['vu_damf'] == 1) {
                    echo "<td>{$item['status_dmd_cb']}</td>";
                    }
                    @endphp
                    <td>
                        @if ($item['status_dmd_cb'] != 'Autorisée')
                        {{ $item['motif'] }}
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @foreach ($demande as $item)
        <a class="btn btn-primary" href="{{ URL::to('/demande/pdf', ['id' => $item->numero_doss]) }}">Export
            demande to PDF</a>
        @endforeach
        @else
        Votre demande n'est pas prete , revenez plus tard
        @endif

    </div>
    <br><br>
    <div class="test" style="display: flex;
flex-direction: row;
justify-content: space-between;">
        @foreach ($user as $item)
        <a style="width: auto; height:fit-content;" href="{{ url('Client') }}" class="btn btn-primary">Home</a>
        @endforeach

    </div>
</div>

@endsection