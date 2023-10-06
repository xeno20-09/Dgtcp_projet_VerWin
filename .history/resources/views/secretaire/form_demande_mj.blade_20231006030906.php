@extends('layout.secretaire.header')
@section('content')
    <h1 style="text-align: center;">
        @foreach ($user as $item)
            <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} <span class="badge rounded-pill badge-notification bg-danger"
                style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
        @endforeach
    </h1>
    @foreach ($user as $item)
    @foreach ($demande as $item1)
        <form action="{{ route('store_update_form_ask', $item1->id) }}" method="post" class="card-body cardbody-color p-lg-5">
            <input type="hidden" name="id_user" value="{{ $item->id }}">
            <input type="hidden" name="nom_demandeur" value="{{ $item->nom }}">
            <input type="hidden" name="mail_demandeur" value="{{ $item->mail }}">
            <input type="hidden" name="poste_demandeur" value="{{ $item->poste }}">
            @csrf
            @endforeach
    @endforeach
    <div class="row">
      {{--   @foreach ($user as $item)
            <legend>Bureau du {{ $item->poste }} </legend>
        @endforeach --}}
        @foreach ($demande as $item1)
        <legend>Mise à jour de la demande {{ $item1->numero_doss}}</legend>
    
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                <input name="date_depot" type="texte" value="{{ $item1->date }}" class="form-control" id=""
                    aria-describedby="" placeholder="">

            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Type personne</label>
                <input name="type_prs" type="texte" value="{{ $item1->type_prs }}" class="form-control" id=""
                aria-describedby="" placeholder="">
            </div>
        </div>
@if ($item1->type_prs=='morale')


<div id="physique">

    <div class="col">
        <div class="form-group">
            <label for="" class="form-label mt-4">Nature des opérations</label>
            <input name="nature_op" value="{{ $item1->nature_op }}" type="text" class="form-control" id=""
                placeholder="Nature des opérations">

        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="" class="form-label mt-4">Nature des produits</label>

            <input name="nature_pro" value="{{ $item1->nature_p }}" type="text" class="form-control" id=""
                placeholder="Nature des produits">

        </div>
    </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nationalité</label>
                <input name="nationalite" value="{{ $item1->nationalite }}" type="text" class="form-control" id=""
                placeholder="Nature des produits">
                
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Devise </label>
 

                <select style="top: 0px;" class="form-select position-relative" name='currency_from'
                aria-label="Default select example" onchange="valeur_p()"id='currency_from_p' required>
                <option value="null">Selectionner une devise</option>
                <option value="Euro">Euro</option>
                <option value="Dollar us">Dollar us</option>
                <option value="Yen japonais">Yen japonais</option>
                <option value="Livre sterling">Livre sterling</option>
                <option value="Franc suisse">Franc suisse</option>
                <option value="Dollar canadien">Dollar canadien</option>
                <option value="Yuan chinois">Yuan chinois</option>
                <option value="Dirham Emirats Arabes Unis">Dirham Emirats Arabes Unis</option>    

                </select>
            </div>
        </div>
        <script>
     
        </script>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Montant </label>
                <input name="montant_in" type="number" oninput="test()" class="form-control"  id="montant_in" placeholder="Montant ">
            </div>
        </div>
      
        <div class="col" id="valeur_p">
            <div class="form-group">
                <label for="" class="form-label mt-4">Valeur </label>
                <input name="valeur" type="text" id="val" class="form-control"  placeholder="Valeur" readonly>
          
            
            </div>
        </div>
        <div class="col" id="mont_fcfa_p">
            <div class="form-group">
                <label for="" class="form-label mt-4">Contre montant </label>
                <input name="mont_fcfa" type="text" class="form-control" id="montant_fcfa"  placeholder="Contre montant" readonly>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nom client</label>
                <input name="nom_client" type="text" class="form-control" id="nom" placeholder="Nom client">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Prenom client</label>
                <input name="prenom_client" type="text" class="form-control" id="prenom"
                    placeholder="Prenom client">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Profession client</label>
                <input name="profess_client" type="text" class="form-control" id=""
                    placeholder="ProfClient">
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Telephone client</label>
                <input maxlength="14" minlength="12" value="{{ $item1->tel_client }}" name="tel_client" type="number"
                    class="form-control" id="" placeholder="TelClient">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Banque</label>
                <input name="banque_client" type="text" value="{{ $item1->banque_client }}" class="form-control"
                    id="" placeholder="Banque">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Numéro de compte</label>
                <input maxlength="12" minlength="12" name="num_compt_client" value="{{ $item1->num_compt_client }}"
                    type="number" class="form-control" id="" placeholder="Numéro de compte">
            </div>
        </div>
    </div>

</div>

@endif

@if ($item1->type_prs=='physique')



@endif

     
        </div>
   

    </div>
    <div class="row">
        @php
            $devise = $item1->devise;
        @endphp

        <div class="col">
            <div class="form-group">
                <select style="top: 56px;" class="form-select position-relative" name='currency_from'
                    aria-label="Default select example" required>
                    <option value="{{ $devise }}" @if (Request::get('currency_from') == $devise) selected @endif>
                        {{ $devise }}</option>
                    <option value="AUD" @if (Request::get('currency_from') == 'AUD') selected @endif>Australia Dollar</option>
                    <option value="EUR" @if (Request::get('currency_from') == 'EUR') selected @endif>Euro</option>
                    <option value="GBP" @if (Request::get('currency_from') == 'GBP') selected @endif>Great Britain Pound</option>
                    <option value="INR" @if (Request::get('currency_from') == 'INR') selected @endif>India Rupee</option>
                    <option value="USD" @if (Request::get('currency_from') == 'USD') selected @endif>USA Dollar</option>
                </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Montant </label>
                <input name="montant_in" type="number" class="form-control" id="" value="{{ $item1->montant }}"
                    placeholder="Montant ">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <select style="top: 56px;" class="form-select position-relative" name='currency_to'
                    aria-label="Default select example" required>
                    <option value="XOF" @if (Request::get('currency_to') == 'XOF') selected @endif>Francs CFA</option>
                </select>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nom client</label>
                <input name="nom_client" type="text" class="form-control" id=""
                    value="{{ $item1->nom_client }}" placeholder="Nom client">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Prenom client</label>
                <input name="prenom_client" value="{{ $item1->prenom_client }}" type="text" class="form-control"
                    id="" placeholder="Prenom client">
            </div>
        </div>
        <!--  <div class="col">
                                              <div class="form-group">
                                               <label for="" class="form-label mt-4">Montant converti</label>
                                                <input name="montant_out" type="text" class="form-control" id="" placeholder="Montant converti">
                                              </div>
                                            </div>-->
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Profession client</label>
                <input name="profess_client" value="{{ $item1->profess_client }}" type="text" class="form-control"
                    id="" placeholder="ProfClient">
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Telephone client</label>
                <input maxlength="14" minlength="12" value="{{ $item1->tel_client }}" name="tel_client" type="number"
                    class="form-control" id="" placeholder="TelClient">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Banque</label>
                <input name="banque_client" type="text" value="{{ $item1->banque_client }}" class="form-control"
                    id="" placeholder="Banque">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Numéro de compte</label>
                <input maxlength="12" minlength="12" name="num_compt_client" value="{{ $item1->num_compt_client }}"
                    type="number" class="form-control" id="" placeholder="Numéro de compte">
            </div>
        </div>

    </div>
    @endforeach

    <br>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
