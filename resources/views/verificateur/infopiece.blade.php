<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            @php
                $date = now();
                $e = 'ok';
            @endphp
            @foreach ($demande as $item_c)
                @for ($i = 0; $i < $item_c->nombre_doc; $i++)
                    <form action="{{ route('store_form_piece_verificateur', $item_c->id) }}" method="Post"
                        class="card-body cardbody-color p-lg-5">

                        @csrf
                        <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
                            <div class="col-lg-9 col-12">
                                <div class="card card-body" id="profile">


                                    <div class="row z-index-2 justify-content-center align-items-center">
                                        <div class="col-sm-auto col-4">

                                        </div>
                                        <div class="col-sm-auto col-8 my-auto">
                                            <div class="h-100">

                                                <p class="mb-0 font-weight-bold text-sm">
                                                    Demande N° {{ $item_c->numero_doss }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-9 col-12">
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- new pieces --}}
                        @if ($item_c->nombre_doc == $notfound)
                            <div class="mb-5 row justify-content-center">
                                <div class="col-lg-11 col-12">
                                    <div class="card" id="basic-info">
                                        <div class="card-header">
                                            <h5>Nouvelle pièce</h5>
                                        </div>
                                        <div class="pt-0 card-body">
                                            <!-- Première partie du formulaire -->
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Libellé de la
                                                            pièce</label>
                                                        <input name="libellepiece[]" type="texte"
                                                            value="{{ $libellePiece[$i] }}" class="form-control"
                                                            id="libellepiece" aria-describedby="" placeholder=""
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Références de
                                                            la
                                                            pièce</label>
                                                        <input name="referencespiece[]" type="texte"
                                                            value="{{ $referencePiece[$i] }}" class="form-control"
                                                            id="referencespiece" aria-describedby="" placeholder=""
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if ($datePiece[$i] != null)
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="datepiece{{ $i }}"
                                                                class="form-label mt-4">Date d'expiration</label>
                                                            <input type="texte" value="{{ $datePiece[$i] }}"
                                                                name="date_expi[]" id="datepieceex"
                                                                placeholder="Date d'expiration"
                                                                class="form-control"readonly>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Date de la
                                                            pièce</label>
                                                        <input name="date_piece[]" type="texte"
                                                            value="{{ $date }}" class="form-control"
                                                            id="date_piece" aria-describedby="" placeholder="" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($montantligne[$i] != null)
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-label mt-4">Montant de
                                                                la
                                                                pièce</label>
                                                            <input name="montantligne[]" type="texte"
                                                                value="{{ $montantligne[$i] }}" class="form-control"
                                                                id="montantligne" aria-describedby="" placeholder=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">


                                                            @if ($restant <= $montantligne[$i] && $montantdmd <= $montantligne[$i] && $e != 'non')
                                                                <label for='montantdmd' class="form-label mt-4">Montant
                                                                    de la demande</label>
                                                                <input type='number' value='{{ $montantdmd }}'
                                                                    name='montantdmd[]' id='montantdmd'
                                                                    style='background-color:skyblue'
                                                                    placeholder='Montant de la demande'
                                                                    class='form-control'readonly>
                                                            @endif

                                                            @if (($restant > $montantligne[$i] || $montantdmd > $montantligne[$i] || $e == 'non') && $montantligne[$i] != null)
                                                                <label for='montantdmd' class="form-label mt-4">Montant
                                                                    de la demande</label>
                                                                <input type='number' value='{{ $montantdmd }}'
                                                                    name='montantdmd[]' id='montantdmd'
                                                                    style='background-color: red'
                                                                    placeholder='Montant de la demande'
                                                                    class='form-control'readonly>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class='col'>
                                                        <div class='form-group'>
                                                            @if ($e == 'ok' || $e == 'non')
                                                                <label for='montantrestant'
                                                                    class="form-label mt-4">Montant Restant</label>
                                                                <input type='number' value='{{ $restant }}'
                                                                    name='montantrestant[]' id='montantrestant'
                                                                    style='background-color: skyblue'
                                                                    placeholder='Montant de la Restant'
                                                                    class='form-control'readonly>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif




                                        </div>


                                    </div>
                                </div>

                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Save
                                    changes</button>
                            </div>
                        @endif



                        {{--  --}}
                        @if ($item_c->nombre_doc == $found)
                            <div class="mb-5 row justify-content-center">
                                <div class="col-lg-11 col-12">
                                    <div class="card" id="basic-info">
                                        <div class="card-header">
                                            <h5>
                                                <p>
                                                    Il restait <span>{{ $restant }}</span>
                                                    pour cette demande.
                                                </p>
                                            </h5>
                                        </div>
                                        <div class="pt-0 card-body">
                                            <!-- Première partie du formulaire -->
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Libellé de
                                                            la
                                                            pièce</label>
                                                        <input name="libellepiece[]" type="texte"
                                                            value="{{ $libellePiece[$i] }}" class="form-control"
                                                            id="libellepiece" aria-describedby="" placeholder=""
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Références
                                                            de la
                                                            pièce</label>
                                                        <input name="referencespiece[]" type="texte"
                                                            value="{{ $referencePiece[$i] }}" class="form-control"
                                                            id="referencespiece" aria-describedby="" placeholder=""
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if ($datePiece[$i] != null)
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="datepiece{{ $i }}"
                                                                class="form-label mt-4">Date d'expiration</label>
                                                            <input type="texte" value="{{ $datePiece[$i] }}"
                                                                name="date_expi[]" id="datepieceex"
                                                                placeholder="Date d'expiration"
                                                                class="form-control"readonly>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Date de la
                                                            pièce</label>
                                                        <input name="date_piece[]" type="texte"
                                                            value="{{ $date }}" class="form-control"
                                                            id="date_piece" aria-describedby="" placeholder=""
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($montantligne[$i] != null)
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-label mt-4">Montant
                                                                de
                                                                la
                                                                pièce</label>
                                                            <input name="montantligne[]" type="texte"
                                                                value="{{ $montantligne[$i] }}" class="form-control"
                                                                id="montantligne" aria-describedby="" placeholder=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">


                                                            @if ($restant <= $montantligne[$i] && $montantdmd <= $montantligne[$i] && $e != 'non')
                                                                <label for='montantdmd'
                                                                    class="form-label mt-4">Montant
                                                                    de la demande</label>
                                                                <input type='number' value='{{ $montantdmd }}'
                                                                    name='montantdmd[]' id='montantdmd'
                                                                    style='background-color:skyblue'
                                                                    placeholder='Montant de la demande'
                                                                    class='form-control'readonly>
                                                            @endif

                                                            @if (($restant > $montantligne[$i] || $montantdmd > $montantligne[$i] || $e == 'non') && $montantligne[$i] != null)
                                                                <label for='montantdmd'
                                                                    class="form-label mt-4">Montant
                                                                    de la demande</label>
                                                                <input type='number' value='{{ $montantdmd }}'
                                                                    name='montantdmd[]' id='montantdmd'
                                                                    style='background-color: red'
                                                                    placeholder='Montant de la demande'
                                                                    class='form-control'readonly>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class='col'>
                                                        <div class='form-group'>
                                                            @if ($e == 'ok' || $e == 'non')
                                                                <label for='montantrestant'
                                                                    class="form-label mt-4">Montant Restant</label>
                                                                <input type='number' value='{{ $restant }}'
                                                                    name='montantrestant[]' id='montantrestant'
                                                                    style='background-color: skyblue'
                                                                    placeholder='Montant de la Restant'
                                                                    class='form-control'readonly>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif




                                        </div>


                                    </div>
                                </div>

                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Save
                                    changes</button>
                            </div>
                        @endif


                    </form>
                @endfor

                @for ($i = 0; $i < $item_c->nombre_doc; $i++)
                    @if (($restant > $montantligne[$i] || $montantdmd > $montantligne[$i] || $e == 'non') && $montantligne[$i] != null)
                        <form action="{{ route('rejet_piece_verificateur', $item_c->id) }}" method="Post"
                            class="card-body cardbody-color p-lg-5">

                            @csrf
                            <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
                                <div class="col-lg-9 col-12">
                                    <div class="card card-body" id="profile">


                                        <div class="row z-index-2 justify-content-center align-items-center">
                                            <div class="col-sm-auto col-4">

                                            </div>
                                            <div class="col-sm-auto col-8 my-auto">
                                                <div class="h-100">

                                                    <p class="mb-0 font-weight-bold text-sm">
                                                        Demande N° {{ $item_c->numero_doss }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-9 col-12">
                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert" id="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert" id="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- new pieces --}}
                            <div class="mb-5 row justify-content-center">
                                <div class="col-lg-11 col-12">
                                    <div class="card" id="basic-info">
                                        <div class="card-header">
                                            <h5>Rejet de la pièce</h5>
                                        </div>
                                        <div class="pt-0 card-body">
                                            <!-- Première partie du formulaire -->
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Libellé de la
                                                            pièce</label>
                                                        <input name="libellepiec[]" type="texte"
                                                            value="{{ $libellePiece[$i] }}" class="form-control"
                                                            id="libellepiece" aria-describedby="" placeholder=""
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Références de la
                                                            pièce</label>
                                                        <input name="referencepiec[]" type="texte"
                                                            value="{{ $referencePiece[$i] }}" class="form-control"
                                                            id="referencespiece" aria-describedby="" placeholder=""
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Date
                                                            d'expiration</label>
                                                        <input type="texte" value="{{ $datePiece[$i] }}"
                                                            name="datepiec[]" id="datepieceex"
                                                            placeholder="Date d'expiration"
                                                            class="form-control"readonly>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Date de la
                                                            pièce</label>
                                                        <input name="dat" type="texte"
                                                            value="{{ $date }}" class="form-control"
                                                            id="date_piece" aria-describedby="" placeholder=""
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($montantligne[$i] != null)
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="" class="form-label mt-4">Montant de
                                                                la
                                                                pièce</label>
                                                            <input name="montantlign[]" type="texte"
                                                                value="{{ $montantligne[$i] }}" class="form-control"
                                                                id="montantligne" aria-describedby="" placeholder=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">


                                                            <label for='montantdmd' class="form-label mt-4">Montant
                                                                de la demande</label>
                                                            <input type='number' value='{{ $montantdmd }}'
                                                                name='montantinitia' id='montantdmd' type="texte"
                                                                placeholder='Montant de la demande'
                                                                class='form-control'readonly>



                                                        </div>
                                                    </div>
                                                    <div class='col'>
                                                        <div class='form-group'>
                                                            <label for='montantrestant'
                                                                class="form-label mt-4">Montant Restant</label>
                                                            <input type='number' value='{{ $restant }}'
                                                                name='montantrestan' type="texte"
                                                                id='montantrestant'
                                                                placeholder='Montant de la Restant'
                                                                class='form-control'readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif




                                        </div>


                                    </div>
                                </div>

                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">
                                    Rejeter</button>
                            </div>

                        </form>
                    @endif
                @endfor

            @endforeach
        </div>
    </main>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
