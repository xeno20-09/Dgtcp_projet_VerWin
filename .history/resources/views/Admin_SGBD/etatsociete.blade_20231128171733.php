@extends('layout.c')
@section('content')

    <div class="container">
        <h1>Gestion des États sur les sociétés</h1>
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
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group as $dat)
                    @if ( $dat->nomsociete!=0)
                       <tr>
                            <td>{{ $dat->nomsociete }}</td>
                            @foreach ($devise as $d)
@if ($d->nomsociete==$dat->nomsociete)
<td>{{ $dat->total }} {{ $d->devise }}</td>

@endif
                            @endforeach

                        </tr>  
                    @endif
                       
                    @endforeach
                </tbody>
            </table>
        </div>
        <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

    </div>

    @endsection