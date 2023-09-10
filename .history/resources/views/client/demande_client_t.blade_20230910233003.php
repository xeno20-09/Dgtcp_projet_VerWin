@extends('layout.client.header')
@section('content')
<h1 style="text-align: center;">
    @foreach ($user as $item)
    <a class="nav-link" href="#"> Mr/Mrs {{ $item->name}} </a>
    @endforeach
</h1>
<div class="container">
@foreach ($demande as $item)
@if (($item['status_dmd']=='Autorisée'))
<a class="btn btn-primary" href="{{ URL::to('/demande/pdf', ['id' => $item->numero_doss]) }}">Export demande to PDF</a>     
    @else
@endif

    <h1>Liste de demandes </h1>


    <h3 class="card-header">N°Dossier :{{ $item->numero_doss }}</h3>
    <div style="max-width: fit-content;" class="card mb-3 d-flex flex-row">
        <ul class="list-group list-group-flush flex-column gap-3">
            <li class="list-group-item">Date d'enregistrement: {{ $item->date }}</li>
            <li class="list-group-item">Nature des produits: {{ $item->nature_p }}</li>
            <li class="list-group-item">Nature des opérations: {{ $item-> nature_op }}</li>
            <li class="list-group-item">Montant en  {{ $item-> devise }} : {{ $item-> montant }}</li>
            <li class="list-group-item">Contre montant en FCFA: {{ $item-> montant_con }}</li>
            <li class="list-group-item">Nom du client: {{ $item-> nom_client }}</li>
            <li class="list-group-item">Prénom du client: {{ $item-> prenom_client }}</li>
            <li class="list-group-item">Banque du client: {{ $item-> banque_client }}</li>
            <li class="list-group-item">Numéro de compte du client: {{ $item-> num_compt_client }}</li>
            <li class="list-group-item">Nom du beneficiaire: {{ $item['nom_benefi'] }}</li>
            <li class="list-group-item">Prenom du beneficiaire: {{ $item['prenom_benefi'] }}</li>
            <li class="list-group-item">Banque du beneficiaire: {{ $item['banque_benefi'] }}</li>
            <li class="list-group-item">Numero de compte du beneficiaire: {{ $item['num_compt_benefi'] }}</li>
            <li class="list-group-item">Statut de la demande: {{ $item['status_dmd'] }}</li>
            @if ($item['status_dmd']!='Autorisée')
            <li class="list-group-item">Motif de la demande: {{ $item['motif'] }}</li>
                @else
<li class="list-group-item"></li>
            @endif
        </ul>

        @endforeach

    </div>
    @foreach ($user as $item)
  <a style="width: auto; height:fit-content;" href="{{ url('Client')}}" class="btn btn-primary">Home</a>
  @endforeach
</div>

@endsection