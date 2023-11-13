@extends('layout.client.header')
@section('content')
    <h1 style="text-align: center;">
        @foreach ($user as $item)
            <a class="nav-link" href="#"> Mr/Mrs {{ $item->firstname  }} </a>

    </h1>
    <div class="container">
        <form action="{{ route('Fclient', $item->id) }}" method="post" class="card-body cardbody-color p-lg-5">
            @endforeach
            @csrf

            <div class="row">
                <legend>Verification</legend>



            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                        <input name="date_depot" type="texte" class="form-control" id="" aria-describedby=""
                            placeholder="">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Numero du dossier</label>
                        <input name="numero_dossier" type="texte" class="form-control" id="" aria-describedby=""
                            placeholder="">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">

                    </div>
                </div>
            </div>


            <br>
            <button type="submit" class="btn btn-primary">Verifier</button>
        </form>

    </div>
@endsection
