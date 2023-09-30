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
                        <th>Téléphone du client</th>
                        <th>Banque du client</th>
                        <th>Numéro de compte du client</th>
                        <th>Pieces joint</th>
                        <th>Nom du beneficiaire</th>
                        <th>Prenom du beneficiaire</th>
                        <th>Banque du beneficiaire</th>
                        <th>Pays du beneficiaire</th>
                        <th>Numéro de compte du beneficiaire</th>
                        <th>Statut de la demande</th>
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
                            <td>{{ $item->tel_client }}</td>
                            <td>{{ $item->banque_client }}</td>
                            <td>{{ $item->num_compt_client }}</td>
                            <td>{{ $pieces }}</td>
                            <td>{{ $item->nom_benefi }}</td>
                            <td>{{ $item->prenom_benefi }}</td>
                            <td>{{ $item->banque_benefi }}</td>
                            <td>{{ $item->pays_benifi }}</td>
                            <td>{{ $item->num_compt_benefi }}</td>
                            <td>{{ $item->status_dmd }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </ul>
    </div>







    @foreach ($user as $item)
        <a style="width: auto; height:fit-content;" href="{{ url('HVerificateur') }}"
            class="btn btn-primary">Statistique</a>
    @endforeach
    </div>


    <br>
    <br>
@endsection
