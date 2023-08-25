@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        <h1>Liste des pieces </h1>
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Date de depot:</th>
                    <th scope="col">Nom demandeur:</th>
                    <th scope="col">Nom beneficiere:</th>
                    <th scope="col">Nom verificateur:</th>
                    <th scope="col">Libellé pieces:</th>
                    <th scope="col">References pieces:</th>
                    <th scope="col">Montant initial:</th>
                    <th scope="col">Montant ligne:</th>
                    <th scope="col">Montant restant:</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($demande as $item)
                    <tr class="table-warning">
                        <td>{{ $item['numero_doss'] }}</td>
                        <td>{{ $item['date_piece'] }}</td>

                        <td>{{ $item['nom_d '] }}</td>
                        <td>{{ $item['nom_b '] }}</td>
                        <td>{{ $item['nom_v'] }}</td>
                        <td>{{ $item['libellepiece'] }}</td>
                        <td> {{ $item['referencespiece'] }}</td>
                        <td> {{ $item['montantinitial'] }}</td>
                        <td>{{ $item['	montantligne'] }}</td>
                        <td>{{ $item['montantrestant '] }}</td>


                        {{--                     <td>
                        <a style="width: auto; height:fit-content;"
                           href="{{ route('voir_demande', ['id' => $item->id]) }}" class="btn btn-primary">Voir</a>
                   </td> --}}
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
@endsection
