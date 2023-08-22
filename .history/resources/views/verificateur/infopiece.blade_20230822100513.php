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
            @php
                $numdoss = $item_c->numero_doss;
                $ref = $date . substr($numdoss, 0, 2);
            @endphp
            <form action="{{ route('store_piece_dmd', $item_c->id) }}" method="post">
                @csrf

                @for ($i = 0; $i < $numberinput; $i++)
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="libellepiece{{ $i }}">Libellé de la pièce {{ $i + 1 }}</label>
                                <select name="libellepiece[]" id="libellepiece{{ $i }}" class="form-control">
                                    <option value="" selected disabled>Choisir le fichier</option>
                                    @foreach ($file as $fileName)
                                        <option value="{{ $fileName }}">{{ $fileName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="libellepiece{{ $i }}">Libellé de la pièce {{ $i + 1 }}</label>
                                @foreach ($file as $fileName)
                                    <input type="text" name="referencespiece[]" id="referencespiece{{ $i }}"
                                        value="{{ $fileName }}" class="form-control">
                                @endforeach
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="referencespiece{{ $i }}">Références de la pièce
                                    {{ $i + 1 }}</label>
                                <input type="text" name="referencespiece[]" id="referencespiece{{ $i }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="date_piece{{ $i }}">Date de la pièce {{ $i + 1 }}</label>
                                <input type="texte" value="{{ $date }}" name="date_piece[]"
                                    id="date_piece{{ $i }}" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="montantligne{{ $i }}">Montant de la ligne
                                    {{ $i + 1 }}</label>
                                <input type="number" name="montantligne[]" id="montantligne{{ $i }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                @endfor

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        @endforeach
    </div>
@endsection
