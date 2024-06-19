@extends('layout.Admin.header')
@section('content')
<h1 style="text-align: center;">
    @foreach ($admin as $item)
    <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} </a>
    @endforeach
</h1>
    <div class="container">
        <h1 style="text-align: center;">
            {{--      @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }}  <span class="badge rounded-pill badge-notification bg-danger"
                    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
            @endforeach --}}
        </h1>
        {{-- 
        <table class="table ">
            <thead>
                <tr>

                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Nom du client:</th>
                    <th scope="col">Date:</th>
                    <th scope="col">Montant:</th>
                    <th scope="col">Devise:</th>
                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Status:</th>
                    <th scope="col">Actions</span></th>


                </tr>
            </thead>
            <tbody>

                @foreach ($demande as $item)
                    <tr class="table-success">

                        <td> {{ $item->numero_doss }}</td>
                        <td> {{ $item->nom_client }}</td>
                        <td> {{ $item->date }}</td>

              

            <td> {{ $item['montant'] }}</td>
            <td>{{ $item['devise'] }}</td>
            <td>{{ $item['montant_con'] }}</td>
            <td>{{ $item->status_dmd }}</td>
            <td>


            </td>

            <td>
                <a style="width: auto; height:fit-content;"
                    href="{{ route('detaillesdmd', ['id' => $item->id]) }}" class="btn btn-primary">Voir</a>
            </td>




        </tr>
    @endforeach
</tbody>
</table> --}}

        @if ($number == 0)
            <div class="alert alert-danger">

                <strong>Vos critères de recherche n'ont retournés aucunes demandes </strong>
            </div>
        @else
            <h1>Liste des demandes </h1>
            <a class="btn btn-primary"
                href="{{ route('laliste.pdf', ['status' => $status, 'sdate' => $sdate, 'fdate' => $fdate, 'devise' => $devise]) }}">Impression</a>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th scope="col">N°Dossier:</th>
                            <th scope="col">Date:</th>
                            <th scope="col">Montant:</th>
                            <th scope="col">Contre Montant en FCFA:</th>
                            <th scope="col">Status:</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($demande as $item)
                            <tr class="table">

                                <td> {{ $item->numero_doss }}</td>
                                <td> {{ $item->date }}</td>
                                <td> {{ $item['montant'] }} {{ $item['devise'] }}</td>
                                <td>{{ $item['montant_con'] }}</td>
                                <td>{{ $item->status_dmd }}</td>




                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <a style="width: auto; height:fit-content;" href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>

        <br>
        <br>
    @endsection
