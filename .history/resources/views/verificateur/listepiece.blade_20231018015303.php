@extends('layout.verificateur.header')

@section('content')
<div class="container">
    <h1 style="text-align: center;">
        @foreach ($user as $item)
        <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} <span
            class="badge rounded-pill badge-notification bg-danger"
            style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
        @endforeach
    </h1>
    <h1>Liste des pièces</h1>
    @php
    $currentDmdId = null;
@endphp
    <table class="table">
        <thead>
            <tr>
                <th scope="col">N°Dossier:</th>
                <th scope="col">Date de dépôt:</th>
                <th scope="col">Nom demandeur:</th>
              
                <th scope="col">Libellé pièces:</th>
                <th scope="col">Références pièces:</th>
                <th scope="col">Montant initial:</th>
                <th scope="col">Montant ligne:</th>
                <th scope="col">Montant restant:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pieces as $item)
            @if ($currentDmdId !== $item['id_dmd'])
                @php
                    $currentDmdId = $item['id_dmd'];
                @endphp
                <tr class="table-info">
                    <td colspan="10" style="text-align: center;">
                        Demande N° {{ $item['numero_doss'] }}
                    </td>
                </tr>
            @endif
            @if ($item['montantrestant'] < 0)
            <tr class="table-danger">
                <td>{{ $item['numero_doss'] }}</td>
                <td>{{ $item['date'] }}</td>
                
                <td>{{ $item['nom_v'] }}</td>
                <td>{{ $item['libellepiece'] }}</td>
                <td>{{ $item['referencespiece'] }}</td>
                <td>{{ $item['montantinitial'] }}</td>
                <td>{{ $item['montantligne'] }}</td>
                <td>{{ $item['montantrestant'] }}</td>
            </tr>
            @else
            <tr class="table-warning">
                <td>{{ $item['numero_doss'] }}</td>
                <td>{{ $item['date'] }}</td>
               
                <td>{{ $item['nom_v'] }}</td>
                <td>{{ $item['libellepiece'] }}</td>
                <td>{{ $item['referencespiece'] }}</td>
                <td>{{ $item['montantinitial'] }}</td>
                <td>{{ $item['montantligne'] }}</td>
                <td>{{ $item['montantrestant'] }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
<br>
<br>
@endsection
