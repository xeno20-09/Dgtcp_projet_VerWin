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

            <form class="d-flex flex-row gap-3" style="" method="post"
                action="{{ route('store_search', $item_c->id_verifi) }}" method="post">
                @csrf
                @for ($i = 0; $i < $numberinput; $i++)
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="reference{{ $i }}">Références de la pièce
                                    {{ $i + 1 }}</label>
                                <input class="form-control" type="search" name="reference[]"
                                    placeholder="Reference du dossier" id="referencespiece{{ $i }}"
                                    aria-label="Recherche">
                            </div>
                        </div>
                    </div>
                @endfor
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        @endforeach
    @endsection
