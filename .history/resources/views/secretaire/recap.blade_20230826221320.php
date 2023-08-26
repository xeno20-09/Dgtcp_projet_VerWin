@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        <td> {{ $item->numero_doss }}</td>
        <td> {{ $item->nom_client }}</td>
    </div>
@endsection
