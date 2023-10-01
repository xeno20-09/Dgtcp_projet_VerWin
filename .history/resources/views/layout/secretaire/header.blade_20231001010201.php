<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>SAC</title>
    <link rel="icon" href="https://i.ibb.co/ZV8gVN8/pieces-de-monnaie.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
   


</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
                <img src="{{ asset('images/whiteOfficialLogo.png') }}" alt="Mon Image">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                    aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('HSecretaire') }}">Home</a>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('get_form_ask') }}">
                                    {{ __('Saisir une demande') }}
                                </a>

                            </li>

                            {{--     <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Demande
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('get_form_ask') }}">
                                        {{ __('Saisir une demande') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('get_search_ask_suite') }}">
                                        {{ __('Poursuivre une demande existante') }}
                                    </a>
                                </div>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('get_list_ask') }}">Liste des demandes</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    @foreach ($user as $item)
                        <form class="d-flex flex-row gap-3"
                            style="width: 32%;position: relative;left: 120px;top: 72px;"action="{{ route('get_search_ask', $item->id) }}"
                            method="GET">
                            <input class="form-control" type="search" name="query"
                                value="{{ request()->input('query') }}"placeholder="Recherche" aria-label="Recherche">
                            <button class="btn btn-outline" type="submit"><i class="fas fa-search"
                                    style="font-size:10px;"></i></button>
                        </form>
                    @endforeach
                </div>
                <li style="list-style-type: none;" class="nav-item">
                    <a href="{{ route('get_list_back') }}"><i class="fas fa-bell" style="font-size:48px;"></i></a>
                    <style>
                        @keyframes blink {
                            0% {
                                opacity: 1;
                            }

                            50% {
                                opacity: 0;
                            }

                            100% {
                                opacity: 1;
                            }
                        }

                        .blink-animation {
                            animation: blink 1s infinite;
                        }
                    </style>
                    <a href="{{ route('get_list_back') }}"><span
                            class="badge rounded-pill badge-notification bg-danger blink-animation"
                            style="position: relative;bottom: 24px;right: 24px;">
                            {{ $dmd_back }}
                        </span></a>


                </li>

                <img src="{{ asset('images/logo_DGTCP_2_blanc.png') }}" alt="Mon Image">
            </div>
        </nav>
    </header>
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<main class="py-4">
    @yield('script')
</main>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script src="{{ asset('js/international-telephone-input.js') }}"></script>

@extends('layout.secretaire.footer')

</html>
