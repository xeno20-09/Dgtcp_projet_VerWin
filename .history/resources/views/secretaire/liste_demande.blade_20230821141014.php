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
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Create New User') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Name') }}:</strong>
                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Email') }}:</strong>
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Password') }}:</strong>
                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Confirm Password') }}:</strong>
                                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Role') }}:</strong>
                                {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="button" class="btn grey btn-outline-secondary"
                                data-dismiss="modal">{{ __('Back') }}</button>
                            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <br>
    <br>
@endsection
