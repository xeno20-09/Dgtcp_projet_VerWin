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
                    <th>Montant total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $societes = [];
            @endphp
            
            @foreach ($group as $dat)
                @if ($dat->nomsociete != 0)
                    @if (!array_key_exists($dat->nomsociete, $societes))
                        @php
                            $societes[$dat->nomsociete] = ['total' => 0, 'devise' => $dat->devise];
                        @endphp
                    @endif
            
                    @php
                        $societes[$dat->nomsociete]['total'] += $dat->total;
                    @endphp
                @endif
            @endforeach
            
            @foreach ($societes as $nomSociete => $info)
                <tr>
                    <td>{{ $nomSociete }}</td>
                    <td>{{ $info['total'] }} {{ $info['devise'] }}</td>
                </tr>
            @endforeach
            
            </tbody>
        </table>
    </div>
    <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
</div>

@endsection
