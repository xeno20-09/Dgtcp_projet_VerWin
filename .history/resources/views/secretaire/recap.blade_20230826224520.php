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
                <tr>
                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Montant:</th>
                    <th scope="col">Montant Initial:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demande as $itemd)
                    @php
                        $matchingPieces = array_filter($piece, function($itemp) use ($itemd) {
                            return $itemp->numero_doss === $itemd->numero_doss;
                        });
                    @endphp
                    <tr>
                        <td rowspan="{{ count($matchingPieces) + 1 }}">{{ $itemd->numero_doss }}</td>
                        <td>{{ $itemd->montant }}</td>
                        <td>{{ $itemd->montantinitial }}</td>
                    </tr>
                    @foreach ($matchingPieces as $matchingPiece)
                        <tr>
                            <td>{{ $matchingPiece->montant }}</td>
                            <td>{{ $matchingPiece->montantinitial }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        


    </div>
@endsection
