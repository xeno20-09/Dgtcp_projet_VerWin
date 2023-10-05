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
             aria-label="Default select example" id="type" onchange="toggleFields()" name="type_prs" required>
                <option value="null">Personne?</option>
                <option value="morale">Personne morale</option>
                <option value="physique">Personne physique</option>
             </select>
            </div>
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

                <select class="form-select position-relative" name="nationalite" aria-label="Default select example" >
                    <option value="null">Nationalité</option>
                    <option value="Albanaise">Albanaise (Albanie)</option>
                    <option value="Afghane">Afghane (Afghanistan)</option>
                    <option value="Algérienne">Algérienne (Algérie)</option>
                    <option value="Allemande">Allemande (Allemagne)</option>
                    <option value="Americaine">Americaine (États-Unis)</option>
                    <option value="Andorrane">Andorrane (Andorre)</option>
                    <option value="Angolaise">Angolaise (Angola)</option>
                    <option value="Antiguaise-et-Barbudienne">Antiguaise-et-Barbudienne (Antigua-et-Barbuda)</option>
                    <option value="Argentine">Argentine (Argentine)</option>
                    <option value="Australienne">Australienne (Australie)</option>
                    <option value="Autrichienne">Autrichienne (Autriche)</option>
                    <option value="Azerbaïdjanaise">Azerbaïdjanaise (Azerbaïdjan)</option>
                    <option value="Bahamienne">Bahamienne (Bahamas)</option>
                    <option value="Bahreinienne">Bahreinienne (Bahreïn)</option>
                    <option value="Bangladaise">Bangladaise (Bangladesh)</option>
                    <option value="Barbadienne">Barbadienne (Barbade)</option>
                    <option value="Belge">Belge (Belgique)</option>
                    <option value="Belizienne">Belizienne (Belize)</option>
                    <option value="Béninoise">Béninoise (Bénin)</option>
                    <option value="Bhoutanaise">Bhoutanaise (Bhoutan)</option>
                    <option value="Biélorusse">Biélorusse (Biélorussie)</option>
                    <option value="Birmane">Birmane (Birmanie)</option>
                    <option value="Bissau-Guinéenne">Bissau-Guinéenne (Guinée-Bissau)</option>
                    <option value="Bolivienne">Bolivienne (Bolivie)</option>
                    <option value="Bosnienne">Bosnienne (Bosnie-Herzégovine)</option>
                    <option value="Brésilienne">Brésilienne (Brésil)</option>
                    <option value="Armenienne">Armenienne (Arménie)</option>
                    <option value="Britannique">Britannique (Royaume-Uni)</option>
                    <option value="Brunéienne">Brunéienne (Brunéi)</option>
                    <option value="Bulgare">Bulgare (Bulgarie)</option>
                    <option value="Botswanaise">Botswanaise (Botswana)</option>
                    <option value="Burkinabée">Burkinabée (Burkina)</option>
                    <option value="Burundaise">Burundaise (Burundi)</option>
                    <option value="Cambodgienne">Cambodgienne (Cambodge)</option>
                    <option value="Camerounaise">Camerounaise (Cameroun)</option>
                    <option value="Canadienne">Canadienne (Canada)</option>
                    <option value="Cap-verdienne">Cap-verdienne (Cap-Vert)</option>
                    <option value="Centrafricaine">Centrafricaine (Centrafrique)</option>
                    <option value="Chilienne">Chilienne (Chili)</option>
                    <option value="Chinoise">Chinoise (Chine)</option>
                    <option value="Chypriote">Chypriote (Chypre)</option>
                    <option value="Colombienne">Colombienne (Colombie)</option>
                    <option value="Comorienne">Comorienne (Comores)</option>
                    <option value="Congolaise">Congolaise (Congo-Brazzaville)</option>
                    <option value="Congolaise">Congolaise (Congo-Kinshasa)</option>
                    <option value="Cookienne">Cookienne (Îles Cook)</option>
                    <option value="Costaricaine">Costaricaine (Costa Rica)</option>
                    <option value="Croate">Croate (Croatie)</option>
                    <option value="Cubaine">Cubaine (Cuba)</option>
                    <option value="Danoise">Danoise (Danemark)</option>
                    <option value="Djiboutienne">Djiboutienne (Djibouti)</option>
                    <option value="Dominicaine">Dominicaine (République dominicaine)</option>
                    <option value="Dominiquaise">Dominiquaise (Dominique)</option>
                    <option value="Égyptienne">Égyptienne (Égypte)</option>
                    <option value="Émirienne">Émirienne (Émirats arabes unis)</option>
                    <option value="Équato-guineenne">Équato-guineenne (Guinée équatoriale)</option>
                    <option value="Équatorienne">Équatorienne (Équateur)</option>
                    <option value="Érythréenne">Érythréenne (Érythrée)</option>
                    <option value="Espagnole">Espagnole (Espagne)</option>
                    <option value="Est-timoraise">Est-timoraise (Timor-Leste)</option>
                    <option value="Estonienne">Estonienne (Estonie)</option>
                    <option value="Éthiopienne">Éthiopienne (Éthiopie)</option>
                    <option value="Fidjienne">Fidjienne (Fidji)</option>
                    <option value="Finlandaise">Finlandaise (Finlande)</option>
                    <option value="Française">Française (France)</option>
                    <option value="Gabonaise">Gabonaise (Gabon)</option>
                    <option value="Gambienne">Gambienne (Gambie)</option>
                    <option value="Georgienne">Georgienne (Géorgie)</option>
                    <option value="Ghanéenne">Ghanéenne (Ghana)</option>
                    <option value="Grenadienne">Grenadienne (Grenade)</option>
                    <option value="Guatémaltèque">Guatémaltèque (Guatemala)</option>
                    <option value="Guinéenne">Guinéenne (Guinée)</option>
                    <option value="Guyanienne">Guyanienne (Guyana)</option>
                    <option value="Haïtienne">Haïtienne (Haïti)</option>
                    <option value="Hellénique">Hellénique (Grèce)</option>
                    <option value="Hondurienne">Hondurienne (Honduras)</option>
                    <option value="Hongroise">Hongroise (Hongrie)</option>
                    <option value="Indienne">Indienne (Inde)</option>
                    <option value="Indonésienne">Indonésienne (Indonésie)</option>
                    <option value="Irakienne">Irakienne (Iraq)</option>
                    <option value="Iranienne">Iranienne (Iran)</option>
                    <option value="Irlandaise">Irlandaise (Irlande)</option>
                    <option value="Islandaise">Islandaise (Islande)</option>
                    <option value="Israélienne">Israélienne (Israël)</option>
                    <option value="Italienne">Italienne (Italie)</option>
                    <option value="Ivoirienne">Ivoirienne (Côte d'Ivoire)</option>
                    <option value="Jamaïcaine">Jamaïcaine (Jamaïque)</option>
                    <option value="Japonaise">Japonaise (Japon)</option>
                    <option value="Jordanienne">Jordanienne (Jordanie)</option>
                    <option value="Kazakhstanaise">Kazakhstanaise (Kazakhstan)</option>
                    <option value="Kenyane">Kenyane (Kenya)</option>
                    <option value="Kirghize">Kirghize (Kirghizistan)</option>
                    <option value="Kiribatienne">Kiribatienne (Kiribati)</option>
                    <option value="Kittitienne et Névicienne">Kittitienne et Névicienne (Saint-Christophe-et-Niévès)</option>
                    <option value="Koweïtienne">Koweïtienne (Koweït)</option>
                    <option value="Laotienne">Laotienne (Laos)</option>
                    <option value="Lesothane">Lesothane (Lesotho)</option>
                    <option value="Lettone">Lettone (Lettonie)</option>
                    <option value="Libanaise">Libanaise (Liban)</option>
                    <option value="Libérienne">Libérienne (Libéria)</option>
                    <option value="Libyenne">Libyenne (Libye)</option>
                    <option value="Liechtensteinoise">Liechtensteinoise (Liechtenstein)</option>
                    <option value="Lituanienne">Lituanienne (Lituanie)</option>
                    <option value="Luxembourgeoise">Luxembourgeoise (Luxembourg)</option>
                    <option value="Macédonienne">Macédonienne (Macédoine)</option>
                    <option value="Malaisienne">Malaisienne (Malaisie)</option>
                    <option value="Malawienne">Malawienne (Malawi)</option>
                    <option value="Maldivienne">Maldivienne (Maldives)</option>
                    <option value="Malgache">Malgache (Madagascar)</option>
                    <option value="Maliennes">Maliennes (Mali)</option>
                    <option value="Maltaise">Maltaise (Malte)</option>
                    <option value="Marocaine">Marocaine (Maroc)</option>
                    <option value="Marshallaise">Marshallaise (Îles Marshall)</option>
                    <option value="Mauricienne">Mauricienne (Maurice)</option>
                    <option value="Mauritanienne">Mauritanienne (Mauritanie)</option>
                    <option value="Mexicaine">Mexicaine (Mexique)</option>
                    <option value="Micronésienne">Micronésienne (Micronésie)</option>
                    <option value="Moldave">Moldave (Moldovie)</option>
                    <option value="Monegasque">Monegasque (Monaco)</option>
                    <option value="Mongole">Mongole (Mongolie)</option>
                    <option value="Monténégrine">Monténégrine (Monténégro)</option>
                    <option value="Mozambicaine">Mozambicaine (Mozambique)</option>
                    <option value="Namibienne">Namibienne (Namibie)</option>
                    <option value="Nauruane">Nauruane (Nauru)</option>
                    <option value="Néerlandaise">Néerlandaise (Pays-Bas)</option>
                    <option value="Néo-Zélandaise">Néo-Zélandaise (Nouvelle-Zélande)</option>
                    <option value="Népalaise">Népalaise (Népal)</option>
                    <option value="Nicaraguayenne">Nicaraguayenne (Nicaragua)</option>
                    <option value="Nigériane">Nigériane (Nigéria)</option>
                    <option value="Nigérienne">Nigérienne (Niger)</option>
                    <option value="Niuéenne">Niuéenne (Niue)</option>
                    <option value="Nord-coréenne">Nord-coréenne (Corée du Nord)</option>
                    <option value="Norvégienne">Norvégienne (Norvège)</option>
                    <option value="Omanaise">Omanaise (Oman)</option>
                    <option value="Ougandaise">Ougandaise (Ouganda)</option>
                    <option value="Ouzbéke">Ouzbéke (Ouzbékistan)</option>
                    <option value="Pakistanaise">Pakistanaise (Pakistan)</option>
                    <option value="Palaosienne">Palaosienne (Palaos)</option>
                    <option value="Palestinienne">Palestinienne (Palestine)</option>
                    <option value="Panaméenne">Panaméenne (Panama)</option>
                    <option value="Papouane-Néo-Guinéenne">Papouane-Néo-Guinéenne (Papouasie-Nouvelle-Guinée)</option>
                    <option value="Paraguayenne">Paraguayenne (Paraguay)</option>
                    <option value="Péruvienne">Péruvienne (Pérou)</option>
                    <option value="Philippine">Philippine (Philippines)</option>
                    <option value="Polonaise">Polonaise (Pologne)</option>
                    <option value="Portugaise">Portugaise (Portugal)</option>
                    <option value="Qatarienne">Qatarienne (Qatar)</option>
                    <option value="Roumaine">Roumaine (Roumanie)</option>
                    <option value="Russe">Russe (Russie)</option>
                    <option value="Rwandaise">Rwandaise (Rwanda)</option>
                    <option value="Saint-Lucienne">Saint-Lucienne (Sainte-Lucie)</option>
                    <option value="Saint-Marinaise">Saint-Marinaise (Saint-Marin)</option>
                    <option value="Saint-Vincentaise et Grenadine">Saint-Vincentaise et Grenadine (Saint-Vincent-et-les Grenadines)</option>
                    <option value="Salomonaise">Salomonaise (Îles Salomon)</option>
                    <option value="Salvadorienne">Salvadorienne (Salvador)</option>
                    <option value="Samoane">Samoane (Samoa)</option>
                    <option value="Santoméenne">Santoméenne (Sao Tomé-et-Principe)</option>
                    <option value="Saoudienne">Saoudienne (Arabie saoudite)</option>
                    <option value="Sénégalaise">Sénégalaise (Sénégal)</option>
                    <option value="Serbe">Serbe (Serbie)</option>
                    <option value="Seychelloise">Seychelloise (Seychelles)</option>
                    <option value="Sierra-Léonaise">Sierra-Léonaise (Sierra Leone)</option>
                    <option value="Singapourienne">Singapourienne (Singapour)</option>
                    <option value="Slovaque">Slovaque (Slovaquie)</option>
                    <option value="Slovène">Slovène (Slovénie)</option>
                    <option value="Somalienne">Somalienne (Somalie)</option>
                    <option value="Soudanaise">Soudanaise (Soudan)</option>
                    <option value="Sri-Lankaise">Sri-Lankaise (Sri Lanka)</option>
                    <option value="Sud-Africaine">Sud-Africaine (Afrique du Sud)</option>
                    <option value="Sud-Coréenne">Sud-Coréenne (Corée du Sud)</option>
                    <option value="Sud-Soudanaise">Sud-Soudanaise (Soudan du Sud)</option>
                    <option value="Suédoise">Suédoise (Suède)</option>
                    <option value="Suisse">Suisse (Suisse)</option>
                    <option value="Surinamaise">Surinamaise (Suriname)</option>
                    <option value="Swazie">Swazie (Swaziland)</option>
                    <option value="Syrienne">Syrienne (Syrie)</option>
                    <option value="Tadjike">Tadjike (Tadjikistan)</option>
                    <option value="Tanzanienne">Tanzanienne (Tanzanie)</option>
                    <option value="Tchadienne">Tchadienne (Tchad)</option>
                    <option value="Tchèque">Tchèque (Tchéquie)</option>
                    <option value="Thaïlandaise">Thaïlandaise (Thaïlande)</option>
                    <option value="Togolaise">Togolaise (Togo)</option>
                    <option value="Tonguienne">Tonguienne (Tonga)</option>
                    <option value="Trinidadienne">Trinidadienne (Trinité-et-Tobago)</option>
                    <option value="Tunisienne">Tunisienne (Tunisie)</option>
                    <option value="Turkmène">Turkmène (Turkménistan)</option>
                    <option value="Turque">Turque (Turquie)</option>
                    <option value="Tuvaluane">Tuvaluane (Tuvalu)</option>
                    <option value="Ukrainienne">Ukrainienne (Ukraine)</option>
                    <option value="Uruguayenne">Uruguayenne (Uruguay)</option>
                    <option value="Vanuatuane">Vanuatuane (Vanuatu)</option>
                    <option value="Vaticane">Vaticane (Vatican)</option>
                    <option value="Vénézuélienne">Vénézuélienne (Venezuela)</option>
                    <option value="Vietnamienne">Vietnamienne (Viêt Nam)</option>
                    <option value="Yéménite">Yéménite (Yémen)</option>
                    <option value="Zambienne">Zambienne (Zambie)</option>
                    <option value="Zimbabwéenne">Zimbabwéenne (Zimbabwe)</option>
                </select>
                
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
                    <option value="null">Selectionner une devise</option>
                    <option value="Euro">Euro</option>
                    <option value="Dollar us">Dollar us</option>
                    <option value="Yen japonais">Yen japonais</option>
                    <option value="Livre sterling">Livre sterling</option>
                    <option value="Franc suisse">Franc suisse</option>
                    <option value="Dollar canadien">Dollar canadien</option>
                    <option value="Yuan chinois">Yuan chinois</option>
                    <option value="Dirham Emirats Arabes Unis">Dirham Emirats Arabes Unis</option>    
                </select> --}}

                <select style="top: 0px;" class="form-select position-relative" name='currency_from'
                aria-label="Default select example" onchange="valeur_p()"id='currency_from_p' required>
                <option value="null">Selectionner une devise</option>
                @foreach ($listedevis as $name )
                <option value="{{$name->nom}}">{{$name->nom}}</option>
                @endforeach

                </select>
            </div>
        </div>
        <script>
     
        </script>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Montant </label>
                <input name="montant_in" type="number" class="form-control" id="" placeholder="Montant ">
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
                <input name="mont_fcfa" type="text" class="form-control"  placeholder="Contre montant" readonly>
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
         <input id="phone" type="tel" name="tel_client" class="form-control" style=""  placeholder="TelClient">


            </div>
        </div>
 
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Banque</label>
                <select style="top: 0px;" class="form-select position-relative" name="banque_client"
                aria-label="Default select example" required>
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
                <option value="null">Selectionner une banque</option>
            </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Numéro de compte</label>
                <input name="num_compt_client" type="text" class="form-control"
                    id="" placeholder="Numéro de compte">
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
                <input name="boite" type="text" class="form-control" id=""
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
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Montant </label>
                <input name="montant_in" type="number" class="form-control" id="" placeholder="Montant ">
            </div>
        </div>

 

        <div class="col"id="valeur_m">
            <div class="form-group">
                <label for="" class="form-label mt-4">Valeur </label>
                <input name="valeur" type="text" class="form-control"  placeholder="Valeur" readonly>
            </div>
        </div>
        <div class="col"id="mont_fcfa_m">
            <div class="form-group">
                <label for="" class="form-label mt-4">Contre montant </label>
                <input name="mont_fcfa" type="text" class="form-control"  placeholder="Contre montant" readonly>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Nom </label>
                <input name="nomsociete" type="text" class="form-control" id="nom" placeholder="Nom societe">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Catégorie</label>
                <input name="categorie" type="text" class="form-control" id="prenom"
                    placeholder="Catégorie">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Adresse</label>
                <input name="adresse" type="text" class="form-control" id=""
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
         <input id="phone" type="tel" name="tel_client" class="form-control" style=""  placeholder="TelClient">


            </div>
        </div>
      
 
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Banque</label>
                <select style="top: 0px;" class="form-select position-relative" name="banque_client"
                aria-label="Default select example" required>
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
                <option value="null">Selectionner une banque</option>
            </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="" class="form-label mt-4">Numéro de compte</label>
                <input name="num_compt_client" type="text" class="form-control"
                    id="" placeholder="Numéro de compte">
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
            var societe = document.getElementById('morale');
            var particulier = document.getElementById('physique');

            if (type === 'morale') {
                societe.style.display = 'block';
                particulier.style.display = 'none';
            } else if (type === 'physique') {
                societe.style.display = 'none';
                particulier.style.display = 'block';
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
    $(document).ready(function() {
        $('#currency_from_p').on('change', function() {
            var monnaie = $(this).val();
            if (monnaie !== 'null') {
                $.ajax({
                    type: 'POST',
                    route: '/get-devis',
                    data: { monnaie: monnaie },
                    success: function(data) {
                        $('#val').val(data.valeur);
                    },
                    error: function(response) {
                        $('#val').val('Erreur : devise introuvable.');
                    },

                });
            } else {
                $('#val').val('');
            }
        });
    });
</script>
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
/*         var nombre2 = parseFloat(document.getElementById('nombre2').value) || 0;
        
        // Calcul de la multiplication des deux nombres.
        var resultat = nombre1 * nombre2;
        
        // Mise à jour du champ Résultat avec le résultat de la multiplication.
        document.getElementById('resultat').value = resultat; */
    }
    valeur_p();
     </script>
          <script>

            function valeur_m() {
                    // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
                    var devise = document.getElementById('currency_from_m').value ;
                    var valeur = document.getElementById('valeur_m') ;
                    var mont_fcfa=document.getElementById('mont_fcfa_m');
                    if(devise!="null"){
                        valeur.style.display = 'block';
                        mont_fcfa.style.display='block';
                    }
                    else{
                        valeur.style.display = 'none';
                        mont_fcfa.style.display='none';
            
                    }
            /*         var nombre2 = parseFloat(document.getElementById('nombre2').value) || 0;
                    
                    // Calcul de la multiplication des deux nombres.
                    var resultat = nombre1 * nombre2;
                    
                    // Mise à jour du champ Résultat avec le résultat de la multiplication.
                    document.getElementById('resultat').value = resultat; */
                }
                valeur_m();
                 </script>
@endsection
