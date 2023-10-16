@extends('layout.chef_division.header')
@section('content')
<div class="container">
    <h1 style="text-align: center;">
        @foreach ($user as $item)
            <a class="nav-link" href="#"> Mr/Mrs  {{ $item['firstname'] }} {{ $item['lastname'] }}  <span
                    class="badge rounded-pill badge-notification bg-danger"
                    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
        @endforeach
    </h1>
    <legend>Liste des devises à jour</legend>
<div class="table-responsive">
    <style>
        .table-responsive {
overflow-x: auto;
max-width: 100%;
}

    </style>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Devise</th>
                <th>Valeur</th>

            </tr>
    </thead>
    <tbody>
        @foreach ($devises as $dev)
        @if ($dev->date!=$ladate)
        <tr  style="background-color: #797676; ">
            <td>{{ $dev->date}}</td>
            <td>{{ $dev->devise }}</td>
            <td>{{ $dev->valeur }}</td>
        </tr>
        @else
        <tr  style="background-color: #007bff; ">
            <td>{{ $dev->date}}</td>
            <td>{{ $dev->devise }}</td>
            <td>{{ $dev->valeur }}</td>
        </tr>
        @endif
        
        @endforeach
    </tbody>
</table>

</div>
<a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

</div>
<br>
<br>
@endsection