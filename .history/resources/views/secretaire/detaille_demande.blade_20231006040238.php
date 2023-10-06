@extends('layout.secretaire.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} <span
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
            <table class="table-bordered">
            <thead>
                <tr>
                    <th>N° Dossier</th>
                    <th>Date d'enregistrement</th>
                    <th>Nature des produits</th>
                    <th>Nature des opérations</th>
                    <th>Montant (Devise)</th>
                    <th>Contre montant (FCFA)</th>
                    @foreach ($demande as $item)
                    @if ($item->nom_client)
                    <th>Nom du client</th>
                    <th>Prénom du client</th>
                    <th>Profession du client</th>
                    <th>Téléphone du client</th>
                    <th>Banque du client</th>
                    <th>Numéro de compte du client</th>
                    @endif
                    @endforeach
                    @foreach ($demande as $item)
                    @if ($item->nomsociete)
                    <th>Nom societé</th>
                    <th>Categorie</th>
                    <th>Adresse</th>
                    <th>Banque du client</th>
                    <th>Numéro de compte du client</th>
                    @endif
                    @endforeach
                    <th>Pieces jointes</th>
                    @if ($pieces)
    
                    <th>References pieces:</th>
                    <th>Montant initial:</th>
                    <th>Montant ligne:</th>
                    <th>Montant restant:</th>
                    
@endif

                    <th>Position de la demande</th>
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
                        <td>{{ $item['montant'] }} ({{ $item['devise'] }})</td>
                        <td>{{ $item['montant_con'] }}(FCFA)</td>
                        @if ($item->nom_client)
                        <td>{{ $item['nom_client'] }}</td>
                        <td>{{ $item['prenom_client'] }}</td>
                        <td>{{ $item['profess_client'] }}</td>
                        <td>{{ $item['tel_client'] }}</td>
                        <td>{{ $item['banque_client'] }}</td>
                        <td>{{ $item['num_compt_client'] }}</td>
                        @endif
                        @if ($item->nomsociete)
                        <td>{{ $item[''] }}</td>
                        <td>{{ $item['nomsociete'] }}</td>
                        <td>{{ $item['adresse'] }}</td>

                        <td>{{ $item['tel_client'] }}</td>
                        <td>{{ $item['banque_client'] }}</td>
                        <td>{{ $item['num_compt_client'] }}</td>
@endif
                        <td>
                            @if ($pieces)
                                {{ $pieces->libellepiece }}
                            @else
                                Il n'y a pas de pièces jointes
                            @endif
                        </td>

                        @if ($pieces)

                        <td>{{ $pieces->referencespiece}}</td>
                        <td>{{$pieces->montantinitial}}</td>
                        <td>{{$pieces->montantligne}}</td>
                        <td>{{$pieces->montantrestant}}</td>
@endif
                     
                        @php
                        $status_dmd = " ";
                        if (
                            ($item['vu_secret'] == 1) &&
                            ($item['vu_verifi'] == 0) &&
                            ($item['vu_chef_division'] == 0) &&
                            ($item['vu_chef_bureau'] == 0) &&
                            ($item['vu_damf'] == 0)
                        ) {
                            $position = "Vérificateur";
                            echo "<td>$position</td>";
                        }
                        if (
                            ($item['vu_secret'] == 1) &&
                            ($item['vu_verifi'] == 1) &&
                            ($item['vu_chef_division'] == 0) &&
                            ($item['vu_chef_bureau'] == 0) &&
                            ($item['vu_damf'] == 0)
                        ) {
                            $position = "Chef division";
                            echo "<td>$position</td>";
                        }
                        if (
                            ($item['vu_secret'] == 1) &&
                            ($item['vu_verifi'] == 1) &&
                            ($item['vu_chef_division'] == 1) &&
                            ($item['vu_chef_bureau'] == 0) &&
                            ($item['vu_damf'] == 0)
                        ) {
                            $position = "Chef service";
                            echo "<td>$position</td>";
                        }
                        if (
                            ($item['vu_secret'] == 1) &&
                            ($item['vu_verifi'] == 1) &&
                            ($item['vu_chef_division'] == 1) &&
                            ($item['vu_chef_bureau'] == 1) &&
                            ($item['vu_damf'] == 0)
                        ) {
                            $position = "Directeur";
                            echo "<td>$position</td>";
                        }
                        if (
                            ($item['vu_secret'] == 1) &&
                            ($item['vu_verifi'] == 1) &&
                            ($item['vu_chef_division'] == 1) &&
                            ($item['vu_chef_bureau'] == 1) &&
                            ($item['vu_damf'] == 1)
                        ) {
                            echo "<td>{$item['status_dmd']}</td>";
                        }
                        @endphp
                        
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
        






    </div>


<br><br>
        <div class="test" style="display: flex;
flex-direction: row;
justify-content: space-between;">

@foreach ($user as $item)
<a style="width: auto; height:fit-content;" href="{{ url('HSecretaire') }}"
    class="btn btn-primary">Statistique</a>
@endforeach
    <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

</div>
    <br>
    <br>
@endsection
