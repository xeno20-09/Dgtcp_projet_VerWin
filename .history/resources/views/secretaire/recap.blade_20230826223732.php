@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        <table class="table">
            <thead>
                <!-- En-têtes des colonnes -->
            </thead>
            <tbody>
                @foreach ($demande as $itemd)
                    @php
                        $matchingPiece = null;
                        foreach ($piece as $itemp) {
                            if ($itemp->demande_id === $itemd->id) {
                                $matchingPiece = $itemp;
                                break;
                            }
                        }
                    @endphp
                    <tr class="table-success">
                        <!-- Contenu de chaque colonne -->
                        <td>{{ $itemd->numero_doss }}</td>
                        <td>{{ $itemd->nom_client }}</td>
                        <!-- ... Autres colonnes ... -->
                        <td>{{ $itemd->montant }}</td>
                        @if ($matchingPiece)
                            <td>{{ $matchingPiece->montantinitial }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                        <!-- ... Autres colonnes ... -->
                    </tr>
                @endforeach
            </tbody>
        </table>



    </div>
@endsection
