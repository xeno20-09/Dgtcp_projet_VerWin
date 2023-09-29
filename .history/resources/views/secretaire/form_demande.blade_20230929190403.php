@extends('layout.secretaire.header')
@section('content')
    <h1 style="text-align: center;">
        @foreach ($user as $item)
            <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }}  <span class="badge rounded-pill badge-notification bg-danger"
                style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span>  </a>
        @endforeach
    </h1>
    @foreach ($user as $item)
        <form action="{{ route('store_form_ask', $item->id) }}" method="post" class="card-body cardbody-color p-lg-5">
            <input type="hidden" name="id_user" value="{{ $item->id }}">
            <input type="hidden" name="nom_demandeur" value="{{ $item->nom }}">
            <input type="hidden" name="mail_demandeur" value="{{ $item->mail }}">
            <input type="hidden" name="poste_demandeur" value="{{ $item->poste }}">
            @csrf
    @endforeach
    <div class="row">
      {{--   @foreach ($user as $item)
            <legend>Bureau du {{ $item->poste }} </legend>
        @endforeach --}}
        <legend>Enregistrement d'une demande</legend>
        <!--<div class="col">
                  <div class="form-group">
                    <label for="" class="form-label mt-4">Numéro du dossier</label>
                    <input name="num_dossier" type="text" class="form-control" id="" aria-describedby="" placeholder="" disabled>
                  </div>
                </div> -->
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                <input name="date_depot" type="texte" value="{{ $date }}" class="form-control" id=""
                    aria-describedby="" placeholder="">

            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nature des opérations</label>
                <!--     <select class="form-select" id="exampleSelect1">
                      <option></option>
                      <option></option>
                      <option></option>
                    </select> -->
                <input name="nature_op" type="text" class="form-control" id=""
                    placeholder="Nature des opérations">

            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nature des produits</label>
                <!--   <select class="form-select" id="exampleSelect1">
                      <option></option>
                      <option></option>
                      <option></option>
                    </select> -->
                <input name="nature_pro" type="text" class="form-control" id=""
                    placeholder="Nature des produits">

            </div>
        </div>

    </div>
    <div class="row">

        <div class="col">
            <div class="form-group">
                <select style="top: 56px;" class="form-select position-relative" name='currency_from'
                    aria-label="Default select example" required>
                    <option value="" @if (Request::get('currency_to') == null) selected @endif>Select Currency</option>
                    <option value="AUD" @if (Request::get('currency_to') == 'AUD') selected @endif>Australia Dollar</option>
                    <option value="EUR" @if (Request::get('currency_to') == 'EUR') selected @endif>Euro</option>
                    <option value="GBP" @if (Request::get('currency_to') == 'GBP') selected @endif>Great Britain Pound</option>
                    <option value="INR" @if (Request::get('currency_to') == 'INR') selected @endif>India Rupee</option>
                    <option value="USD" @if (Request::get('currency_to') == 'USD') selected @endif>USA Dollar</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Montant </label>
                <input name="montant_in" type="number" class="form-control" id="" placeholder="Montant ">
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
                <input name="nom_client" type="text" class="form-control" id="" placeholder="Nom client">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Prenom client</label>
                <input name="prenom_client" type="text" class="form-control" id=""
                    placeholder="Prenom client">
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
                <input name="profess_client" type="text" class="form-control" id=""
                    placeholder="ProfClient">
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Telephone client</label>
                <input maxlength="14" minlength="12" name="tel_client" type="number" class="form-control"
                    id="" placeholder="TelClient">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Banque</label>
                <input name="banque_client" type="text" class="form-control" id="" placeholder="Banque">
                <select name="" id="">
<option value="">
</option>
<option value="">
</option>
<option value="">
</option>
Bank of Africa Bénin
Banque internationale du Bénin
Banque de l'habitat du Bénin
Ecobank
Orabank Bénin
United Bank of Africa
Diamond Bank
Société générale de banques du Bénin
Banque Sahélo-Saharienne pour l’Investissement et le Commerce
Banque atlantique du Bénin
BGFIBank Bénin
Afriland first bank benin
Banque Africaine pour l'Investissement et le Commerce (BAIC)
CBAO surcusale Attijariwafa Bank
Coris-Bank Bénin

                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Numéro de compte</label>
                <input maxlength="12" minlength="12" name="num_compt_client" type="number" class="form-control"
                    id="" placeholder="Numéro de compte">
            </div>
        </div>

    </div>

    <br>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
