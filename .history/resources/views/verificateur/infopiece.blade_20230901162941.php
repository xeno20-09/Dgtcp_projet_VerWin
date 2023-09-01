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

            <form action="{{ route('store_form_piece_verificateur', $item_c->id) }}" method="post">
                @csrf



                @for ($i = 0; $i < $item_c->nombre_doc; $i++)
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="libellepiece">Libellé de la pièce</label>
                                <input type="text" name="libellepiece" id="libellepiece"
                                    placeholder="Libellé de la pièce" class="form-control" value="">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="referencespiece">Références de la pièce
                                </label>
                                <input type="text" value="{{ $referencesPieces[$i] }}" name="referencespiece"
                                    id="referencespiece" placeholder="Références de la pièce" class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="date_piece">Date de la pièce</label>
                                <input type="texte" value="{{ $date }}" name="date_piece" id="date_piece"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="montantligne">Montant de la ligne</label>
                                <input type="number" name="montantligne" id="montantligne"
                                    placeholder="Montant de la ligne" class="form-control">
                            </div>
                        </div>
                    </div>
                @endfor


                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        @endforeach
    </div>
@endsection
{{--     @for ($i = 0; $i < $numberinput; $i++)
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="libellepiece{{ $i }}">Libellé de la pièce {{ $i + 1 }}</label>
                                <input type="text" name="libellepiece[]" id="libellepiece{{ $i }}"
                                    placeholder="Libellé de la pièce" class="form-control" value="{{ $file[$i] }}">
                            </div>
                        </div>
                        @php
                            $numdoss = $item_c->numero_doss;
                            $ref = $filewithoutext[$i] . substr($numdoss, 0, 2);
                        @endphp
                        <div class="col">
                            <div class="form-group">
                                <label for="referencespiece{{ $i }}">Références de la pièce
                                    {{ $i + 1 }}</label>
                                <input type="text" name="referencespiece[]" id="referencespiece{{ $i }}"
                                    placeholder="Références de la pièce" class="form-control" value="{{ $ref }}">
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
                                    placeholder="Montant de la ligne" class="form-control">
                            </div>
                        </div>
                    </div>
                @endfor --}}
