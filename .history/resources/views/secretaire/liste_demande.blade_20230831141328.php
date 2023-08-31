@extends('layout.secretaire.header')
@section('content')
    <div class="container">
        <h1 style="text-align: center;">
            @foreach ($user as $item)
                <a class="nav-link" href="#"> Mr/Mrs {{ $item->name }} <span
                        class="badge rounded-pill badge-notification bg-danger"
                        style="position: relative;bottom: 24px;right: 24px;">{{ $dmd_n_lu }}</span> </a>
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

                                <a href="{{ route('get_update_form_ask', ['id_user' => $item['id']]) }} "
                                    class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>

                            </td>

                            <td>
                                <a style="width: auto; height:fit-content;"
                                    href="{{ route('get_list_details_ask', ['id_ask' => $item->id]) }}"
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

                                <a href="{{ route('get_update_form_ask', ['id_user' => $item['id']]) }} "
                                    class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>

                            </td>
                            <td>
                                <a style="width: auto; height:fit-content;"
                                    href="{{ route('get_list_details_ask', ['id_user' => $item->id]) }}"
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

                                <a href="{{ route('get_update_form_ask', ['id_user' => $item['id']]) }} "
                                    class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>

                            </td>
                            <td>
                                <a style="width: auto; height:fit-content;"
                                    href="{{ route('get_list_details_ask', ['id_user' => $item->id]) }}"
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

                                <a href="{{ route('get_update_form_ask', ['id_user' => $item['id']]) }} "
                                    class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>

                            </td>
                            <td>
                                <a style="width: auto; height:fit-content;"
                                    href="{{ route('get_list_details_ask', ['id_ask' =>  $item['id'] ) }}"
                                    class="btn btn-primary">Voir</a>
                            </td>
                    @endif
                @endforeach


                </tr>

            </tbody>
        </table>

    </div>



    <br>
    <br>
@endsection
