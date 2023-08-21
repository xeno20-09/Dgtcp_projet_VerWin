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

    @foreach ($demande as $item1)
        <!-- Bouton qui ouvre le modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#myModal-{{ $item1->id }}">
            <span class="fa-stack">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
            </span>
        </button>

        <!-- Le modal -->
        <div class="modal fade" id="myModal-{{ $item1->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mise à jour de la demande n°{{ $item1->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('store_dmd_mj', $item->id) }}" method="post"
                            class="card-body cardbody-color p-lg-5">
                            <!-- ... Le contenu de votre formulaire ... -->
                            @extends('secretaire.form_demande_mj')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <br>
    <br>
@endsection
