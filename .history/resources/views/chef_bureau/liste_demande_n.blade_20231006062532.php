@extends('layout.chef_bureau.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs  {{ $item['firstname'] }} {{ $item['lastname'] }}   <span class="badge rounded-pill badge-notification bg-danger"
                    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
            @endforeach
        </h1>
        <h1>Liste des demandes </h1>
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Date de depot:</th>
                    <th scope="col">Nature produit:</th>
                    <th scope="col">Nature opération:</th>
                    <th scope="col">Montant:</th>
                    <th scope="col">Devise:</th>
                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Nom Secretaire:</th>
                    <th scope="col">Nom Verificateur:</th>
                    <th scope="col">Nom Chef Division:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demande as $item)
                    <tr class="table-warning">
                        <td>{{ $item['numero_doss'] }}</td>
                        <td>{{ $item['date'] }}</td>
                        <td>{{ $item['nature_p'] }}</td>
                        <td>{{ $item['nature_op'] }}</td>
                        <td> {{ $item['montant'] }}</td>
                        <td>{{ $item['devise'] }}</td>
                        <td>{{ $item['montant_con'] }}</td>
                        @foreach ($jointure as $itemc)
                        <td> {{ $itemc->firstname }} {{ $itemc->lastname}} </td>                       @break
                @endforeach
                @foreach ($jointure1 as $itemd)
                    <td> {{ $itemd->firstname }} {{ $itemd->lastname}} </td>                   @break
            @endforeach
            @foreach ($jointure1 as $itemd)
            <td> {{ $itemd->firstname }} {{ $itemd->lastname}} </td>                   @break
    @endforeach
            <td>
                <a style="width: auto; height:fit-content;"
                    href="{{ route('voir_demand', ['id' => $item->id]) }}" class="btn btn-primary">Voir</a>
            </td>
    @endforeach
    </tr>
</tbody>
</table>
</div>
<br>
<br>
@endsection
