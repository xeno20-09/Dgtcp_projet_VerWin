<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            @foreach ($demande as $item_c)
                <form action="{{ url('FormulaireSave_verificateur', $item_c->id) }}" method="Post"
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
                    <div class="mb-5 row justify-content-center">
                        <div class="col-lg-11 col-12">
                            <div class="card" id="basic-info">
                                <div class="card-header">
                                    <h5>2ème Etape</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <!-- Première partie du formulaire -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Date de dépôt du
                                                    dossier</label>
                                                <input name="date_depot" type="texte" value="{{ $item_c->date }}"
                                                    class="form-control" id="" aria-describedby=""
                                                    placeholder="" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Type personne</label>
                                                <input name="type_prs" type="texte" value="{{ $item_c->type_prs }}"
                                                    class="form-select position-relative" id=""
                                                    aria-describedby="Default select example" placeholder="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">IFU</label>
                                                <input name="ifu" type="texte" value="{{ $ifu }}"
                                                    class="form-control" id="ifu" aria-describedby=""
                                                    maxlength="13" minlength="12" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">N° enregistrement</label>
                                                <input name="num_save" type="texte" value="{{ $item_c->numero_doss }}"
                                                    class="form-control" id="" aria-describedby=""
                                                    placeholder="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($item_c->type_prs == 'physique')
                                        <!-- Section Personne Physique -->
                                        <div id="physique">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nature des
                                                            opérations</label>
                                                        <input name="nature_op" type="text" class="form-control"
                                                            id="" value="{{ $item_c->nature_op }}"
                                                            placeholder="Nature des opérations" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nature des
                                                            produits</label>
                                                        <input name="nature_pro" type="text" class="form-control"
                                                            id="" value="{{ $item_c->nature_p }}"
                                                            placeholder="Nature des produits" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nationalité du
                                                            demandeur</label>
                                                        <input name="nationalite" type="text" class="form-control"
                                                            id="nationalite_id_p" value="{{ $item_c->nationalite }}"
                                                            placeholder="Nationalité" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Devise</label>
                                                        <input name="currency_from" value="{{ $item_c->devise }}"
                                                            type="text" class="form-control" readonly>

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Montant de la
                                                            transaction</label>
                                                        <input name="montant_in" type="number" oninput="test()"
                                                            class="form-control" value="{{ $item_c->montant }}"
                                                            id="montant_in" readonly placeholder="Montant">
                                                    </div>
                                                </div>
                                                <div class="col" id="valeur_p">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Coût de la
                                                            devise</label>
                                                        <input name="valeur" type="text" id="val"
                                                            class="form-control" placeholder="Valeur"
                                                            value="{{ $taux_d }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col" id="mont_fcfa_p">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Contre
                                                            montant</label>
                                                        <input name="mont_fcfa" type="text" class="form-control"
                                                            id="montant_fcfa" value="{{ $item_c->montant_con }}"
                                                            placeholder="Contre montant" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nom du
                                                            demandeur</label>
                                                        <input name="nom_client" type="text" class="form-control"
                                                            id="nom_id_p" value="{{ $item_c->nom_client }}" readonly
                                                            placeholder="Nom client">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Prenom du
                                                            demandeur</label>
                                                        <input name="prenom_client" type="text"
                                                            class="form-control" id="prenom_id_p"
                                                            value="{{ $item_c->prenom_client }}" readonly
                                                            placeholder="Prenom client">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Profession du
                                                            demandeur</label>
                                                        <input name="profess_client" type="text"
                                                            class="form-control" id="profess_id_p"
                                                            value="{{ $item_c->profess_client }}" readonly
                                                            placeholder="ProfClient">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Telephone du
                                                            demandeur</label>
                                                        <input id="tel_id_p" type="tel" name="tel_client"
                                                            class="form-control" value="{{ $item_c->tel_client }}"
                                                            readonly placeholder="TelClient">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Banque du
                                                            demandeur</label>
                                                        <input id="banque_id_p" type="texte" name="banque_client"
                                                            class="form-control"value="{{ $item_c->banque_client }}"
                                                            readonly placeholder="Banque">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Numéro de compte
                                                            du
                                                            demandeur</label>
                                                        <input name="num_compt_client" type="text" min="11"
                                                            max="12"
                                                            class="form-control"value="{{ $item_c->num_compt_client }}"
                                                            readonly id="num_compt_id_p"
                                                            placeholder="Numéro de compte">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($item_c->type_prs == 'morale')
                                        <!-- Section Personne Morale -->
                                        <div id="morale">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nature des
                                                            opérations</label>
                                                        <input name="nature_op" type="text" class="form-control"
                                                            id="" value="{{ $item_c->nature_op }}"
                                                            placeholder="Nature des opérations" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nature des
                                                            produits</label>
                                                        <input name="nature_pro" type="text" class="form-control"
                                                            id="" value="{{ $item_c->nature_p }}"
                                                            placeholder="Nature des produits" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Boite postale de
                                                            la
                                                            société</label>
                                                        <input name="boite" type="text" class="form-control"
                                                            id="boite_id_m" value="{{ $item_c->boite }}"
                                                            placeholder="Boite postale" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Devise</label>
                                                        <input name="currency_from" value="{{ $item_c->devise }}"
                                                            type="text" class="form-select position-relative"
                                                            readonly>

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Montant de la
                                                            transaction</label>
                                                        <input name="montant_in" type="number" class="form-control"
                                                            value="{{ $item_c->montant }}" id="montant_in_m"
                                                            placeholder="Montant" readonly>
                                                    </div>
                                                </div>
                                                <div class="col" id="valeur_m">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Coût de la
                                                            devise</label>
                                                        <input name="valeur" type="text" class="form-control"
                                                            id="val1" placeholder="Valeur"
                                                            value="{{ $taux_d }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col" id="mont_fcfa_m">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Contre montant
                                                            de la
                                                            transaction</label>
                                                        <input name="mont_fcfa" type="text" class="form-control"
                                                            id="montant_fcfa_m" value="{{ $item_c->montant_con }}"
                                                            placeholder="Contre montant" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Nom de la
                                                            société</label>
                                                        <input name="nomsociete" type="text" class="form-control"
                                                            id="nom_id_m" placeholder="Nom societe"
                                                            value="{{ $item_c->nomsociete }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Catégorie de la
                                                            société</label>
                                                        <input name="categorie" type="text" class="form-control"
                                                            id="categorie_id_m" placeholder="Catégorie"
                                                            value="{{ $item_c->categorie }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Adresse de la
                                                            société</label>
                                                        <input name="adresse" type="text" class="form-control"
                                                            id="adresse_id_m" placeholder="Adresse"
                                                            value="{{ $item_c->adresse }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group" style="position: relative;top: 15px;">

                                                        <label for="" class="form-label mt-4">Entrez le
                                                            numéro de
                                                            téléphone de la société:</label>

                                                        <input id="tel_id_m" type="tel" name="tel_client"
                                                            class="form-control"
                                                            placeholder="TelClient"value="{{ $item_c->tel_client }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Banque de la
                                                            société</label>
                                                        <input id="banque_id_m" type="texte" name="banque_client"
                                                            class="form-control" value="{{ $item_c->banque_client }}"
                                                            readonly placeholder="Banque">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Numéro de compte
                                                            de la
                                                            société</label>
                                                        <input name="num_compt_client" type="text"
                                                            class="form-control" id="num_compt_id_m"
                                                            value="{{ $item_c->num_compt_client }}" readonly
                                                            placeholder="Numéro de compte">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <div class="card-header">
                                    <h5>Bénéficiaire</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Nom du
                                                    bénéficiaire</label>
                                                <input name="nom_benifi" type="text" class="form-control"
                                                    placeholder="Nom du bénéficiaire"
                                                    value="{{ $item_c->nom_benefi }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Prénom du
                                                    bénéficiaire</label>
                                                <input name="prenom_benifi" type="text" class="form-control"
                                                    placeholder="Prénom du bénéficiaire"
                                                    value="{{ $item_c->prenom_benefi }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Profession du
                                                    bénéficiaire</label>
                                                <input name="profess_benifi" type="text" class="form-control"
                                                    placeholder="Profession du bénéficiaire"
                                                    value="{{ $item_c->profess_benefi }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Pays
                                                    bénéficiaire</label>
                                                <select name="pays_benifi" class="form-select" required>
                                                    @if ($item_c->pays_benifi != 0)
                                                        <option value="{{ $item_c->pays_benifi }}" selected>
                                                            {{ $item_c->pays_benifi }}
                                                        </option>
                                                    @else
                                                        <option value="" selected>Sélectionner un pays</option>
                                                    @endif
                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Albania">Albania</option>
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
                                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina
                                                    </option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British Indian Ocean Territory">British Indian Ocean
                                                        Territory</option>
                                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Cape Verde">Cape Verde</option>
                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                    <option value="Central African Republic">Central African Republic
                                                    </option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Christmas Island">Christmas Island</option>
                                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands
                                                    </option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo">Congo</option>
                                                    <option value="Congo, the Democratic Republic of the">Congo, the
                                                        Democratic Republic of the
                                                    </option>
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
                                                    <option value="Falkland Islands (Malvinas)">Falkland Islands
                                                        (Malvinas)
                                                    </option>
                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="France, Metropolitan">France, Metropolitan</option>
                                                    <option value="French Guiana">French Guiana</option>
                                                    <option value="French Polynesia">French Polynesia</option>
                                                    <option value="French Southern Territories">French Southern
                                                        Territories</option>
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
                                                    <option value="Heard and Mc Donald Islands">Heard and Mc Donald
                                                        Islands</option>
                                                    <option value="Holy See (Vatican City State)">Holy See (Vatican
                                                        City State)</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong Kong">Hong Kong</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran (Islamic Republic of)">Iran (Islamic Republic
                                                        of)</option>
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
                                                    <option value="Korea, Democratic People's Republic of">Korea,
                                                        Democratic People's Republic of
                                                    </option>
                                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Lao People's Democratic Republic">Lao People's
                                                        Democratic Republic</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya
                                                    </option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macau">Macau</option>
                                                    <option value="Macedonia, The Former Yugoslav Republic of">
                                                        Macedonia, The Former Yugoslav
                                                        Republic of</option>
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
                                                    <option value="Micronesia, Federated States of">Micronesia,
                                                        Federated States of</option>
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
                                                    <option value="Northern Mariana Islands">Northern Mariana Islands
                                                    </option>
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
                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis
                                                    </option>
                                                    <option value="Saint Lucia">Saint LUCIA</option>
                                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and
                                                        the Grenadines</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Sao Tome and Principe">Sao Tome and Principe
                                                    </option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia (Slovak Republic)">Slovakia (Slovak
                                                        Republic)</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="South Georgia and the South Sandwich Islands">South
                                                        Georgia and the South
                                                        Sandwich Islands</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="St. Helena">St. Helena</option>
                                                    <option value="St. Pierre and Miquelon">St. Pierre and Miquelon
                                                    </option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan
                                                        Mayen Islands</option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                    <option value="Taiwan, Province of China">Taiwan, Province of China
                                                    </option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania, United Republic of">Tanzania, United
                                                        Republic of</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tokelau">Tokelau</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands
                                                    </option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="United States">United States</option>
                                                    <option value="United States Minor Outlying Islands">United States
                                                        Minor Outlying Islands
                                                    </option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Viet Nam">Viet Nam</option>
                                                    <option value="Virgin Islands (British)">Virgin Islands (British)
                                                    </option>
                                                    <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)
                                                    </option>
                                                    <option value="Wallis and Futuna Islands">Wallis and Futuna Islands
                                                    </option>
                                                    <option value="Western Sahara">Western Sahara</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Yugoslavia">Yugoslavia</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                    <option value="Algeria">Algeria</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Banque
                                                    bénéficiaire</label>
                                                <select name="banque_benifi" class="form-select" required>
                                                    @if ($item_c->banque_benefi != 0)
                                                        <option value="{{ $item_c->banque_benefi }}" selected>
                                                            {{ $item_c->banque_benefi }}
                                                        </option>
                                                    @else
                                                        <option value="" selected>Sélectionner une banque
                                                        </option>
                                                    @endif
                                                    <option value="Bank of Africa Bénin">Bank of Africa Bénin</option>
                                                    <option value="Banque internationale du Bénin">Banque
                                                        internationale du Bénin</option>
                                                    <option value="Banque de l'habitat du Bénin">Banque de l'habitat du
                                                        Bénin</option>
                                                    <option value="Ecobank">Ecobank</option>
                                                    <option value="Orabank Bénin">Orabank Bénin</option>
                                                    <option value="United Bank of Africa">United Bank of Africa
                                                    </option>
                                                    <option value="Diamond Bank">Diamond Bank</option>
                                                    <option value="Société générale de banques du Bénin">Société
                                                        générale de banques du Bénin
                                                    </option>
                                                    <option
                                                        value="Banque Sahélo-Saharienne pour l’Investissement et le Commerce">
                                                        Banque
                                                        Sahélo-Saharienne pour l’Investissement et le Commerce</option>
                                                    <option value="Banque atlantique du Bénin">Banque atlantique du
                                                        Bénin</option>
                                                    <option value="BGFIBank Bénin">BGFIBank Bénin</option>
                                                    <option value="Afriland first bank benin">Afriland first bank benin
                                                    </option>
                                                    <option
                                                        value="Banque Africaine pour l'Investissement et le Commerce (BAIC)">
                                                        Banque Africaine
                                                        pour l'Investissement et le Commerce (BAIC)</option>
                                                    <option value="CBAO surcusale Attijariwafa Bank">CBAO surcusale
                                                        Attijariwafa Bank</option>
                                                    <option value="Coris-Bank Bénin">Coris-Bank Bénin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Numéro de compte
                                                    bénéficiaire</label>
                                                <input maxlength="12" minlength="12" name="num_compt_benifi"
                                                    type="number" class="form-control"
                                                    placeholder="Numéro de compte"
                                                    value="{{ $item_c->num_compt_benefi }}" required>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-11 col-12">
                            <div class="card" id="basic-info">
                                <div class="card-header">
                                    <h5>Pièces jointes</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <div id="container">

                                        @if (empty($piece))
                                            <!-- Aucune pièce existante -->
                                            <div class="row piece-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Intitulé de la
                                                            pièce</label>
                                                        <input name="pieces_doss[]" type="text" id="pieces"
                                                            class="form-control" placeholder="Pièce" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for=""
                                                            class="form-label mt-4">Référence</label>
                                                        <input name="ref_doss[]" type="text" id="refs"
                                                            class="form-control" placeholder="Référence" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Montant
                                                            ligne</label>
                                                        <div class="input-group">
                                                            <input name="montantligne[]" type="number"
                                                                id="mligne" class="form-control"
                                                                placeholder="Montant">
                                                            <span
                                                                class="input-group-text">{{ $item_c->devise }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Date
                                                            d'expiration</label>
                                                        <input name="exp_pieces[]" id="expi" type="date"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-1 d-flex align-items-end">
                                                    <div class="form-group w-100">

                                                        <button style="" type="button"
                                                            class="btn btn-primary w-10" name="btn1"
                                                            id="ajouterChamp">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 d-flex align-items-end" id="retirer">
                                                    <div class="form-group w-100">

                                                        <button style="" type="button"
                                                            class="btn btn-danger w-10" name="btn2"
                                                            id="retirerChamp">-</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                @else
                                    <!-- Pièces existantes -->
                                    <div id="container">

                                        @foreach ($piece as $item_d)
                                            <div class="row piece-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Pièce</label>
                                                        <input name="pieces_doss[]" id="pieces" type="text"
                                                            class="form-control" value="{{ $item_d->libellepiece }}"
                                                            placeholder="Pièce">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for=""
                                                            class="form-label mt-4">Référence</label>
                                                        <input name="ref_doss[]" type="text" class="form-control"
                                                            id="refs" value="{{ $item_d->referencespiece }}"
                                                            placeholder="Référence">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Montant
                                                            ligne</label>
                                                        <input name="montantligne[]" type="number" id="expi"
                                                            class="form-control" value="{{ $item_d->montantligne }}"
                                                            placeholder="Montant ligne">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="" class="form-label mt-4">Date
                                                            d'expiration</label>
                                                        <input name="exp_pieces[]" type="date" id="mligne"
                                                            class="form-control" value="{{ $item_d->dateexpi }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-1 d-flex align-items-end">
                                                    <div class="form-group w-100">

                                                        <button style="" type="button"
                                                            class="btn btn-primary w-10" name="btn1"
                                                            id="ajouterChamp">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 d-flex align-items-end" id="retirer">
                                                    <div class="form-group w-100">

                                                        <button style="" type="button"
                                                            class="btn btn-danger w-10" name="btn2"
                                                            id="retirerChamp">-</button>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
            @endif
            <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Save
                changes</button>
        </div>
        </div>
        </div>
        </div>
        </form>
        @endforeach
        </div>
    </main>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Définisse une variable globale pour stocker la valeur de i
    var i = 0;

    document.addEventListener("DOMContentLoaded", function() {
        var boutonRetirer = document.getElementById("retirerChamp");

        var boutonAjouter = document.getElementById("ajouterChamp");

        // Sélectionne le conteneur des rangées
        var container = document.getElementById("container");

        // Ajoute un gestionnaire d'événement au bouton "Ajouter"
        boutonAjouter.addEventListener("click", function() {


            // Clone la première rangée

            var clonedRow = container.querySelector(".row").cloneNode(true);

            // Effacez les valeurs des champs clonés
            var inputs = clonedRow.querySelectorAll("input");
            inputs.forEach(function(input) {
                input.value = "";
            });

            // Changez les noms des champs et réinitialisez les valeurs
            var piece = clonedRow.querySelector("#pieces");
            var refs = clonedRow.querySelector("#refs");
            var datex = clonedRow.querySelector("#expi");
            var mligne = clonedRow.querySelector("#mligne");
            var btn2 = clonedRow.querySelector("#retirerChamp");
            var btn1 = clonedRow.querySelector("#ajouterChamp");

            piece.value = " ";
            refs.value = " ";
            datex.value = " ";
            mligne.value = " ";
            piece.name = "pieces_doss[]";
            refs.name = "ref_doss[]";
            datex.name = "exp_pieces[]";
            mligne.name = "montantligne[]";
            btn1.name = 'btn1';
            btn2.name = 'btn2';


            container.appendChild(clonedRow);

        });
        boutonRetirer.addEventListener("click", function() {

            var rows = container.querySelectorAll(".row");
            var lastRow = rows[rows.length - 1];
            container.removeChild(lastRow).remove();

        });
    });
</script>
