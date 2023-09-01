@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} <span
                        class="badge rounded-pill badge-notification bg-danger"
                        style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
            @endforeach
        </h1>
        @foreach ($demande as $item_c)
            <h1>Demande N° {{ $item_c->numero_doss }} </h1>
            @for ($i = 0; $i < $numberinput; $i++)
                <form class="d-flex flex-row gap-3" style="" method="post"
                    action="{{ route('store_search', $item_c->id_verifi) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input class="form-control" type="search" name="query" placeholder="Reference du dossier"
                                    aria-label="Recherche">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            @endfor
        @endforeach
    @endsection
