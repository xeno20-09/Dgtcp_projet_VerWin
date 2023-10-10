@extends('layout.Admin.header')
@section('content')

    <div class="container">
        <h1>Gestion des États sur les pays </h1>
        @php
             $test='Pays';
        @endphp
        <br>
        <a class="btn btn-primary" href="{{ route('lalisteetats.pdf', ['test' => $test]) }}">Impression</a>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nationalité</th>
                        <th>Montant</th>
                        <th>Montant total :</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grouped as $dataa)
                        <tr>
                            <td>{{ $dataa->nationalite }}</td>
                            @foreach ($devise as $d)
@if ($dataa->nationalite==$d->nationalite)
<td>{{-- {{ $dataa->total }} --}}{{ $d->montant }} {{ $d->devise }}</td>

@endif



                            @endforeach

                        </tr>
                    @endforeach
                    @php
$totalMontant = 0; // Initialiser la somme des montants
@endphp

@foreach ($devise as $subD)
@if ($subD->nationalite == $d->nationalite)
    @php
        $totalMontant += $subD->montant; // Ajouter le montant à la somme
    @endphp
@endif
@endforeach
<td>{{ $totalMontant}}</td>
                </tbody>
            </table>
        </div>
        <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

    </div>    

    @endsection