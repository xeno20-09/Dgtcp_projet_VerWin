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


            <form action="{{ url('FormulaireSave_verificateur', $item_c->id) }}" method="Post"
                class="card-body cardbody-color p-lg-5" enctype="multipart/form-data">

                @csrf


                <div class="row">
                    <legend>Checker l'enregistrement</legend>
                    <hr>


                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Date de dépôt du dossier</label>
                            <input value="{{ $item_c->date }}" name="date_depot" type="date" class="form-control"
                                id="" aria-describedby="" placeholder="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nature des opérations</label>

                            <input value="{{ $item_c->nature_op }}" name="nature_op" type="text" class="form-control"
                                id="" placeholder="Nature des opérations">

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nature des produits</label>

                            <input value="{{ $item_c->nature_p }}" name="nature_pro" type="text" class="form-control"
                                id="" placeholder="Nature des produits">

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Devise </label>
                            <input value="{{ $item_c->devise }}" name="currency_from" type="text" class="form-control"
                                id="" placeholder="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Montant </label>
                            <input value="{{ $item_c->montant }}" name="montant_in" type="number" class="form-control"
                                id="" placeholder="Montant en Francs">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Montant en Francs</label>
                            <input value="{{ $item_c->montant_con }}" name="montant_out" type="number" class="form-control"
                                id="" placeholder="Montant converti">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nom client</label>
                            <input value="{{ $item_c->nom_client }}" name="nom_client" type="text" class="form-control"
                                id="" placeholder="Nom client">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Prenom client</label>
                            <input value="{{ $item_c->prenom_client }}" name="prenom_client" type="text"
                                class="form-control" id="" placeholder="Prenom client">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Telephone client</label>
                            <input value="{{ $item_c->tel_client }}" name="tel_client" type="text"
                                class="form-control" id="" placeholder="TelClient">
                        </div>
                    </div>

                </div>

                <div class="row">



                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Banque</label>
                            <input value="{{ $item_c->banque_client }}" name="banque_client" type="text"
                                class="form-control" id="" placeholder="Banque">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Profession client</label>
                            <input value="{{ $item_c->profess_client }}" name="profess_client" type="text"
                                class="form-control" id="" placeholder="ProfClient">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Numéro de compte</label>
                            <input value="{{ $item_c->num_compt_client }}" name="num_compt_client" type="text"
                                class="form-control" id="" placeholder="Numéro de compte">
                        </div>
                    </div>
                </div>



                <br><br>
                <legend>Saisir d'une demande</legend>
                <hr>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nom du beneficiaire</label>
                            <input name="nom_benifi" type="text" class="form-control" id=""
                                placeholder="Nom du beneficiaire">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Prenom du beneficiaire</label>
                            <input name="prenom_benifi" type="text" class="form-control" id=""
                                placeholder="Prenom du beneficiaire">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Profession du beneficiaire</label>
                            <input name="profess_benifi" type="text" class="form-control" id=""
                                placeholder="Profession du beneficiaire">
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Pays benificiaire</label>
                            <input name="pays_benifi" type="text" class="form-control" id=""
                                placeholder="PaysClient">
                        </div>
                    </div>
               
                    <select class="form-control" id="country" name="country">
                        @foreach ($countries as $country)
                            <option value="{{ $country['code'] }}">
                                <img src="{{ asset('path/imag/flags/' . $country['code'] . '.png') }}" alt="{{ $country['name'] }}" width="20" height="15">
                                {{ $country['name'] }}
                            </option>
                        @endforeach
                    </select>

                    <select class="selectpicker countrypicker" data-flag="true">
        <option value="  " selected>Select a country</option>
    <option value="AF">Afghanistan</option>
    <option value="AL">Albania</option>
    <option value="DZ">Algeria</option>
    <option value="AS">American Samoa</option>
    <option value="AD">Andorra</option>
    <option value="AO">Angola</option>
    <option value="AI">Anguilla</option>
    <option value="AQ">Antarctica</option>
    <option value="AG">Antigua and Barbuda</option>
    <option value="AR">Argentina</option>
    <option value="AM">Armenia</option>
    <option value="AW">Aruba</option>
    <option value="AU">Australia</option>
    <option value="AT">Austria</option>
    <option value="AZ">Azerbaijan</option>
    <option value="BS">Bahamas</option>
    <option value="BH">Bahrain</option>
    <option value="BD">Bangladesh</option>
    <option value="BB">Barbados</option>
    <option value="BY">Belarus</option>
    <option value="BE">Belgium</option>
    <option value="BZ">Belize</option>
    <option value="BJ">Benin</option>
    <option value="BM">Bermuda</option>
    <option value="BT">Bhutan</option>
    <option value="BO">Bolivia</option>
    <option value="BA">Bosnia and Herzegowina</option>
    <option value="BW">Botswana</option>
    <option value="BV">Bouvet Island</option>
    <option value="BR">Brazil</option>
    <option value="IO">British Indian Ocean Territory</option>
    <option value="BN">Brunei Darussalam</option>
    <option value="BG">Bulgaria</option>
    <option value="BF">Burkina Faso</option>
    <option value="BI">Burundi</option>
    <option value="KH">Cambodia</option>
    <option value="CM">Cameroon</option>
    <option value="CA">Canada</option>
    <option value="CV">Cape Verde</option>
    <option value="KY">Cayman Islands</option>
    <option value="CF">Central African Republic</option>
    <option value="TD">Chad</option>
    <option value="CL">Chile</option>
    <option value="CN">China</option>
    <option value="CX">Christmas Island</option>
    <option value="CC">Cocos (Keeling) Islands</option>
    <option value="CO">Colombia</option>
    <option value="KM">Comoros</option>
    <option value="CG">Congo</option>
    <option value="CD">Congo, the Democratic Republic of the</option>
    <option value="CK">Cook Islands</option>
    <option value="CR">Costa Rica</option>
    <option value="CI">Cote d'Ivoire</option>
    <option value="HR">Croatia (Hrvatska)</option>
    <option value="CU">Cuba</option>
    <option value="CY">Cyprus</option>
    <option value="CZ">Czech Republic</option>
    <option value="DK">Denmark</option>
    <option value="DJ">Djibouti</option>
    <option value="DM">Dominica</option>
    <option value="DO">Dominican Republic</option>
    <option value="TP">East Timor</option>
    <option value="EC">Ecuador</option>
    <option value="EG">Egypt</option>
    <option value="SV">El Salvador</option>
    <option value="GQ">Equatorial Guinea</option>
    <option value="ER">Eritrea</option>
    <option value="EE">Estonia</option>
    <option value="ET">Ethiopia</option>
    <option value="FK">Falkland Islands (Malvinas)</option>
    <option value="FO">Faroe Islands</option>
    <option value="FJ">Fiji</option>
    <option value="FI">Finland</option>
    <option value="FR">France</option>
    <option value="FX">France, Metropolitan</option>
    <option value="GF">French Guiana</option>
    <option value="PF">French Polynesia</option>
    <option value="TF">French Southern Territories</option>
    <option value="GA">Gabon</option>
    <option value="GM">Gambia</option>
    <option value="GE">Georgia</option>
    <option value="DE">Germany</option>
    <option value="GH">Ghana</option>
    <option value="GI">Gibraltar</option>
    <option value="GR">Greece</option>
    <option value="GL">Greenland</option>
    <option value="GD">Grenada</option>
    <option value="GP">Guadeloupe</option>
    <option value="GU">Guam</option>
    <option value="GT">Guatemala</option>
    <option value="GN">Guinea</option>
    <option value="GW">Guinea-Bissau</option>
    <option value="GY">Guyana</option>
    <option value="HT">Haiti</option>
    <option value="HM">Heard and Mc Donald Islands</option>
    <option value="VA">Holy See (Vatican City State)</option>
    <option value="HN">Honduras</option>
    <option value="HK">Hong Kong</option>
    <option value="HU">Hungary</option>
    <option value="IS">Iceland</option>
    <option value="IN">India</option>
    <option value="ID">Indonesia</option>
    <option value="IR">Iran (Islamic Republic of)</option>
    <option value="IQ">Iraq</option>
    <option value="IE">Ireland</option>
    <option value="IL">Israel</option>
    <option value="IT">Italy</option>
    <option value="JM">Jamaica</option>
    <option value="JP">Japan</option>
    <option value="JO">Jordan</option>
    <option value="KZ">Kazakhstan</option>
    <option value="KE">Kenya</option>
    <option value="KI">Kiribati</option>
    <option value="KP">Korea, Democratic People's Republic of</option>
    <option value="KR">Korea, Republic of</option>
    <option value="KW">Kuwait</option>
    <option value="KG">Kyrgyzstan</option>
    <option value="LA">Lao People's Democratic Republic</option>
    <option value="LV">Latvia</option>
    <option value="LB">Lebanon</option>
    <option value="LS">Lesotho</option>
    <option value="LR">Liberia</option>
    <option value="LY">Libyan Arab Jamahiriya</option>
    <option value="LI">Liechtenstein</option>
    <option value="LT">Lithuania</option>
    <option value="LU">Luxembourg</option>
    <option value="MO">Macau</option>
    <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
    <option value="MG">Madagascar</option>
    <option value="MW">Malawi</option>
    <option value="MY">Malaysia</option>
    <option value="MV">Maldives</option>
    <option value="ML">Mali</option>
    <option value="MT">Malta</option>
    <option value="MH">Marshall Islands</option>
    <option value="MQ">Martinique</option>
    <option value="MR">Mauritania</option>
    <option value="MU">Mauritius</option>
    <option value="YT">Mayotte</option>
    <option value="MX">Mexico</option>
    <option value="FM">Micronesia, Federated States of</option>
    <option value="MD">Moldova, Republic of</option>
    <option value="MC">Monaco</option>
    <option value="MN">Mongolia</option>
    <option value="MS">Montserrat</option>
    <option value="MA">Morocco</option>
    <option value="MZ">Mozambique</option>
    <option value="MM">Myanmar</option>
    <option value="NA">Namibia</option>
    <option value="NR">Nauru</option>
    <option value="NP">Nepal</option>
    <option value="NL">Netherlands</option>
    <option value="AN">Netherlands Antilles</option>
    <option value="NC">New Caledonia</option>
    <option value="NZ">New Zealand</option>
    <option value="NI">Nicaragua</option>
    <option value="NE">Niger</option>
    <option value="NG">Nigeria</option>
    <option value="NU">Niue</option>
    <option value="NF">Norfolk Island</option>
    <option value="MP">Northern Mariana Islands</option>
    <option value="NO">Norway</option>
    <option value="OM">Oman</option>
    <option value="PK">Pakistan</option>
    <option value="PW">Palau</option>
    <option value="PA">Panama</option>
    <option value="PG">Papua New Guinea</option>
    <option value="PY">Paraguay</option>
    <option value="PE">Peru</option>
    <option value="PH">Philippines</option>
    <option value="PN">Pitcairn</option>
    <option value="PL">Poland</option>
    <option value="PT">Portugal</option>
    <option value="PR">Puerto Rico</option>
    <option value="QA">Qatar</option>
    <option value="RE">Reunion</option>
    <option value="RO">Romania</option>
    <option value="RU">Russian Federation</option>
    <option value="RW">Rwanda</option>
    <option value="KN">Saint Kitts and Nevis</option> 
    <option value="LC">Saint LUCIA</option>
    <option value="VC">Saint Vincent and the Grenadines</option>
    <option value="WS">Samoa</option>
    <option value="SM">San Marino</option>
    <option value="ST">Sao Tome and Principe</option> 
    <option value="SA">Saudi Arabia</option>
    <option value="SN">Senegal</option>
    <option value="SC">Seychelles</option>
    <option value="SL">Sierra Leone</option>
    <option value="SG">Singapore</option>
    <option value="SK">Slovakia (Slovak Republic)</option>
    <option value="SI">Slovenia</option>
    <option value="SB">Solomon Islands</option>
    <option value="SO">Somalia</option>
    <option value="ZA">South Africa</option>
    <option value="GS">South Georgia and the South Sandwich Islands</option>
    <option value="ES">Spain</option>
    <option value="LK">Sri Lanka</option>
    <option value="SH">St. Helena</option>
    <option value="PM">St. Pierre and Miquelon</option>
    <option value="SD">Sudan</option>
    <option value="SR">Suriname</option>
    <option value="SJ">Svalbard and Jan Mayen Islands</option>
    <option value="SZ">Swaziland</option>
    <option value="SE">Sweden</option>
    <option value="CH">Switzerland</option>
    <option value="SY">Syrian Arab Republic</option>
    <option value="TW">Taiwan, Province of China</option>
    <option value="TJ">Tajikistan</option>
    <option value="TZ">Tanzania, United Republic of</option>
    <option value="TH">Thailand</option>
    <option value="TG">Togo</option>
    <option value="TK">Tokelau</option>
    <option value="TO">Tonga</option>
    <option value="TT">Trinidad and Tobago</option>
    <option value="TN">Tunisia</option>
    <option value="TR">Turkey</option>
    <option value="TM">Turkmenistan</option>
    <option value="TC">Turks and Caicos Islands</option>
    <option value="TV">Tuvalu</option>
    <option value="UG">Uganda</option>
    <option value="UA">Ukraine</option>
    <option value="AE">United Arab Emirates</option>
    <option value="GB">United Kingdom</option>
    <option value="US">United States</option>
    <option value="UM">United States Minor Outlying Islands</option>
    <option value="UY">Uruguay</option>
    <option value="UZ">Uzbekistan</option>
    <option value="VU">Vanuatu</option>
    <option value="VE">Venezuela</option>
    <option value="VN">Viet Nam</option>
    <option value="VG">Virgin Islands (British)</option>
    <option value="VI">Virgin Islands (U.S.)</option>
    <option value="WF">Wallis and Futuna Islands</option>
    <option value="EH">Western Sahara</option>
    <option value="YE">Yemen</option>
    <option value="YU">Yugoslavia</option>
    <option value="ZM">Zambia</option>
    <option value="ZW">Zimbabwe</option>
</select>
                 
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Banque</label>
                            <select style="top: 0px;" class="form-select position-relative" name="banque_benifi"
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
                            <label for="" class="form-label mt-4">Numéro de compte beneficiaire</label>

                            <input maxlength="12" minlength="12" name="num_compt_benifi" type="number"
                                class="form-control" id="" placeholder="Numéro de compte">

                        </div>
                    </div>


                </div>
                <div id="container" style="  width: 1362px;">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Pieces</label>
                                <input name="pieces_doss[]" type="text" class="form-control" id="pieces" placeholder="pieces">
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Reference piece</label>
                                <input name="ref_doss[]" type="text" class="form-control" id="refs" placeholder="ref pieces">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Montant ligne</label>
                                <input name="montantligne[]" type="number" class="form-control" id="mligne" placeholder="Montant ligne">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Date d'expiration de la piece</label>
                                <input name="exp_pieces[]" value=" " type="date" class="form-control" id="expi" placeholder="date expiration pieces">
                            </div>
                        </div>
                    {{-- </div>
                    <div class="row"> --}}
                      
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label mt-4">Ajouter une autre piece</label>
                                <button  style="position: relative; top: 36px; right: 100px;" type="button" class="btn btn-primary" name="btn1" id="ajouterChamp">+</button>
                            </div>
                        </div>
                        <div class="col" id="retirer">
                            <div class="form-group">
                                <label for="" class="form-label mt-4" id="lretirerChamp">Retirer la piece</label>
                                <button  style="position: relative; top: 36px; right: 100px;" type="button" class="btn btn-danger" name="btn2" id="retirerChamp">-</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <br>


                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
            <a href="{{ route('retour_s', $item_c->id) }}"><button class="btn btn-danger">Retournez la
                    demande au Secretaire </button></a>
        @endforeach


    </div>


    <br>
    <br>
@endsection

<script>
    // Définissez une variable globale pour stocker la valeur de i
    var i = 0;

    document.addEventListener("DOMContentLoaded", function () {
        var boutonRetirer = document.getElementById("retirerChamp");

        var boutonAjouter = document.getElementById("ajouterChamp");

        // Sélectionnez le conteneur des rangées
        var container = document.getElementById("container");
      
        // Ajoutez un gestionnaire d'événement au bouton "Ajouter"
        boutonAjouter.addEventListener("click", function () {
            
            // Incrémente le compteur de clics

            // Clonez la première rangée
            
            var clonedRow = container.querySelector(".row").cloneNode(true);
            
            // Effacez les valeurs des champs clonés
            var inputs = clonedRow.querySelectorAll("input");
            inputs.forEach(function (input) {
                input.value = "";
            });

            // Changez les noms des champs et réinitialisez les valeurs
            var piece = clonedRow.querySelector("#pieces");
            var refs = clonedRow.querySelector("#refs");
            var datex = clonedRow.querySelector("#expi");
            var mligne = clonedRow.querySelector("#mligne");
            var btn1 = clonedRow.querySelector("#retirerChamp");
            var btn2 = clonedRow.querySelector("#ajouterChamp");

            piece.value = "";
            refs.value = "";
            datex.value = "";
            mligne.value = " ";
            piece.name = "pieces_doss[]";
            refs.name = "ref_doss[]";
            datex.name = "exp_pieces[]";
            mligne.name = "montantligne[]";
btn1.name='btn1';
btn2.name='btn2';


                container.appendChild(clonedRow);
       
        });
        boutonRetirer.addEventListener("click", function () {

            var rows = container.querySelectorAll(".row");
                var lastRow = rows[rows.length - 1];
            container.removeChild(lastRow).remove();

        });
    });
</script>