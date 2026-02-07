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
                            <p class="mb-0">Apps you might like!</p>
                        </div>
                        <span type="hidden" class="d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">

                        </span>

                        <button type="button" onclick="actualiserpage()"
                            class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                            <x-bi-repeat width="16px" height="16px" class="text-primary" />

                        </button>
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
                                            {{--    <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>10.5%
                                            </span> --}}
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
                                            {{--    <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>55%
                                            </span> --}}
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
                                            {{--    <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>22%
                                            </span> --}}
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
                                        <p class="text-sm text-secondary mb-1">Demandes suspendus</p>
                                        <h4 class="mb-2 font-weight-bold">
                                            {{ $le_n_dmd_s }}</h4>
                                        <div class="d-flex align-items-center">
                                            {{--   <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>18%
                                            </span> --}}
                                            <span class="text-sm ms-1">Nombre de demandes suspendues</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>

</x-app-layout>
