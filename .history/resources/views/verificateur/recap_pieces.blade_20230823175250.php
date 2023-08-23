@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
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
                    <th scope="col">Nom Client:</th>
                    <th scope="col">Montant:</th>
                    <th scope="col">Devise:</th>
                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Nom Secretaire:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demande as $item)
                    <tr class="table-warning">
                        <td>{{ $item['numero_doss'] }}</td>
                        <td>{{ $item['nom_d '] }}</td>
                        <td>{{ $item['nom_b '] }}</td>
                        <td>{{ $item['nom_v'] }}</td>
                        <td>{{ $item['libellepiece'] }}</td>
                        <td> {{ $item['montant'] }}</td>
                        <td>{{ $item['devise'] }}</td>
                        <td>{{ $item['montantrestant '] }}</td>
                        @foreach ($jointure as $itemc)
                            <td>{{ $itemc->name }}</td>
                        @break
                    @endforeach
            			 	 	referencespiece 	date_piece 	numero_doss 	montantligne 	montantinitial 		
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
