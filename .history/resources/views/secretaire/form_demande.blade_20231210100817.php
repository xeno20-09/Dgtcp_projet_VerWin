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

            @csrf
    @endforeach
    <div class="row">
      {{--   @foreach ($user as $item)
            <legend>Bureau du {{ $item->poste }} </legend>
        @endforeach --}}
        <legend>Enregistrement d'une demande</legend>


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
             aria-label="Default select example" id="type" onchange="toggleFields()" name="type_prs" required>
                <option value="null">Personne?</option>
                <option value="morale">Personne morale</option>
                <option value="physique">Personne physique</option>
             </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">IFU</label>
                <input name="ifu" type="texte" value="" class="form-control" id="ifu"
                    aria-describedby="" placeholder=""  maxlength="13" minlength="12" onchange="infopers()"  required>

            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">N° enregistrement</label>
                <input name="num_save" type="texte" value="" class="form-control" id=""
                    aria-describedby="" placeholder="">

            </div>
        </div>

        <div id="boss" style="">
<input type="text" id="val0" style="">
        </div>
    </div>
   
<div id="physique">

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nature des opérations</label>
                <input name="nature_op" type="text" class="form-control" id=""
                    placeholder="Nature des opérations">

            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nature des produits</label>
                <input name="nature_pro" type="text" class="form-control" id=""
                    placeholder="Nature des produits">

            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nationalité</label>
                <input name="nationalite" type="text" class="form-control" id="nationalite_id_p"
                placeholder="Nationalité">
           
                
            </div>
        </div>

        
    </div>

    <div class="row">

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Devise </label>
            {{--     <select style="top: 0px;" class="form-select position-relative" name='currency_from'
                    aria-label="Default select example" onchange="valeur_p()"id='currency_from_p' required>
                    <option value="" @if (Request::get('currency_to') == null) selected @endif>Select Currency</option>
                    <option value="AUD" @if (Request::get('currency_to') == 'AUD') selected @endif>Australia Dollar</option>
                    <option value="EUR" @if (Request::get('currency_to') == 'EUR') selected @endif>Euro</option>
                    <option value="GBP" @if (Request::get('currency_to') == 'GBP') selected @endif>Great Britain Pound</option>
                    <option value="INR" @if (Request::get('currency_to') == 'INR') selected @endif>India Rupee</option>
                    <option value="USD" @if (Request::get('currency_to') == 'USD') selected @endif>USA Dollar</option>
                     
                </select> --}}

                <select style="top: 0px;" class="form-select position-relative" name='currency_from'
                aria-label="Default select example" onchange="valeur_p()"id='currency_from_p' required>
                <option value="null">Selectionner une devise</option>
            {{--  @foreach ($listedevis as $name )
             <option value="{{ $name->nom }}">{{ $name->nom }}</option>
             @endforeach  --}}
               <option value="Euro">Euro</option>
                <option value="Dollar des États-Unis">Dollar us</option>
                <option value="Yen japonais">Yen japonais</option>
                <option value="Livre sterling">Livre sterling</option>
                <option value="Dollar canadien">Dollar canadien</option>
                <option value="Yuan chinois">Yuan chinois</option>
                <option value="Dirham des Émirats arabes unis">Dirham Emirats Arabes Unis</option>  
                <option value="Dinar algérien">Dinar algérien</option> 
                <option value="Livre égyptienne">Livre égyptienne</option>
                <option value="Cedi ghanéen">Cedi ghanéen</option>
                <option value="Franc guinéen">Franc guinéen</option>
                <option value="Quetzal guatémaltèque">Quetzal guatémaltèque</option>
                <option value="Naira nigérian">Naira nigérian</option>
                <option value="Dollar néo-zélandais">Dollar néo-zélandais</option>
                <option value="Franc rwandais">Franc rwandais</option>
                <option value="Riyal saoudien">Riyal saoudien</option>
                <option value="Franc CFA d'Afrique centrale">Franc CFA d'Afrique centrale</option>
                </select>
            </div>
        </div>
   
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
                <input name="nom_client" type="text" class="form-control" id="nom_id_p" placeholder="Nom client">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Prenom client</label>
                <input name="prenom_client" type="text" class="form-control" id="prenom_id_p"
                    placeholder="Prenom client">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Profession client</label>
                <input name="profess_client" type="text" class="form-control" id="profess_id_p"
                    placeholder="ProfClient">
            </div>
        </div>
    </div>

    <div class="row">


      
        <div class="col">
            <div class="form-group" style="position: relative;top: 15px;">
                <label for="" class="form-label mt-4">Telephone client</label>

         <input id="tel_id_p" type="tel" name="tel_client" class="form-control" style=""  placeholder="TelClient">


            </div>
        </div>
 
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Banque</label>
                <input id="banque_id_p" type="texte" name="banque" class="form-control" style=""  placeholder="Banque">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Numéro de compte</label>
                <input name="num_compt_client" type="text" class="form-control"
                    id="num_compt_id_p" placeholder="Numéro de compte">
            </div>
        </div>

    </div>

</div>
 

<div id="morale">
    
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nature des opérations</label>
                <input name="nature_op" type="text" class="form-control" id=""
                    placeholder="Nature des opérations">

            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nature des produits</label>
                <input name="nature_pro" type="text" class="form-control" id=""
                    placeholder="Nature des produits">

            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Boite postale</label>
                <input name="boite" type="text" class="form-control" id="boite_id_m"
                    placeholder="Boite postale">
               
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Devises</label>

                <select style="top: 0px;" id="currency_from_m" class="form-select position-relative" name='currency_from'
                    aria-label="Default select example" onchange="valeur_m()" required>
           {{--          <option value="" @if (Request::get('currency_to') == null) selected @endif>Select Currency</option>
                    <option value="AUD" @if (Request::get('currency_to') == 'AUD') selected @endif>Australia Dollar</option>
                    <option value="EUR" @if (Request::get('currency_to') == 'EUR') selected @endif>Euro</option>
                    <option value="GBP" @if (Request::get('currency_to') == 'GBP') selected @endif>Great Britain Pound</option>
                    <option value="INR" @if (Request::get('currency_to') == 'INR') selected @endif>India Rupee</option>
                    <option value="USD" @if (Request::get('currency_to') == 'USD') selected @endif>USA Dollar</option> --}}
                    <option value="Euro">Euro</option>
                    <option value="Dollar des États-Unis">Dollar us</option>
                    <option value="Yen japonais">Yen japonais</option>
                    <option value="Livre sterling">Livre sterling</option>
                    <option value="Dollar canadien">Dollar canadien</option>
                    <option value="Yuan chinois">Yuan chinois</option>
                    <option value="Dirham des Émirats arabes unis">Dirham Emirats Arabes Unis</option>  
                    <option value="Dinar algérien">Dinar algérien</option> 
                    <option value="Livre égyptienne">Livre égyptienne</option>
                    <option value="Cedi ghanéen">Cedi ghanéen</option>
                    <option value="Franc guinéen">Franc guinéen</option>
                    <option value="Quetzal guatémaltèque">Quetzal guatémaltèque</option>
                    <option value="Naira nigérian">Naira nigérian</option>
                    <option value="Dollar néo-zélandais">Dollar néo-zélandais</option>
                    <option value="Franc rwandais">Franc rwandais</option>
                    <option value="Riyal saoudien">Riyal saoudien</option>
                    <option value="Franc CFA d'Afrique centrale">Franc CFA d'Afrique centrale</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Montant </label>
                <input name="montant_in" type="number" class="form-control" oninput="test1()" id="montant_in_m" placeholder="Montant ">
            </div>
        </div>

 

        <div class="col"id="valeur_m">
            <div class="form-group">
                <label for="" class="form-label mt-4">Valeur </label>
                <input name="valeur" type="text" class="form-control" id="val1"  placeholder="Valeur" readonly>
            </div>
        </div>
        <div class="col"id="mont_fcfa_m">
            <div class="form-group">
                <label for="" class="form-label mt-4">Contre montant </label>
                <input name="mont_fcfa" type="text" class="form-control" id="montant_fcfa_m"  placeholder="Contre montant" readonly>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nom </label>
                <input name="nomsociete" type="text" class="form-control" id="nom_id_m" placeholder="Nom societe">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Catégorie</label>
                <input name="categorie" type="text" class="form-control" id="categorie_id_m"
                    placeholder="Catégorie">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Adresse</label>
                <input name="adresse" type="text" class="form-control" id="adresse_id_m"
                    placeholder="Adresse">
            </div>
        </div>
    </div>

    <div class="row">
  {{--      <div class="col">
            <div class="form-group" style="position: relative;top: 15px;">
                   <p>Entrez votre numéro de téléphone:</p>
         <input id="phone" type="tel" name="tel_client" class="form-control" style=""  placeholder="TelClient">
         <input type='hidden' name='codecountry'id="codecountry" value="">
         <input type='hidden' name='namcountry'id="namcountry" value="">

            </div>
        </div> --}}
      
        <div class="col">
            <div class="form-group" style="position: relative;top: 15px;">
                   <p>Entrez votre numéro de téléphone:</p>
         <input id="tel_id_m" type="tel" name="tel_client" class="form-control" style=""  placeholder="TelClient">


            </div>
        </div>
      
 
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Banque</label>
                <input id="banque_id_m" type="texte" name="banque" class="form-control" style=""  placeholder="Banque">

            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Numéro de compte</label>
                <input name="num_compt_client" type="text" class="form-control"
                    id="num_compt_id_m" placeholder="Numéro de compte">
            </div>
        </div>

    </div>

</div>
    
    <br>
    @section('script')
{{--     <script src="{{ asset('js/intlTelInput.js') }}"></script>
    <script src="{{ asset('js/international-telephone-input.js') }}"></script> --}}

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
        var letype=document.getElementById('type');
        var societe = document.getElementById('morale');
        var particulier = document.getElementById('physique');

     if (type === 'morale') {
            societe.style.display = 'block';
            particulier.style.display = 'none';
/*             particulier.innerHTML="";
 */              while (particulier.firstChild) {
    particulier.removeChild(particulier.firstChild);

}   
} 
        else if (type === 'physique') {
            societe.style.display = 'none';
            particulier.style.display = 'block';
/*             societe.innerHTML="";

 */      while (societe.firstChild) {
    societe.removeChild(societe.firstChild);
}
 } else {
            societe.style.display = 'none';
            particulier.style.display = 'none';
        }
    }

    // Appeler toggleFields() lors du chargement initial pour cacher les champs appropriés.
    toggleFields();

</script>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    function valeur_p() {
            // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
            var devise = document.getElementById('currency_from_p').value ;
            var valeur = document.getElementById('valeur_p') ;
            var mont_fcfa=document.getElementById('mont_fcfa_p');
    
            if(devise!="null"){
                
                valeur.style.display = 'block';
                mont_fcfa.style.display='block';
       
            }
            if(devise=="null"){
                valeur.style.display = 'none';
                mont_fcfa.style.display='none';
    
            }
   
        }
        valeur_p();
         </script>



<script>
    $(document).ready(function() {
        $('#currency_from_p').on('change', function() {
            var monnaie =document.getElementById('currency_from_p').value;
          //  console.log(monnaie);

            if (monnaie !== 'null') {
                $.ajax({
    type: 'POST',
    url: '/get-devis',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
        monnaie: monnaie,
    },
    dataType:'JSON',
    
    success: function(data) {
        $('#val').val(data.val);
    },
    error: function(response) {
        $('#val').val('Erreur : devise introuvable.');
    },
});

            } 
        });
    });


</script>




<script>

    function test() {
            // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
            var montant = document.getElementById('montant_in').value || 0;
            var valeur = document.getElementById('val').value || 0 ;
    
            
            // Calcul de la multiplication des deux nombres.
            var resultat = montant * valeur;
            console.log (valeur);
            // Mise à jour du champ Résultat avec le résultat de la multiplication.
            document.getElementById('montant_fcfa').value = resultat;
        }
        test();
         </script>



          <script>


            function valeur_m() {
                    // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
                    var devise = document.getElementById('currency_from_m').value ;
                    var valeur = document.getElementById('valeur_m') ;
                    var mont_fcfa=document.getElementById('mont_fcfa_m');

                    var monnaie =document.getElementById('currency_from_m').value;
                            //console.log(monnaie);
                
                            if (monnaie !== 'null') {
                                $.ajax({
                    type: 'POST',
                    url: '/get-devis',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        monnaie: monnaie,
                    },
                    dataType:'JSON',
                    
                    success: function(data) {
                        $('#val1').val(data.val);
                    },
                    error: function(response) {
                        $('#val1').val('Erreur : devise introuvable.');
                    },
                });
                
                            } 
                    if(devise!="null"){
                        valeur.style.display = 'block';
                        mont_fcfa.style.display='block';

                        
                    }
                    else{
                        valeur.style.display = 'none';
                        mont_fcfa.style.display='none';
            
                    }

                }
                valeur_m();
                 </script>



                 <script>
                    function infopers() {
                

                    var ifutake =document.getElementById('ifu').value;
                    var num_compt_id_p =document.getElementById('num_compt_id_p').value;
                    var banque_id_p =document.getElementById('banque_id_p').value;
                    var tel_id_p =document.getElementById('tel_id_p').value;
                    var adresse_id_p =document.getElementById('adresse_id_p').value;
                    var categorie_id_p =document.getElementById('categorie_id_p').value;
                    var nom_id_p =document.getElementById('nom_id_p').value;
                    var prenom_id_p =document.getElementById('prenom_id_p').value;
                    var boite_id_p =document.getElementById('boite_id_p').value;
                    var profess_id_p =document.getElementById('profess_id_p').value;
                    var nationalite_id_p =document.getElementById('nationalite_id_p').value;
                   
                    var num_compt_id_m = document.getElementById('num_compt_id_m').value;
    var banque_id_m = document.getElementById('banque_id_m').value;
    var tel_id_m = document.getElementById('tel_id_m').value;
var adresse_id_m = document.getElementById('adresse_id_m').value;
var categorie_id_m = document.getElementById('categorie_id_m').value;
var nom_id_m = document.getElementById('nom_id_m').value;
var boite_id_m = document.getElementById('boite_id_m').value;


                    var val =document.getElementById('boss');


                
                            if (ifutake !== 'null') {
                                $.ajax({
                    type: 'POST',
                    url: '/get-info',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ifutake: ifutake,
                    },
                    "id": 1,
        "num_ifu": "4874237221782",
        "": "619-302-8757",
        "": "13128 Camden Mission\nNew Natashaport, IA 40023-0239",
        "": "23779-0231",
        "nom": "Quitzon",
        "prenom": "Talia",
        "email": "giuseppe01@rosenbaum.info",
        "banque": "Banque de l'habitat du B\u00e9nin",
        "profess": "Order Filler",
        "type_prs": "Physique",
        "nationalite": "Turkmenistan",
        "num_compt": "874545821532",
        "date_birth": "Thu-01-70",
        "created_at": "2023-12-08T14:48:46.000000Z",
        "updated_at": "2023-12-08T14:48:46.000000Z"
    }
                    dataType:'JSON',
                    success: function(info) {
                        $('#val0').val(info.val0.nom);
                        $('#num_compt_id_p').val(info.val0.num_compt);
                        $('#val0').val(info.val0.tel);
                        $('#val0').val(info.val0.adresse);
                        $('#val0').val(info.val0.boite);
                        $('#val0').val(info.val0.nom);
                        $('#val0').val(info.val0.prenom);
                        $('#val0').val(info.val0.email);
                        $('#val0').val(info.val0.banque);
                        $('#val0').val(info.val0.profess);
                        $('#val0').val(info.val0.nom);
                        $('#val0').val(info.val0.nom);
                        $('#val0').val(info.val0.nom);
                        $('#val0').val(info.val0.nom);
                        $('#val0').val(info.val0.nom);














                       console.log(info);
                       val.style.display = 'block';

                    },
                    error: function(response) {
                        $('#val0').val('Introuvable');
                    },
                });
                            } 
            
  
                }
                infopers();
                 </script>
    <script>

        function test1() {
                // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
                var montant = document.getElementById('montant_in_m').value || 0;
                var valeur = document.getElementById('val1').value || 0 ;
   
                
                // Calcul de la multiplication des deux nombres.
                var resultat = montant * valeur;
                console.log (valeur);
                // Mise à jour du champ Résultat avec le résultat de la multiplication.
                document.getElementById('montant_fcfa_m').value = resultat;
            }
            test1();
             </script>

@endsection
