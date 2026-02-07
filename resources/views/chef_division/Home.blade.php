<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            @foreach ($user as $item)
                                <h3 class="font-weight-bold mb-0">Hello, Mr/Mrs {{ $item['firstname'] }}
                                    {{ $item['lastname'] }}</h3>
                            @endforeach
                            <p class="mb-0">Tableau de bord Chef Division</p>
                        </div>

                        <div class="ms-md-auto d-flex">
                            @foreach ($user as $item)
                                <a href="{{ route('devises', $item->id) }}"
                                    class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                    <span class="btn-inner--icon">
                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                            <path
                                                d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
                                        </svg>
                                    </span>
                                    <span class="btn-inner--text">Mettre à jour les devises</span>
                                </a>
                            @endforeach

                            <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0"
                                data-bs-toggle="modal" data-bs-target="#insertionModal">
                                <span class="btn-inner--icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                        <path fill-rule="evenodd"
                                            d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span class="btn-inner--text">Ajouter une devise</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">

            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <x-bi-activity width="16px" height="16px" class="text-primary" />
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Demandes en cours</p>
                                        <h4 class="mb-2 font-weight-bold">
                                            {{ $le_n_dmd_c }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm ms-1">Nombre de demandes en attente</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <x-bi-check2 width="16px" height="16px" class="text-primary" />
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Demandes validées</p>
                                        <h4 class="mb-2 font-weight-bold">
                                            {{ $le_n_dmd_v }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm ms-1">Nombre de demandes acceptées</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <x-bi-x width="16px" height="16px" class="text-primary" />
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Demandes rejetées</p>
                                        <h4 class="mb-2 font-weight-bold">
                                            {{ $le_n_dmd_e }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm ms-1">Nombre de demandes refusées</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <x-bi-pause width="16px" height="16px" class="text-primary" />
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Demandes suspendues</p>
                                        <h4 class="mb-2 font-weight-bold">
                                            {{ $le_n_dmd_s }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm ms-1">Nombre de demandes suspendues</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal pour ajouter une devise -->
            <div class="modal fade" id="insertionModal" tabindex="-1" aria-labelledby="insertionModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-semibold" id="insertionModalLabel">Ajouter une devise
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        @foreach ($user as $item)
                            <form action="{{ route('adddevises', ['id' => $item->id]) }}" method="POST">
                        @endforeach
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="devise" class="form-label">Nom de la devise</label>
                                <input type="text" class="form-control" id="devise" name="devise"
                                    placeholder="Entrez le nom de la devise" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">
                                <span class="btn-inner--icon me-1">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                        <path d="M9 3L3 9M3 3L9 9" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </span>
                                <span class="btn-inner--text">Annuler</span>
                            </button>
                            <button type="submit" class="btn btn-sm btn-dark">
                                <span class="btn-inner--icon me-1">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                        <path d="M10 3L4.5 8.5L2 6" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="btn-inner--text">Enregistrer</span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>

</x-app-layout>
