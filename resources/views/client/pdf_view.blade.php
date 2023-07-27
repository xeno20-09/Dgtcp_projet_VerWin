@extends('layout.pdf.header')
@section('content')
@foreach ($demande as $item)
<div style="max-width: fit-content;" class="card mb-3 d-flex flex-row">

<h3 class="card-header">N°Dossier :{{ $item->numero_doss }}</h3>
    <ul class="list-group list-group-flush flex-column gap-3">
        <li class="list-group-item">Date d'enregistrement: {{ $item->date }}</li>
        <li class="list-group-item">Nature des produits: {{ $item->nature_p }}</li>
        <li class="list-group-item">Nature des opérations: {{ $item-> nature_op }}</li>
        <li class="list-group-item">Montant en FCFA: {{ $item-> montant }}</li>
        <li class="list-group-item">Contre montant: {{ $item-> montant_con }}{{ $item-> devise }}</li>
        <li class="list-group-item">Nom du client: {{ $item-> nom_client }}</li>
        <li class="list-group-item">Prénom du client: {{ $item-> prenom_client }}</li>
        <li class="list-group-item">Profession du client: {{ $item-> profess_client }}</li>
        <li class="list-group-item">Téléphone du client: {{ $item-> tel_client }}</li>
        <li class="list-group-item">Banque du client: {{ $item-> banque_client }}</li>
        <li class="list-group-item">Numéro de compte du client: {{ $item-> num_compt_client }}</li>
        <li class="list-group-item">Nom du beneficiaire: {{ $item['nom_benefi'] }}</li>
        <li class="list-group-item">Prenom du beneficiaire: {{ $item['prenom_benefi'] }}</li>
        <li class="list-group-item">Banque du beneficiaire: {{ $item['banque_benefi'] }}</li>
        <li class="list-group-item">Pays du beneficiaire: {{ $item['pays_benefi'] }}</li>
        <li class="list-group-item">Numero de compte du beneficiaire: {{ $item['num_compt_benefi'] }}</li>
        <li class="list-group-item" style="background-color:#cc3f3f">Statut de la demande: {{ $item['status_dmd'] }}</li>
        <li class="list-group-item" style="background-color:#ccab3f">Motif: {{ $item['motif'] }}</li>

    </ul>

    @endforeach

</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
@endsection

<style>
    *{
list-style: none;
    }
    .card {
  background-color: #dee2e6;
  border: 1px solid #dee2e6;
  padding: 20px;
  display: flex;
  flex-direction: row;
  max-width: fit-content;
}

.card-header {
  font-size: 18px;
  font-weight: bold;
  background-color: #59cc3f;
  padding: 10px;
  margin-bottom: 10px;
}

.list-group-item {
  padding: 8px;
  border: none;
  background-color: transparent;
}



.list-group-item:last-child {
  margin-bottom: 0;
}

.list-group-item::before {
  color: #0d6efd;
  font-weight: bold;
  display: inline-block;
  width: 1em;
  margin-left: -1em;
}

ul.list-group-flush {
  list-style-type: none;
  padding-left: 0;
}

.gap-3 > li {
  margin-bottom: 15px;
}

</style>