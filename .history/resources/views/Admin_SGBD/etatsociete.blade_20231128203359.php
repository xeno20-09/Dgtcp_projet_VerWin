@extends('layout.chef_bureau.header')
@section('content')
<h1 style="text-align: center;">
    @foreach ($user as $item)
    <a class="nav-link" href="#">
        Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }}
        <span class="badge rounded-pill badge-notification bg-danger"
            style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>
    </a>
    @endforeach
</h1>

<div class="container">
    @php
    $test='Société';
    @endphp
    <br>
    <a class="btn btn-primary" href="{{ route('lalisteetats.pdf', ['test' => $test]) }}">Impression</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom de la société</th>
                    <th>Montants</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentSociete = null;
                    $totalMontant = 0;
                @endphp
        
                @foreach ($group as $dat)
                    @if ($dat->nomsociete != null)
                        @if ($currentSociete != $dat->nomsociete)
                            {{-- Afficher le total de la société précédente --}}
                            @if ($currentSociete != null)
                                <tr>
                                    <th scope="row">{{ $currentSociete }}</th>
                                    <td>Total : {{ $totalMontant }}</td>
                                </tr>
                            @endif
        
                            {{-- Mettre à jour la société en cours --}}
                            @php
                                $currentSociete = $dat->nomsociete;
                                $totalMontant = $dat->total;
                            @endphp
                        @else
                            {{-- Mettre à jour le total de la société en cours --}}
                            @php
                                $totalMontant += $dat->total;
                            @endphp
                        @endif
        
                        {{-- Afficher les montants détaillés --}}
                        <tr>
                            <td>{{ $dat->nomsociete }}</td>
                            <td>{{ $dat->total }} {{ $dat->devise }}</td>
                        </tr>
                    @endif
                @endforeach
        
                {{-- Afficher le total de la dernière société --}}
                @if ($currentSociete != null)
                    <tr>
                        <th scope="row">{{ $currentSociete }}</th>
                        <td>Total : {{ $totalMontant }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        
    </div>
    <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
</div>

@endsection
