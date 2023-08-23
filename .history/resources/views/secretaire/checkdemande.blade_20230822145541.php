@extends('layout.secretaire.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>

        </div>


@foreach ($user as $item)
<form class="d-flex flex-row gap-3"
    style="width: 32%;position: relative;left: 120px;top: 72px;"action="{{ route('info.search.s', $item->id) }}"
    method="GET">
    <input class="form-control" type="search" name="query"
        value="{{ request()->input('query') }}"placeholder="Recherche" aria-label="Recherche">
    <button class="btn btn-outline" type="submit"><i class="fas fa-search"
            style="font-size:10px;"></i></button>
</form>
@endforeach