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
                                id="" aria-describedby="" placeholder=""readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nature des opérations</label>

                            <input value="{{ $item_c->nature_op }}" name="nature_op" type="text" class="form-control"
                                id="" placeholder="Nature des opérations"readonly>

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nature des produits</label>

                            <input value="{{ $item_c->nature_p }}" name="nature_pro" type="text" class="form-control"
                                id="" placeholder="Nature des produits"readonly>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Devise </label>
                            <input value="{{ $item_c->devise }}" name="currency_from" type="text" class="form-control"
                                id="" placeholder=""readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Montant </label>
                            <input value="{{ $item_c->montant }}" name="montant_in" type="number" class="form-control"
                                id="" placeholder="Montant en Francs"readonly>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Montant en Francs</label>
                            <input value="{{ $item_c->montant_con }}" name="montant_out" type="number" class="form-control"
                                id="" placeholder="Montant converti"readonly>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Nom client</label>
                            <input value="{{ $item_c->nom_client }}" name="nom_client" type="text" class="form-control"
                                id="" placeholder="Nom client"readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Prenom client</label>
                            <input value="{{ $item_c->prenom_client }}" name="prenom_client" type="text"
                                class="form-control" id="" placeholder="Prenom client"readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Telephone client</label>
                            <input value="{{ $item_c->tel_client }}" name="tel_client" type="text"
                                class="form-control" id="" placeholder="TelClient"readonly>
                        </div>
                    </div>

                </div>

                <div class="row">



                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Banque</label>
                            <input value="{{ $item_c->banque_client }}" name="banque_client" type="text"
                                class="form-control" id="" placeholder="Banque"readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Profession client</label>
                            <input value="{{ $item_c->profess_client }}" name="profess_client" type="text"
                                class="form-control" id="" placeholder="ProfClient"readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Numéro de compte</label>
                            <input value="{{ $item_c->num_compt_client }}" name="num_compt_client" type="text"
                                class="form-control" id="" placeholder="Numéro de compte"readonly>
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
                                placeholder="Nom du beneficiaire" value="{{ $item_c->nom_benefi }}">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Prenom du beneficiaire</label>
                            <input name="prenom_benifi" type="text" class="form-control" id=""
                                placeholder="Prenom du beneficiaire" value="{{ $item_c->prenom_benefi }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Profession du beneficiaire</label>
                            <input name="profess_benifi" type="text" class="form-control" id=""
                                placeholder="Profession du beneficiaire"value="{{ $item_c->profess_benefi }}">
                        </div>
                    </div>

                </div>


                <div class="row">

                    @if (  $item_c->pays_benifi!=0)
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Pays benificiaire</label>
                            <select name="pays_benifi" class="form-select position-relative" data-flag="true">
                            <option value="{{ $item_c->pays_benifi }}" selected>{{ $item_c->pays_benifi }}</option>
                            <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antarctica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote d'Ivoire">Cote d'Ivoire</option>
<option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="France, Metropolitan">France, Metropolitan</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
<option value="Korea, Republic of">Korea, Republic of</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
<option value="Moldova, Republic of">Moldova, Republic of</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Netherlands Antilles">Netherlands Antilles</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russian Federation">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
<option value="Saint Lucia">Saint LUCIA</option>
<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="St. Helena">St. Helena</option>
<option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Taiwan, Province of China">Taiwan, Province of China</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Viet Nam">Viet Nam</option>
<option value="Virgin Islands (British)">Virgin Islands (British)</option>
<option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
<option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Yugoslavia">Yugoslavia</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
                        </div>
                    </div>
                    
                    @else
                    
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="form-label mt-4">Pays benificiaire</label>
                            <select name="pays_benifi" class="form-select position-relative" data-flag="true">
                                <option value="  " selected>Select a country</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor">East Timor</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="France, Metropolitan">France, Metropolitan</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint LUCIA</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="St. Helena">St. Helena</option>
                                <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Yugoslavia">Yugoslavia</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                                
                        </select>
                        </div>
                    </div>
                    
                    @endif
                 
                 @if ( $item_c->banque_benefi !=0)
                 <div class="col">
                    <div class="form-group">
                        <label for="" class="form-label mt-4">Banque beneficiaire</label>
                        <input name="banque_benifi" type="text" class="form-control" id=""
                            placeholder="Banque" value="{{ $item_c->banque_benefi }}">

                            <select style="top: 0px;" class="form-select position-relative" name="banque_benifi"
                            aria-label="Default select example" required>
            <option value="{{ $item_c->banque_benefi }}">{{ $item_c->banque_benefi }}</option>
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
                 @else
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

                     
                 @endif
                   
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