<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container my-3 py-3">
            <div class="row">

                <div class="col-12 col-xl-12 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Profile information</h6>
                                    <p class="text-sm mb-1">.</p>
                                </div>
                                <div class="col-md-4 col-3 text-end">
                                    <button type="button" class="btn btn-white btn-icon px-2 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="mb-5 row justify-content-center">
                                <div class="col-lg-9 col-12">
                                    <div class="card" id="basic-info">
                                        <div class="card-header">
                                            <h5>Détails de la demande</h5>
                                        </div>
                                        <div class="pt-0 card-body">
                                            @foreach ($demande as $item)
                                                <p class="text-sm mb-4">
                                                    <strong>Dossier N°:</strong> {{ $item['numero_doss'] }}<br>
                                                    <strong>Date d'enregistrement:</strong> {{ $item['date'] }}
                                                </p>

                                                <ul class="list-group">
                                                    <li
                                                        class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                                        <span class="text-secondary">Nature des produits:</span> &nbsp;
                                                        {{ $item['nature_p'] }}
                                                    </li>
                                                    <li
                                                        class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                        <span class="text-secondary">Nature des opérations:</span>
                                                        &nbsp; {{ $item['nature_op'] }}
                                                    </li>
                                                    <li
                                                        class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                        <span class="text-secondary">Montant:</span> &nbsp;
                                                        {{ $item['montant'] }} ({{ $item['devise'] }})
                                                    </li>
                                                    <li
                                                        class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                        <span class="text-secondary">Contre montant:</span> &nbsp;
                                                        {{ $item['montant_con'] }} FCFA
                                                    </li>

                                                    @if ($item->nom_client)
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Type de personne:</span> &nbsp;
                                                            Personne Physique
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Nom:</span> &nbsp;
                                                            {{ $item['nom_client'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Prénom:</span> &nbsp;
                                                            {{ $item['prenom_client'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Profession:</span> &nbsp;
                                                            {{ $item['profess_client'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Téléphone:</span> &nbsp;
                                                            {{ $item['tel_client'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Banque:</span> &nbsp;
                                                            {{ $item['banque_client'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Numéro de compte:</span> &nbsp;
                                                            {{ $item['num_compt_client'] }}
                                                        </li>
                                                    @endif

                                                    @if ($item->nomsociete)
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Type de personne:</span> &nbsp;
                                                            Personne Morale
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Nom de la société:</span>
                                                            &nbsp; {{ $item['nomsociete'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Catégorie:</span> &nbsp;
                                                            {{ $item['categorie'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Adresse:</span> &nbsp;
                                                            {{ $item['adresse'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Téléphone:</span> &nbsp;
                                                            {{ $item['tel_client'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Banque:</span> &nbsp;
                                                            {{ $item['banque_client'] }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Numéro de compte:</span> &nbsp;
                                                            {{ $item['num_compt_client'] }}
                                                        </li>
                                                    @endif

                                                    <li
                                                        class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                        <span class="text-secondary">Pièces jointes:</span> &nbsp;
                                                        @if ($pieces)
                                                            {{ $pieces->libellepiece }}
                                                        @else
                                                            Aucune pièce jointe
                                                        @endif
                                                    </li>
                                                    @if ($pieces)
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Références pièces:</span>
                                                            &nbsp; {{ $pieces->referencespiece }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Montant initial:</span> &nbsp;
                                                            {{ $pieces->montantinitial }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Montant ligne:</span> &nbsp;
                                                            {{ $pieces->montantligne }}
                                                        </li>
                                                        <li
                                                            class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                            <span class="text-secondary">Montant restant:</span> &nbsp;
                                                            {{ $pieces->montantrestant }}
                                                        </li>
                                                    @endif

                                                    <li
                                                        class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                                        <span class="text-secondary">Position de la demande:</span>
                                                        &nbsp;
                                                        @php
                                                            if (
                                                                $item['vu_secret'] == 1 &&
                                                                $item['vu_verifi'] == 0 &&
                                                                $item['vu_chef_division'] == 0 &&
                                                                $item['vu_chef_bureau'] == 0 &&
                                                                $item['vu_damf'] == 0
                                                            ) {
                                                                echo 'Vérificateur';
                                                            } elseif (
                                                                $item['vu_secret'] == 1 &&
                                                                $item['vu_verifi'] == 1 &&
                                                                $item['vu_chef_division'] == 0 &&
                                                                $item['vu_chef_bureau'] == 0 &&
                                                                $item['vu_damf'] == 0
                                                            ) {
                                                                echo 'Chef division';
                                                            } elseif (
                                                                $item['vu_secret'] == 1 &&
                                                                $item['vu_verifi'] == 1 &&
                                                                $item['vu_chef_division'] == 1 &&
                                                                $item['vu_chef_bureau'] == 0 &&
                                                                $item['vu_damf'] == 0
                                                            ) {
                                                                echo 'Chef service';
                                                            } elseif (
                                                                $item['vu_secret'] == 1 &&
                                                                $item['vu_verifi'] == 1 &&
                                                                $item['vu_chef_division'] == 1 &&
                                                                $item['vu_chef_bureau'] == 1 &&
                                                                $item['vu_damf'] == 0
                                                            ) {
                                                                echo 'Directeur';
                                                            } elseif (
                                                                $item['vu_secret'] == 1 &&
                                                                $item['vu_verifi'] == 1 &&
                                                                $item['vu_chef_division'] == 1 &&
                                                                $item['vu_chef_bureau'] == 1 &&
                                                                $item['vu_damf'] == 1
                                                            ) {
                                                                echo $item['status_dmd'];
                                                            } else {
                                                                echo 'En attente';
                                                            }
                                                        @endphp
                                                    </li>
                                                </ul>
                                            @endforeach

                                            <div class="mt-4 d-flex justify-content-between">
                                                @foreach ($user as $item)
                                                    <a style="width: auto; height:fit-content;"
                                                        href="{{ url('HSecretaire') }}"
                                                        class="btn btn-primary">Statistique</a>
                                                @endforeach
                                                <a style="width: auto; height:fit-content;"
                                                    href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-xs text-muted text-lg-start">
                                Copyright
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                Corporate UI by
                                <a href="https://www.creative-tim.com" class="text-secondary" target="_blank">Creative
                                    Tim</a>.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-xs text-muted"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation"
                                        class="nav-link text-xs text-muted" target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-xs text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license"
                                        class="nav-link text-xs pe-0 text-muted" target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

</x-app-layout>
