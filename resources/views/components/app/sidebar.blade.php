<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
            href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
            <span class="font-weight-bold text-lg">Corporate UI</span>
        </a>
    </div>


    @if (Auth::user()->poste == 'Vérificateur')
        <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('HVerificateur') ? 'active' : '' }}"
                        href="{{ url('HVerificateur') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>Home</title>
                                <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <path class="color-foreground"
                                            d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z"
                                            id="Path"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('ListeDemandesN_verificateur') ? 'active' : '' }}"
                        href="{{ url('ListeDemandesN_verificateur') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>Saisir une demande</title>
                                <g id="table" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="view-grid" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <path class="color-foreground"
                                            d="M3.42857143,0 C1.53502286,0 0,1.53502286 0,3.42857143 L0,6.85714286 C0,8.75069143 1.53502286,10.2857143 3.42857143,10.2857143 L6.85714286,10.2857143 C8.75069143,10.2857143 10.2857143,8.75069143 10.2857143,6.85714286 L10.2857143,3.42857143 C10.2857143,1.53502286 8.75069143,0 6.85714286,0 L3.42857143,0 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M3.42857143,13.7142857 C1.53502286,13.7142857 0,15.2492571 0,17.1428571 L0,20.5714286 C0,22.4650286 1.53502286,24 3.42857143,24 L6.85714286,24 C8.75069143,24 10.2857143,22.4650286 10.2857143,20.5714286 L10.2857143,17.1428571 C10.2857143,15.2492571 8.75069143,13.7142857 6.85714286,13.7142857 L3.42857143,13.7142857 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M13.7142857,3.42857143 C13.7142857,1.53502286 15.2492571,0 17.1428571,0 L20.5714286,0 C22.4650286,0 24,1.53502286 24,3.42857143 L24,6.85714286 C24,8.75069143 22.4650286,10.2857143 20.5714286,10.2857143 L17.1428571,10.2857143 C15.2492571,10.2857143 13.7142857,8.75069143 13.7142857,6.85714286 L13.7142857,3.42857143 Z"
                                            id="Path"></path>
                                        <path class="color-foreground"
                                            d="M13.7142857,17.1428571 C13.7142857,15.2492571 15.2492571,13.7142857 17.1428571,13.7142857 L20.5714286,13.7142857 C22.4650286,13.7142857 24,15.2492571 24,17.1428571 L24,20.5714286 C24,22.4650286 22.4650286,24 20.5714286,24 L17.1428571,24 C15.2492571,24 13.7142857,22.4650286 13.7142857,20.5714286 L13.7142857,17.1428571 Z"
                                            id="Path"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Saisir une demande</span>
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <div class="d-flex align-items-center nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2"
                            viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-weight-normal text-md ms-2">Liste</span>
                    </div>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ request()->routeIs('get_list_piece_verificateur') ? 'active' : '' }}"
                        href="{{ route('get_list_piece_verificateur') }}">
                        <span class="nav-link-text ms-1">Liste des pieces</span>
                    </a>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ request()->routeIs('ListeDemandes_verificateur') ? 'active' : '' }}"
                        href="{{ url('ListeDemandes_verificateur') }}">
                        <span class="nav-link-text ms-1">Liste des demandes</span>
                    </a>
                </li>




            </ul>
        </div>
    @elseif (Auth::user()->poste == 'Agent de saisir')
        <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">

                    <a class="nav-link  {{ request()->routeIs('HSecretaire') ? 'active' : '' }}"
                        href="{{ url('HSecretaire') }}">
                        <x-bi-house width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('get_form_ask') ? 'active' : '' }}"
                        href="{{ route('get_form_ask') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">

                            <x-bi-journal-plus width="30px" height="30px" class="text-primary" />

                        </div>
                        <span class="nav-link-text ms-1">Saisir une demande</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('get_list_ask') ? 'active' : '' }} "
                        href="{{ route('get_list_ask') }}">
                        <x-bi-list width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Liste des demandes</span>
                    </a>
                </li>



            </ul>
        </div>
    @elseif (Auth::user()->poste == 'Chef division')
        <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('HChef_division') ? 'active' : '' }}"
                        href="{{ url('HChef_division') }}">
                        <x-bi-house width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('liste_demandes_n') ? 'active' : '' }}"
                        href="{{ url('liste_demandes_n') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <x-bi-journal-plus width="30px" height="30px" class="text-primary" />

                        </div>
                        <span class="nav-link-text ms-1">Saisir une demande</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('liste_demandes') ? 'active' : '' }} "
                        href="{{ url('liste_demandes') }}">
                        <x-bi-list width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Liste des demandes</span>
                    </a>
                </li>



            </ul>
        </div>
    @elseif (Auth::user()->poste == 'Chef service')
        <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('HChef_bureau') ? 'active' : '' }}"
                        href="{{ url('HChef_bureau') }}">
                        <x-bi-house width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('liste_demand_n') ? 'active' : '' }}"
                        href="{{ url('liste_demand_n') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <x-bi-journal-plus width="30px" height="30px" class="text-primary" />
                        </div>
                        <span class="nav-link-text ms-1">Saisir une demande</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('liste_demand') ? 'active' : '' }} "
                        href="{{ url('liste_demand') }}">
                        <x-bi-list width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Liste des demandes</span>
                    </a>
                </li>

                <li class="nav-item mt-2">
                    <div class="d-flex align-items-center nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2"
                            viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-weight-normal text-md ms-2">Etats des demandes</span>
                    </div>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lesdevis' ? 'active' : '' }}"
                        href="lesdevis">
                        <span class="nav-link-text ms-1">Etats sur les devises</span>
                    </a>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lespays' ? 'active' : '' }}"
                        href="lespays">
                        <span class="nav-link-text ms-1">Etats sur les pays</span>
                    </a>
                </li>


                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lessocietes' ? 'active' : '' }}"
                        href="lessocietes">
                        <span class="nav-link-text ms-1">Etats sur les sociétées</span>
                    </a>
                </li>
            </ul>
        </div>
    @elseif (Auth::user()->poste == 'Directeur')
        <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('HDamf') ? 'active' : '' }}"
                        href="{{ url('HDamf') }}">
                        <x-bi-house width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('liste_dmd_n') ? 'active' : '' }}"
                        href="{{ url('liste_dmd_n') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <x-bi-journal-plus width="30px" height="30px" class="text-primary" />

                        </div>
                        <span class="nav-link-text ms-1">Saisir une demande</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('liste_dmd') ? 'active' : '' }} "
                        href="{{ url('liste_dmd') }}">
                        <x-bi-list width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Liste des demandes</span>
                    </a>
                </li>

                <li class="nav-item mt-2">
                    <div class="d-flex align-items-center nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2"
                            viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-weight-normal text-md ms-2">Etats des demandes</span>
                    </div>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lesdevis' ? 'active' : '' }}"
                        href="lesdevis">
                        <span class="nav-link-text ms-1">Etats sur les devises</span>
                    </a>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lespays' ? 'active' : '' }}"
                        href="lespays">
                        <span class="nav-link-text ms-1">Etats sur les pays</span>
                    </a>
                </li>


                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lessocietes' ? 'active' : '' }}"
                        href="lessocietes">
                        <span class="nav-link-text ms-1">Etats sur les sociétées</span>
                    </a>
                </li>
            </ul>
        </div>
    @elseif (Auth::user()->poste == 'Admin')
        <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">
                        <x-bi-house width="30px" height="30px" class="text-primary" />
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ request()->routeIs('etatdmd') ? 'active' : '' }}"
                        href="{{ route('etatdmd') }}">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>Etats des demandes</title>
                                <g id="table" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g id="view-grid" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <path class="color-foreground"
                                            d="M3.42857143,0 C1.53502286,0 0,1.53502286 0,3.42857143 L0,6.85714286 C0,8.75069143 1.53502286,10.2857143 3.42857143,10.2857143 L6.85714286,10.2857143 C8.75069143,10.2857143 10.2857143,8.75069143 10.2857143,6.85714286 L10.2857143,3.42857143 C10.2857143,1.53502286 8.75069143,0 6.85714286,0 L3.42857143,0 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M3.42857143,13.7142857 C1.53502286,13.7142857 0,15.2492571 0,17.1428571 L0,20.5714286 C0,22.4650286 1.53502286,24 3.42857143,24 L6.85714286,24 C8.75069143,24 10.2857143,22.4650286 10.2857143,20.5714286 L10.2857143,17.1428571 C10.2857143,15.2492571 8.75069143,13.7142857 6.85714286,13.7142857 L3.42857143,13.7142857 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M13.7142857,3.42857143 C13.7142857,1.53502286 15.2492571,0 17.1428571,0 L20.5714286,0 C22.4650286,0 24,1.53502286 24,3.42857143 L24,6.85714286 C24,8.75069143 22.4650286,10.2857143 20.5714286,10.2857143 L17.1428571,10.2857143 C15.2492571,10.2857143 13.7142857,8.75069143 13.7142857,6.85714286 L13.7142857,3.42857143 Z"
                                            id="Path"></path>
                                        <path class="color-foreground"
                                            d="M13.7142857,17.1428571 C13.7142857,15.2492571 15.2492571,13.7142857 17.1428571,13.7142857 L20.5714286,13.7142857 C22.4650286,13.7142857 24,15.2492571 24,17.1428571 L24,20.5714286 C24,22.4650286 22.4650286,24 20.5714286,24 L17.1428571,24 C15.2492571,24 13.7142857,22.4650286 13.7142857,20.5714286 L13.7142857,17.1428571 Z"
                                            id="Path"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Etats des demandes</span>
                    </a>
                </li>

                <li class="nav-item mt-2">
                    <div class="d-flex align-items-center nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2"
                            viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-weight-normal text-md ms-2">Stats</span>
                    </div>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lesdevis' ? 'active' : '' }}"
                        href="lesdevis">
                        <span class="nav-link-text ms-1">Etats sur les devises</span>
                    </a>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lespays' ? 'active' : '' }}"
                        href="lespays">
                        <span class="nav-link-text ms-1">Etats sur les pays</span>
                    </a>
                </li>


                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ 'lessocietes' ? 'active' : '' }}"
                        href="lessocietes">
                        <span class="nav-link-text ms-1">Etats sur les sociétées</span>
                    </a>
                </li>

            </ul>
        </div>
    @endif







    <div class="sidenav-footer mx-4 ">


    </div>
</aside>
