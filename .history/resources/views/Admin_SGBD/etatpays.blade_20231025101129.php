@extends('layout.Admin.header')

@section('content')
<div class="container">
    <h1>Gestion des États sur les pays</h1>
    @php
        $test = 'Pays';
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
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped as $dataa)
                    <tr>
                        @php
                            if  ($dataa->nationalite==null){
                                # code...
                            }
                        @endphp
                        @if ($dataa->nationalite==null)
                        @endif
                        <td>{{ $dataa->nationalite }}</td>
                        <td>
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach ($devise as $d)
                                        @if ($dataa->nationalite == $d->nationalite)
                                            <tr>
                                                <td>{{ $d->montant }} {{ $d->devise }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @php
                                $totalMontant = 0; // Initialiser la somme des montants
                            @endphp

                            @foreach ($devise as $subD)
                                @if ($subD->nationalite == $dataa->nationalite)
                                    @php
                                        $totalMontant += $subD->montant; // Ajouter le montant à la somme
                                    @endphp
                                @endif
                            @endforeach

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Montant total :</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $totalMontant }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a style="width: auto; height: fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
</div>
@endsection
