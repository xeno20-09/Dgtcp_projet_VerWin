@extends('layout.damf.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }}  <span class="badge rounded-pill badge-notification bg-danger"
                    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
            @endforeach
        </h1>
        @foreach ($demande as $item)

        <h1>Detailles de la demande {{ $item->numero_doss  }} </h1>
        @endforeach
        <div class="table-responsive">
            <style>
                .table-responsive {
    overflow-x: auto;
    max-width: 100%;
}

            </style>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>N°Dossier</th>
                    <th>Date d'enregistrement</th>
                    <th>Nature des produits</th>
                    <th>Nature des opérations</th>
                    <th>Montant en FCFA</th>
                    <th>Contre montant</th>
                    <th>Devise</th>
                    <th>Nom du client</th>
                    <th>Prénom du client</th>
                    <th>Profession du client</th>
                    <th>Téléphone du client</th>
                    <th>Banque du client</th>
                    <th>Numéro de compte du client</th>
                    <th>Pieces jointes</th>
                    @if ($piece->montantligne!=0)
    
                    <th>References pieces:</th>
                    <th>Montant initial:</th>
                    <th>Montant ligne:</th>
                    <th>Montant restant:</th>
@endif
                    <th>Nom du bénéficiaire</th>
                    <th>Prénom du bénéficiaire</th>
                    <th>Banque du bénéficiaire</th>
                    <th>Pays du bénéficiaire</th>
                    <th>Numéro de compte du bénéficiaire</th>
                    <th>Position de la demande</th>
                 {{--    <th>Vu par le DAMF</th>
                    <th>Nom du Secrétaire</th>
                    <th>Nom du Vérificateur</th>
                    <th>Nom du Chef Division</th>
                    <th>Nom du Chef Bureau</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($demande as $item)
                    <tr>
                        <td>{{ $item->numero_doss }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->nature_p }}</td>
                        <td>{{ $item->nature_op }}</td>
                        <td>{{ $item->montant }}</td>
                        <td>{{ $item->montant_con }}</td>
                        <td>{{ $item->devise }}</td>
                        <td>{{ $item->nom_client }}</td>
                        <td>{{ $item->prenom_client }}</td>
                        <td>{{ $item->profess_client }}</td>
                        <td>{{ $item->tel_client }}</td>
                        <td>{{ $item->banque_client }}</td>
                        <td>{{ $item->num_compt_client }}</td>
                        <td>
                            @if ($pieces)
                                {{ $pieces }}
                            @else
                                Il n'y a pas de pièces jointes
                            @endif
                        </td>

                        @if ($piece->montantligne!=0)

                        <td>{{ $piece->referencespiece}}</td>
                        <td>{{$piece->montantinitial}}</td>
                        <td>{{$piece->montantligne}}</td>
                        <td>{{$piece->montantrestant}}</td>
@endif
         
                        
                        <td>{{ $item['nom_benefi'] }}</td>
                        <td>{{ $item['prenom_benefi'] }}</td>
                        <td>{{ $item['banque_benefi'] }}</td>
                        <td>{{ $item['pays_benifi'] }}</td>
                        <td>{{ $item['num_compt_benefi'] }}</td>
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
                      {{--   <td>{{ $item['status_dmd'] }}</td>
                        <td>
                            @if ($item['vu_damf'] != 0)
                                Vu par le DAMF
                            @else
                                Non vu par le DAMF
                            @endif
                        </td>
                        <td>
                            @foreach ($jointure as $row)
                                {{ $row->name }}
                                @break
                            @endforeach
                        </td>
                        <td>
                            @foreach ($jointure1 as $row1)
                                {{ $row1->name }}
                                @break
                            @endforeach
                        </td>
                        <td>
                            @foreach ($jointure2 as $row2)
                                {{ $row2->name }}
                                @break
                            @endforeach
                        </td>
                        <td>
                            @foreach ($jointure3 as $row3)
                                {{ $row3->name }}
                                @break
                            @endforeach
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>




@foreach ($user as $item)
<a style="width: auto; height:fit-content;" href="{{ url('HDamf') }}" class="btn btn-primary">Statistique</a>
@endforeach

<div class="test" style="display: flex;
flex-direction: row;
justify-content: space-between;">
    @foreach ($user as $item)
    <a style="width: auto; height:fit-content;" href="{{ url('HChef_bureau') }}"
    class="btn btn-primary">Statistique</a>
    @endforeach
    <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

</div>
</div>


<br>
<br>
@endsection
