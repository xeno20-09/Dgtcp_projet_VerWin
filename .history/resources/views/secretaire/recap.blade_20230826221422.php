@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        @foreach ($demande as $itemd)
            {{ $itemd->numero_doss }}
            {{ $itemd->nom_client }}
        @endforeach
        @foreach ($piece as $itemp)
            {{ $itemp->numero_doss }}
            {{ $itemp->nom_client }}
        @endforeach
    </div>
@endsection
