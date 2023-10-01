@extends('layout.Admin.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
    {{--         @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }}  <span class="badge rounded-pill badge-notification bg-danger"
                    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
            @endforeach --}}
        </h1>
        @foreach ($demande as $item)

        <h1>Detaille de la demande {{ $item->numero_doss }} </h1>
        @endforeach
        @foreach ($demande as $item)
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
                    @if ($pieces)
    
                    <th>References pieces:</th>
                    <th>Montant initial:</th>
                    <th>Montant ligne:</th>
                    <th>Montant restant:</th>
                    @else
@endif
                    <th>Nom du bénéficiaire</th>
                    <th>Prénom du bénéficiaire</th>
                    <th>Banque du bénéficiaire</th>
                    <th>Pays du bénéficiaire</th>
                    <th>Numéro de compte du bénéficiaire</th>
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
                            @if ($item->pieces)
                                {{ $item->pieces }}
                            @else
                                Il n'y a pas de pièces jointes
                            @endif
                        </td>
                        <td>{{ $item->nom_benefi }}</td>
                        <td>{{ $item->prenom_benefi }}</td>
                        <td>{{ $item->banque_benefi }}</td>
                        <td>{{ $item->pays_benifi }}</td>
                        <td>{{ $item->num_compt_benefi }}</td>
                        <td>{{ $item->status_dmd }}</td>
                        <td>
                            @if ($item->vu_damf != 0)
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



<br><br>

<a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

</div>


<br>
<br>
@endsection
