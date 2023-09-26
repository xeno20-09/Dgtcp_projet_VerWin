@extends('layout.verificateur.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }}   <span class="badge rounded-pill badge-notification bg-danger"
                    style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
            @endforeach
        </h1>
        <h1>Liste des demandes </h1>

        <table class="table ">
            <thead>
                <tr>

                    <th scope="col">N°Dossier:</th>
                    <th scope="col">Nom du client:</th>
                    <th scope="col">Prenom du client:</th>
                    <th scope="col">Montant:</th>
                    <th scope="col">Devise:</th>

                    <th scope="col">Contre Montant en FCFA:</th>
                    <th scope="col">Date:</th>
                    <th scope="col">Nom Secretaire:</th>
                    <th scope="col">Nom Beneficiere:</th>
                    <th scope="col">Status:</th>
                    <th scope="col">Actions</span></th>

                </tr>
            </thead>
            <tbody>

            @foreach ($demande as $item)
               <?php
                    $verif = $item['status_dmd'];
                    $motif=$item['motif'];
                    ?>

                @if ($verif == 'En cours')
                <tr class="table-primary">
                    <td> {{ $item->numero_doss }}</td>
                    <td> {{ $item->nom_client }}</td>
                    <td> {{ $item->prenom_client }}</td>
                    <td> {{ $item['montant'] }}</td>
                    <td>{{ $item['devise'] }}</td>
                    <td>{{ $item['montant_con'] }}</td>
                    <td> {{ $item->date }}</td>
                    @foreach ($jointure as $itemc)
                        <td> {{ $itemc->name }}</td>
                        @break
                    @endforeach
                      <td>{{ $item->nom_benefi }}</td>
                    <td>{{ $item->status_dmd }}</td>
                    <td>

                        <a href="{{ route('get_update_form_ask_verificateur', ['id' => $item['id']]) }} "
                            class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>

                    </td>
                    <td>
                        <a style="width: auto; height:fit-content;" href="{{ url('detaille', ['id' => $item->id]) }}"
                            class="btn btn-primary">Voir</a>
                    </td>
                </tr>
                @elseif($verif == 'Autorisée')
                <tr class="table-success">
                        <td> {{ $item->numero_doss }}</td>
                        <td> {{ $item->nom_client }}</td>
                        <td> {{ $item->prenom_client }}</td>
                        <td> {{ $item['montant'] }}</td>
                        <td>{{ $item['devise'] }}</td>
                        <td>{{ $item['montant_con'] }}</td>
                        <td> {{ $item->date }}</td>
                        @foreach ($jointure as $itemc)
                            <td> {{ $itemc->name }}</td>
                        @break
                        @endforeach
                          <td>{{ $item->nom_benefi }}</td>
                    <td>{{ $item->status_dmd }}</td>
                    <td>

                        <a href="{{ route('get_update_form_ask_verificateur', ['id' => $item['id']]) }} "
                            class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>

                    </td>
                    <td>
                        <a style="width: auto; height:fit-content;" href="{{ url('detaille', ['id' => $item->id]) }}"
                            class="btn btn-primary">Voir</a>
                    </td>
                </tr>
                        @elseif($verif == 'Suspendu')
                        <tr class="table-warning">  <td> {{ $item->numero_doss }}</td>
                            <td> {{ $item->nom_client }}</td>
                            <td> {{ $item->prenom_client }}</td>
                            <td> {{ $item['montant'] }}</td>
                            <td>{{ $item['devise'] }}</td>
                            <td>{{ $item['montant_con'] }}</td>
                            <td> {{ $item->date }}</td>
                            @foreach ($jointure as $itemc)
                                <td> {{ $itemc->name }}</td>
                            @break
                            @endforeach
                              <td>{{ $item->nom_benefi }}</td>
                    <td>{{ $item->status_dmd }}</td>
                    <td>

                        <a href="{{ route('get_update_form_ask_verificateur', ['id' => $item['id']]) }} "
                            class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>

                    </td>
                    <td>
                        <a style="width: auto; height:fit-content;" href="{{ url('detaille', ['id' => $item->id]) }}"
                            class="btn btn-primary">Voir</a>
                    </td>
                </tr>

                @elseif($motif == 'Rejetée pour incorformité au niveau des montants')
                <tr class="table-dark">  <td> {{ $item->numero_doss }}</td>
                    <td> {{ $item->nom_client }}</td>
                    <td> {{ $item->prenom_client }}</td>
                    <td> {{ $item['montant'] }}</td>
                    <td>{{ $item['devise'] }}</td>
                    <td>{{ $item['montant_con'] }}</td>
                    <td> {{ $item->date }}</td>
                    @foreach ($jointure as $itemc)
                        <td> {{ $itemc->name }}</td>
                    @break
                    @endforeach
                      <td>{{ $item->nom_benefi }}</td>
            <td>{{ $item->status_dmd }}</td>
            <td>

                <a href="{{ route('get_update_form_ask_verificateur', ['id' => $item['id']]) }} "
                    class="table-link">
                    <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                    </span>
                </a>

            </td>
            <td>
                <a style="width: auto; height:fit-content;" href="{{ url('detaille', ['id' => $item->id]) }}"
                    class="btn btn-primary">Voir</a>
            </td>
        </tr>
                            

                            @else
                            <tr class="table-danger">
                                  <td> {{ $item->numero_doss }}</td>
                                <td> {{ $item->nom_client }}</td>
                                <td> {{ $item->prenom_client }}</td>
                                <td> {{ $item['montant'] }}</td>
                                <td>{{ $item['devise'] }}</td>
                                <td>{{ $item['montant_con'] }}</td>
                                <td> {{ $item->date }}</td>
                                @foreach ($jointure as $itemc)
                                    <td> {{ $itemc->name }}</td>
                                @break
                                @endforeach

                                  <td>{{ $item->nom_benefi }}</td>
                    <td>{{ $item->status_dmd }}</td>
                    <td>

                        <a href="{{ route('get_update_form_ask_verificateur', ['id' => $item['id']]) }} "
                            class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>

                    </td>
                    <td>
                        <a style="width: auto; height:fit-content;" href="{{ url('detaille', ['id' => $item->id]) }}"
                            class="btn btn-primary">Voir</a>
                    </td>
                </tr>

                @endif
            @endforeach
        </tbody>
    </table>
    <legend style="position: relative; display= ">
        <div style="height: 100px;
        width: 30px;
        background-color:black;
        -moz-transform: rotate(45deg); ">
        </div>

        <div style="height: 100px;
        width: 30px;
        background-color:skyblue;
        -moz-transform: rotate(45deg); ">
        </div>

        <div style="height: 100px;
        width: 30px;
        background-color:rgb(237, 237, 202);
        -moz-transform: rotate(45deg); ">
        </div>

        <div style="height: 100px;
        width: 30px;
        background-color:rgb(250, 201, 201);
        -moz-transform: rotate(45deg); ">
        </div>

        <div style="height: 100px;
        width: 30px;
        background-color:rgb(224, 249, 224);
        -moz-transform: rotate(45deg); ">
        </div>
    </legend>
       
</div>


<br>
<br>
@endsection
