@extends('layout.secretaire.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} </a>
            @endforeach
        </h1>
        <h1>Liste des demandes </h1>
        <table class="table ">
            <thead>
                <tr>

                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Date de depot:</th>

                    <th scope="col">Nom Client:</th>
                    <th scope="col">Prenom Client:</th>

                    <th scope="col">Montant:</th>
                    <th scope="col">Devise:</th>

                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Status Dossier:</th>
                    <th scope="col">Actions</span></th>



                </tr>
            </thead>
            <tbody>

                @foreach ($demande as $item)
                    <?php
                    $verif = $item['status_dmd'];
                    ?>

                    @if ($verif == 'En cours')
                        <tr class="table-primary">
                            <td>{{ $item['numero_doss'] }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['nom_client'] }}</td>
                            <td>{{ $item['prenom_client'] }}</td>
                            <td> {{ $item['montant'] }}</td>
                            <td>{{ $item['devise'] }}</td>
                            <td>{{ $item['montant_con'] }}</td>
                            <td>{{ $item['status_dmd'] }}</td>
                            <td>

                                <a href="{{ route('formulaire_demande_mj', ['id' => $item['id']]) }} " class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>

                            </td>
                            <td>
                                <a style="width: auto; height:fit-content;"
                                    href="{{ route('detaille_demande', ['id' => $item->id]) }}"
                                    class="btn btn-primary">Voir</a>
                            </td>
                        @elseif($verif == 'Autorisée')
                        <tr class="table-success">
                            <td>{{ $item['numero_doss'] }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['nom_client'] }}</td>
                            <td>{{ $item['prenom_client'] }}</td>
                            <td> {{ $item['montant'] }}</td>
                            <td>{{ $item['devise'] }}</td>
                            <td>{{ $item['montant_con'] }}</td>
                            <td>{{ $item['status_dmd'] }}</td>
                            <td>

                                <a href="{{ route('formulaire_demande_mj', ['id' => $item['id']]) }} " class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>

                            </td>
                            <td>
                                <a style="width: auto; height:fit-content;"
                                    href="{{ route('detaille_demande', ['id' => $item->id]) }}"
                                    class="btn btn-primary">Voir</a>
                            </td>
                        @elseif($verif == 'Suspendu')
                        <tr class="table-warning">
                            <td>{{ $item['numero_doss'] }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['nom_client'] }}</td>
                            <td>{{ $item['prenom_client'] }}</td>
                            <td> {{ $item['montant'] }}</td>
                            <td>{{ $item['devise'] }}</td>
                            <td>{{ $item['montant_con'] }}</td>
                            <td>{{ $item['status_dmd'] }}</td>
                            <td>

                                <a href="{{ route('formulaire_demande_mj', ['id' => $item['id']]) }} " class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>

                            </td>
                            <td>
                                <a style="width: auto; height:fit-content;"
                                    href="{{ route('detaille_demande', ['id' => $item->id]) }}"
                                    class="btn btn-primary">Voir</a>
                            </td>
                        @else
                        <tr class="table-danger">
                            <td>{{ $item['numero_doss'] }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['nom_client'] }}</td>
                            <td>{{ $item['prenom_client'] }}</td>
                            <td> {{ $item['montant'] }}</td>
                            <td>{{ $item['devise'] }}</td>
                            <td>{{ $item['montant_con'] }}</td>
                            <td>{{ $item['status_dmd'] }}</td>
                            <td>

                                <a href="{{ route('formulaire_demande_mj', ['id' => $item['id']]) }} " class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>

                            </td>
                            <td>
                                <a style="width: auto; height:fit-content;"
                                    href="{{ route('detaille_demande', ['id' => $item->id]) }}"
                                    class="btn btn-primary">Voir</a>
                            </td>
                    @endif
                @endforeach


                </tr>

            </tbody>
        </table>
        @foreach ($user as $item)
        @endforeach
    </div>
    <div>
        <!-- Bouton qui ouvre le modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            <span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
            </span>
        </button>

        <!-- Le modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mise a jour de la demande n°</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      @foreach ($user as $item)
                      <form action="{{ route('store_dmd_mj', $item->id) }}" method="post" class="card-body cardbody-color p-lg-5">
                          <input type="hidden" name="id_user" value="{{ $item->id }}">
                          <input type="hidden" name="nom_demandeur" value="{{ $item->nom }}">
                          <input type="hidden" name="mail_demandeur" value="{{ $item->mail }}">
                          <input type="hidden" name="poste_demandeur" value="{{ $item->poste }}">
                          @csrf
                  @endforeach
                  <div class="row">
                      @foreach ($user as $item)
                          <legend>Bureau du {{ $item->poste }} </legend>
                      @endforeach
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
                              @foreach ($demande as $item1)
                                  <input name="date_depot" type="texte" value="{{ $item1->date }}" class="form-control" id=""
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
                              <input name="nature_op" value="{{ $item1->nature_op }}" type="text" class="form-control" id=""
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
                              <input name="nature_pro" value="{{ $item1->nature_p }}" type="text" class="form-control" id=""
                                  placeholder="Nature des produits">
              
                          </div>
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
                              <input maxlength="14" minlength="12" value="{{ $item1->tel_client }}" name="tel_client" type="text"
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
                                  type="text" class="form-control" id="" placeholder="Numéro de compte">
                          </div>
                      </div>
              
                  </div>
                  @endforeach
                  <br>
              

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                      </div>
                </div>
            </div>
        </div>
    </div>


    <br>
    <br>
@endsection
