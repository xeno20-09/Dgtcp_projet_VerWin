@extends('layout.Admin.header')
@section('content')

    <div class="container">
        <h1>Gestion des États sur les pays </h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nationalité</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grouped as $dataa)
                        <tr>
                            <td>{{ $dataa->nationalite }}</td>
                            @foreach ($devise as $d)
@if ($dataa->nationalite==$d->nationalite)
<td>{{ $dataa->montant }} {{ $d->devise }}</td>

@endif
                            @endforeach

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
    <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

    @endsection