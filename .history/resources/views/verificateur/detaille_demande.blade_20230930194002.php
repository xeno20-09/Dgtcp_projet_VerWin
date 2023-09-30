@extends('layout.verificateur.header')
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

        <h1>Detaille de la demande {{ $item->numero_doss }} </h1>
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
                        <th>Montant (Devise)</th>
                        <th>Contre montant</th>
                        <th>Nom du client</th>
                        <th>Prénom du client</th>
                        <th>Téléphone du client</th>
                        <th>Banque du client</th>
                        <th>Numéro de compte du client</th>
                        <th>Pieces joint</th>
                        @if ($piece->montantligne!=0)
    
                        <th>References pieces:</th>
                        <th>Montant initial:</th>
                        <th>Montant ligne:</th>
                        <th>Montant restant:</th>
@endif

                        <th>Nom du beneficiaire</th>
                        <th>Prenom du beneficiaire</th>
                        <th>Banque du beneficiaire</th>
                        <th>Pays du beneficiaire</th>
                        <th>Numéro de compte du beneficiaire</th>
                        <th>Position de la demande</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($demande as $item)
                        <tr>
                            <td>{{ $item->numero_doss }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->nature_p }}</td>
                            <td>{{ $item->nature_op }}</td>
                            <td>{{ $item->montant }}({{ $item->devise }})</td>
                            <td>{{ $item->montant_con }}(FCFA)</td>
                            <td>{{ $item->nom_client }}</td>
                            <td>{{ $item->prenom_client }}</td>
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
    
                            <th>{{ $piece->referencespiece}}</th>
                            <th>Montant initial:</th>
                            <th>$piece->montantligne</th>
                            <th>Montant restant:</th>
    @endif
                            <td>{{ $item->nom_benefi }}</td>
                            <td>{{ $item->prenom_benefi }}</td>
                            <td>{{ $item->banque_benefi }}</td>
                            <td>{{ $item->pays_benifi }}</td>
                            <td>{{ $item->num_compt_benefi }}</td>
                         
                
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
        </ul>
    </div>






<div class="test" style="display: flex;
flex-direction: row;
justify-content: space-between;">
    @foreach ($user as $item)
        <a style="width: auto; height:fit-content;" href="{{ url('HVerificateur') }}"
            class="btn btn-primary">Statistique</a>
    @endforeach
    <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

</div>

    </div>


    <br>
    <br>
@endsection
