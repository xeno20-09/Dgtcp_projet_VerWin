@extends('layout.Admin.header')
@section('content')

    <div class="container">
        <h1>Gestion des États sur les sociétés</h1>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom de la société</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group as $dat)
                    @if ( $dat->nomsociete!=0)
                       <tr>
                            <td>{{ $dat->nomsociete }}</td>
                            @foreach ($group as $dat)

                            <td>{{ $dat->total }}{{ $dat->devise }}</td>
                        </tr>  
                    @endif
                       
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

    @endsection