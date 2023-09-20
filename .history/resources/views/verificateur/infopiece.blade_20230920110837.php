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
                @php
                $valeurMax = $restant;

              
            @endphp
                @for ($i = 0; $i < $item_c->nombre_doc; $i++)
                <div>
                    <hr>                </div>
               
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="libellepiece">Libellé de la pièce</label>
                                <input type="text" name="libellepiece[]" id="libellepiece"
                                    placeholder="Libellé de la pièce" class="form-control"
                                    value="{{ $libellePiece[$i] }}"readonly>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="referencespiece">Références de la pièce</label>
                                <input type="text" value="{{ $referencesPieces[$i] }}" name="referencespiece[]"
                                    id="referencespiece" placeholder="Références de la pièce" class="form-control"readonly>
                            </div>
                        </div>

                        @if ($datePiece[$i] != null)
                            <div class="col">
                                <div class="form-group">
                                    <label for="datepiece{{ $i }}">Date d'expiration</label>
                                    <input type="texte" value="{{ $datePiece[$i] }}" name="date_expi[]"
                                        id="datepieceex" placeholder="Date d'expiration" class="form-control"readonly>
                                </div>
                            </div>
                        @endif

                        <div class="col">
                            <div class="form-group">
                                <label for="date_piece">Date de la pièce</label>
                                <input type="texte" value="{{ $date }}" name="date_piece[]" id="date_piece"
                                    class="form-control"readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                   
                        @if ($montantligne[$i] == null)
                        <div class="col">
                            <div class="form-group">
                                <label for="montantligne">Montant de la ligne</label>
                                <input type="number" name="montantligne[]" id="montantligne"
                                    placeholder="Montant de la ligne" value="{{$montantligne[$i]}}" class="form-control">
                            </div>
                        </div>
                        @elseif ($montantligne[$i] != null)
                        <div class="col">
                            <div class="form-group">
                                <label for="montantligne">Montant de la ligne</label>
                                <input type="number" name="montantligne[]" id="montantligne"
                                    placeholder="Montant de la ligne"  value="{{$montantligne[$i]}}" class="form-control"readonly>
                            </div>
                        </div>
                        @endif
                        <div class="col">
                            <div class="form-group">
                                @if (($restant!=0)&&( $restant>$montantligne[$i])&&($restant!='r'))
                                    <label for='montantdmd'>Montant de la demande</label>
                                    <input type='number' value='{{ $montantdmd }}' name='montantdmd[]'
                                        id='montantdmd' placeholder='Montant de la demande'
                                        class='form-control'readonly>
                                        @endif    
                                            
                                        @if ( ($restant>=$montantligne[$i])||($montantdmd>=$montantligne[$i]) ) 
                                        <label for='montantdmd'>Montant de la demande</label>
                                        <input type='number' value='{{ $montantdmd }}' name='montantdmd[]'
                                            id='montantdmd' style='background-color: red' placeholder='Montant de la demande'
                                            class='form-control'readonly>
                                            
                                @endif
                                @if ( ($restant>=$montantligne[$i])||($montantdmd>=$montantligne[$i]) ) 
                                <label for='montantdmd'>Montant de la demande</label>
                                <input type='number' value='{{ $montantdmd }}' name='montantdmd[]'
                                    id='montantdmd' style='background-color: red' placeholder='Montant de la demande'
                                    class='form-control'readonly>
    
                                @endif
                             
                                @if ( ($restant<=$montantligne[$i])||($montantdmd<=$montantligne[$i])&&($e!='fin') )                                 <label for='montantdmd'>Montant de la demande</label>
                                <input type='number' value='{{ $montantdmd }}' name='montantdmd[]'
                                    id='montantdmd' style='background-color:skyblue' placeholder='Montant de la demande'
                                    class='form-control'readonly>
    
                                @endif
                            </div>
                        </div>
                             <div class='col'>
                            <div class='form-group'>
                                @if ($e == 'ok')
                                    <label for='montantrestant'>Montant  Restant</label>
                                    <input type='number' value='{{ $restant }}' name='montantrestant[]'
                                        id='montantrestant' style='background-color: skyblue'
                                        placeholder='Montant de la Restant' class='form-control'readonly>
                                @endif
                            </div>
                        </div>
                    </div>
                  
                @endfor

      {{ ($e }}
                 
                @for ($i = 0; $i < $item_c->nombre_doc; $i++)

                    @if ( ($restant<=$montantligne[$i])||($montantdmd<=$montantligne[$i])&&($e!='fin') ) 
                    <div class="row mt-5">
                    <div class="col">
                        <div class="form-group">
                    <button type='submit' class='btn btn-primary'>Enregistrer</button>
                </div>
            </div>
             @endif
             @endfor
             </form> 
             @for ($i = 0; $i < $item_c->nombre_doc; $i++)

             @if ( ($restant>=$montantligne[$i])||($montantdmd>=$montantligne[$i]) ) 
             <div class="col">
                <div class="form-group">
                <a href='{{ route('rejet_piece_verificateur', $item_c->id) }}'>
                    <button class='btn btn-danger'>Rejeter</button>
                </a>
            </div>
        </div>
    </div>
         @endif
         @endfor

         @endforeach
    </div>
@endsection