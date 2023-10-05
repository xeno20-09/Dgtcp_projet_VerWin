@extends('layout.secretaire.header')
@section('content')
    <h1 style="text-align: center;">
        @foreach ($user as $item)
            <a class="nav-link" href="#"> Mr/Mrs {{ $item['firstname'] }} {{ $item['lastname'] }} <span class="badge rounded-pill badge-notification bg-danger"
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
                <label for="" class="form-label mt-4">Type personne</label>
             <select name="type"  class="form-select position-relative"
             aria-label="Default select example" id="type" onchange="toggleFields()" required>
                <option value="null">Personne?</option>
                <option value="morale">Personne morale</option>
                <option value="physique">Personne physique</option>
             </select>
            </div>
        </div>

    </div>


    
    
    <br>
    @section('script')
    <script src="{{ asset('js/intlTelInput.js') }}"></script>
    <script src="{{ asset('js/international-telephone-input.js') }}"></script>

{{--     <script>
        var input =document.querySelector("#phone")
    window.intlTelInput(input,{
        utilsScript: "/intl-tel-input/js/utils.js?1695806485509"
    });     
    </script> --}}


        @endsection

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

    <script>
     

            function toggleFields() {
            var type = document.getElementById('type').value;
            var nomSociete = document.getElementById('nom');
            var nomPrenom = document.getElementById('prenom');

            if (type === 'morale') {
                nomSociete.style.display = 'block';
                nomPrenom.style.display = 'none';
            } else if (type === 'physique') {
                nomSociete.style.display = 'none';
                nomPrenom.style.display = 'block';
            } else {
                nomSociete.style.display = 'none';
                nomPrenom.style.display = 'none';
            }
        }

        // Appeler toggleFields() lors du chargement initial pour cacher les champs appropriés.
        toggleFields();
  
    </script>
@endsection
