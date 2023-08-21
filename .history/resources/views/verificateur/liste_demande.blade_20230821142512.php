@extends('layout.verificateur.header')
@section('content')
<div class="container">
  <h1 style="text-align: center;">
    @foreach ($user as $item)
    <a class="nav-link" href="#"> Mr/Mrs {{ $item->name}} </a>
    @endforeach
  </h1>
  <h1>Liste des demandes </h1>

  <table class="table ">
    <thead>
      <tr>

        <th scope="col">N°Dossier:</th>
        <th scope="col">Nom du client:</th>
        <th scope="col">Prenom du client:</th>
        <th scope="col">Date:</th>
        <th scope="col">Nom Secretaire:</th>
        <th scope="col">Nom Beneficiere:</th>
        <th scope="col">Status:</th>

      </tr>
    </thead>
    <tbody>

      @foreach ($demande as $item)


      <tr class="table-success">

        <td> {{ $item->numero_doss }}</td>
        <td> {{ $item->nom_client }}</td>
        <td> {{ $item->prenom_client }}</td>
        <td> {{ $item['montant'] }}</td>
        <td>{{ $item['devise'] }}</td>
        <td>{{ $item['montant_con'] }}</td>
        <td> {{ $item->date }}</td>
        @foreach ($jointure as $itemc)
        <td> {{ $itemc->name }}</td>
        @break
        @endforeach

        <td>{{ $item->nom_benefi }}</td>
        <td>{{ $item->status_dmd }}</td>
        <td>
          <a style="width: auto; height:fit-content;" href="{{ route('detaille_demandes',  ['id' => $item->id]) }}" class="btn btn-primary">Voir</a>
        </td>




      </tr>
      @endforeach
    </tbody>
  </table>

</div>


<br>
<br>
@endsection