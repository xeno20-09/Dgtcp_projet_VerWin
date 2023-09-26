@extends('layout.chef_bureau.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }}  <span class="badge rounded-pill badge-notification bg-danger"
                    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
            @endforeach
        </h1>
        <h1>Liste des demandes </h1>

        <table class="table ">
            <thead>
                <tr>

                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Nom du client:</th>

                    <th scope="col">Date:</th>
                    <th scope="col">Nom Secretaire:</th>
                    <th scope="col">Nom Beneficiere:</th>

                    <th scope="col">Nom Verificateur:</th>
                    <th scope="col">Date decision :</th>
                    <th scope="col">Nom Chef Division:</th>
                    <th scope="col">Montant:</th>
                    <th scope="col">Devise:</th>
                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Status:</th>
                    <th scope="col">Actions</span></th>


                </tr>
            </thead>
            </table>

</div>


<br>
<br>
@endsection
