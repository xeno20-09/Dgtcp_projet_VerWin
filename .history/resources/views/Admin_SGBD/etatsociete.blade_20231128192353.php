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
                for(i)
                $societes=$group;

            @endphp

                @foreach ($group as $dat)
{{$societe}}
               
                @endforeach
            </tbody>
        </table>
    </div>
    <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
</div>

@endsection
