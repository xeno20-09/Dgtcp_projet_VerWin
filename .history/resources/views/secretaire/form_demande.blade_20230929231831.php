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
            <div class="form-group" style="position: relative;top: 15px;">
                   <p>Entrez votre numéro de téléphone:</p>
         <input id="phone" type="tel" name="tel_client" class="form-control" style="  width: 465px;"  placeholder="TelClient">
         <input type='hidden' name='codecountry'id="codecountry" value="">
         <input type='hidden' name='namcountry'id="namcountry" value="">

            </div>
        </div>
 
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Banque</label>
                <select style="top: 0px;" class="form-select position-relative" name="banque_client"
                aria-label="Default select example" required>
<option value="null">Selectionner une banque</option>
<option value="Bank of Africa Bénin">Bank of Africa Bénin</option>
<option value="Banque internationale du Bénin">Banque internationale du Bénin</option>
<option value="Banque de l'habitat du Bénin">Banque de l'habitat du Bénin</option>
<option value="Ecobank">Ecobank</option>
<option value="Orabank Bénin">Orabank Bénin</option>
<option value="United Bank of Africa">United Bank of Africa</option>
<option value="Diamond Bank">Diamond Bank</option>
<option value="Société générale de banques du Bénin">Société générale de banques du Bénin</option>
<option value="Banque Sahélo-Saharienne pour l’Investissement et le Commerce">Banque Sahélo-Saharienne pour l’Investissement et le Commerce</option>
<option value="Banque atlantique du Bénin">Banque atlantique du Bénin</option>
<option value="BGFIBank Bénin">BGFIBank Bénin</option>
<option value="Afriland first bank benin">Afriland first bank benin</option>
<option value="Banque Africaine pour l'Investissement et le Commerce (BAIC)">Banque Africaine pour l'Investissement et le Commerce (BAIC)</option>
<option value="CBAO surcusale Attijariwafa Bank">CBAO surcusale Attijariwafa Bank</option>
<option value="Coris-Bank Bénin">Coris-Bank Bénin</option>




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

    @section('script')

    <!-- Votre script JavaScript -->
{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    const input = document.querySelector("#phone");
    input.intlTelInput({
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
});
    

});

</script>
 --}}

 <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const input = document.querySelector("#phone");
    const iti = window.intlTelInput(input, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
    const countryData = iti.getSelectedCountryData();
const name = countryData['name'];
console.value=name;
});
</script>
    @endsection
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>


@endsection
