@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>   
        @foreach ($demande as $item)
         {{ $item->numero_doss }}
         {{ $item->nom_client }}
         @endforeach
         @foreach ($ as $item)
         {{ $item->numero_doss }}
         {{ $item->nom_client }}
         @endforeach
    </div>
@endsection
