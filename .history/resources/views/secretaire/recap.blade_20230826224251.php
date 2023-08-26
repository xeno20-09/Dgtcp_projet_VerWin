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
                        $matchingPiece = null;
                        foreach ($piece as $itemp) {
                            if ($itemp->numero_doss === $itemd->numero_doss) {
                                $matchingPiece = $itemp;
                                break;
                            }
                        }
                    @endphp
                    <tr>
                        <td>{{ $itemd->numero_doss }}</td>
                        <td>{{ $itemd->montant }}</td>
                        @if ($matchingPiece)
                            <td>{{ $matchingPiece->montantinitial }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>



    </div>
@endsection
