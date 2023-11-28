@extends('layout.chef_bureau.header')
@section('content')
<h1 style="text-align: center;">
  @foreach ($user as $item)
    <a class="nav-link" href="#"> Mr/Mrs  {{ $item['firstname'] }} {{ $item['lastname'] }}   <span class="badge rounded-pill badge-notification bg-danger"
      style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
  @endforeach
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
                    <th>Montant total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentNationalite = null;
                    $totalMontant = 0;
                @endphp

                @foreach ($grouped as $dataa)
                    @if ($currentNationalite != $dataa->nationalite)
                        @if ($currentNationalite != null)
                            <tr>
                                <td>{{ $currentNationalite }}</td>
                                <td>{{ $totalMontant }}</td>
                            </tr>
                        @endif

                        @php
                            $currentNationalite = $dataa->nationalite;
                            $totalMontant = $dataa->montant;
                        @endphp
                    @else
                        @php
                            $totalMontant += $dataa->montant;
                        @endphp
                    @endif
                @endforeach

                @if ($currentNationalite != null)
                    <tr>
                        <td>{{ $currentNationalite }}</td>
                        <td>{{ $totalMontant }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <a style="width: auto; height: fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
</div>
@endsection
