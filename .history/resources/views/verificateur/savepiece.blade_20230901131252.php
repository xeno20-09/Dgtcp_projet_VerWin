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

            <form class="d-flex flex-row gap-3" style="width: 32%;position: relative;left: 120px;top: 72px;" method="post"
                action="{{ route('store_search_ask_suite', $itemc->id_verifi) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">

                            <input class="form-control" type="search" name="query" placeholder="Recherche"
                                aria-label="Recherche">
                            <button class="btn btn-outline" type="submit"><i class="fas fa-search"
                                    style="font-size:10px;"></i></button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        @endforeach
    @endsection
