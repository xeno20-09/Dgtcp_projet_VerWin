@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        @foreach ($demande as $item_c)
            <h1>Demande N° {{ $item_c->numero_doss }} </h1>

            <form action="" method="post">
                @csrf

                @for ($i = 0; $i < $numberinput; $i++)


                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Pays benificiaire</label>
                            <input name="pays_benifi" type="text" class="form-control" id=""
                                placeholder="PaysClient">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Banque beneficiaire</label>
                            <input name="banque_benifi" type="text" class="form-control" id=""
                                placeholder="Banque">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Numéro de compte beneficiaire</label>

                            <input maxlength="12" minlength="12" name="num_compt_benifi" type="text"
                                class="form-control" id="" placeholder="Numéro de compte">

                        </div>
                    </div>


                </div>

              

                    <div class="form-group">
                        <label for="referencespiece{{ $i }}">Références de la pièce {{ $i + 1 }}</label>
                        <input type="text" name="referencespiece[]" id="referencespiece{{ $i }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="date_piece{{ $i }}">Date de la pièce {{ $i + 1 }}</label>
                        <input type="date" name="date_piece[]" id="date_piece{{ $i }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="montantligne{{ $i }}">Montant de la ligne {{ $i + 1 }}</label>
                        <input type="number" name="montantligne[]" id="montantligne{{ $i }}"
                            class="form-control">
                    </div>
                @endfor

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
    </div>


    <br>
    <br>
@endsection
