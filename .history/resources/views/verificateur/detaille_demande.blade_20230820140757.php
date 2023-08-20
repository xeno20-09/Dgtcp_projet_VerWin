@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        <h1>Liste des demandes </h1>
        @foreach ($demande as $item)
            <h3 class="card-header">N°Dossier :{{ $item->numero_doss }}</h3>
            <div style="max-width: fit-content;" class="card mb-3 d-flex flex-row">
                <ul class="list-group list-group-flush flex-column gap-3">
                    <li class="list-group-item">Date d'enregistrement: {{ $item->date }}</li>
                    <li class="list-group-item">Nature des produits: {{ $item->nature_p }}</li>
                    <li class="list-group-item">Nature des opérations: {{ $item->nature_op }}</li>
                    <li class="list-group-item">Montant en FCFA: {{ $item->montant }}</li>
                    <li class="list-group-item">Contre montant: {{ $item->montant_con }}</li>
                    <li class="list-group-item">Devise: {{ $item->devise }}</li>
                    <li class="list-group-item">Nom du client: {{ $item->nom_client }}</li>
                    <li class="list-group-item">Prénom du client: {{ $item->prenom_client }}</li>
                    <li class="list-group-item">Profession du client: {{ $item->profess_client }}</li>
                    <li class="list-group-item">Téléphone du client: {{ $item->tel_client }}</li>
                    <li class="list-group-item">Banque du client: {{ $item->banque_client }}</li>
                    <li class="list-group-item">Numéro de compte du client: {{ $item->num_compt_client }}</li>
                    @php
                        $i = $item['file'];
                        $items = json_decode($i, true);
                    @endphp

                    <li class="list-group-item">Pieces joint:
                        @php
                         if($items)   {
                                @foreach ($items as $file)
                            <a style=" color:black; text-decoration: none ; display:block;text-align:center;"
                                href="{{ asset('files/' . $file) }}" target="_blank">{{ $file }}<img
                                    style="height: 20px;
          width: 22px;" src="{{ asset('images/eye.png') }}"
                                    alt="Mon Image"></a><br>
                        @endforeach 
                         }
                        @endphp
                        
                   

                    </li>

                    <li class="list-group-item">Nom du beneficiaire: {{ $item['nom_benefi'] }}</li>
                    <li class="list-group-item">Prenom du beneficiaire: {{ $item['prenom_benefi'] }}</li>
                    <li class="list-group-item">Banque du beneficiaire: {{ $item['banque_benefi'] }}</li>
                    <li class="list-group-item">Pays du beneficiaire: {{ $item['pays_benifi'] }}</li>
                    <li class="list-group-item">Numero de compte du beneficiaire: {{ $item['num_compt_benefi'] }}</li>
                    <li class="list-group-item">Statut de la demande: {{ $item['status_dmd'] }}</li>
                    @if ($item['vu_chef_division'] != 0)
                        <li class="list-group-item">Vu par le chef division</li>
                    @else
                        <li class="list-group-item">Non vu par le chef division</li>
                    @endif
                    @foreach ($jointure as $row)
                        <li class="list-group-item">Nom du Secretaire:{{ $row->name }}</li>
                    @break
                @endforeach
            </ul>
        </div>
    @endforeach






    @foreach ($user as $item)
        <a style="width: auto; height:fit-content;" href="{{ url('HVerificateur') }}"
            class="btn btn-primary">Statistique</a>
    @endforeach
</div>


<br>
<br>
@endsection
