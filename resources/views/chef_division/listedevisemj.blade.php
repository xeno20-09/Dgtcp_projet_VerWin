<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- En-tête de la page -->


            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Historique des devises</h6>
                                    <p class="text-sm">Voir les valeurs des devises par date</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ url()->previous() }}"
                                        class="btn btn-sm btn-secondary btn-icon d-flex align-items-center">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M19 11H7.83l4.88-4.88c.39-.39.39-1.03 0-1.42-.39-.39-1.02-.39-1.41 0l-6.59 6.59c-.39.39-.39 1.02 0 1.41l6.59 6.59c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L7.83 13H19c.55 0 1-.45 1-1s-.45-1-1-1z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Retour</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                <div class="input-group w-sm-25 ms-auto">
                                    <span class="input-group-text text-body">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Rechercher une devise...">
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Date</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Devise</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Valeur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devises as $dev)
                                            @if ($dev->date != $ladate)
                                                <tr style="background-color: #f8f9fa;">
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                                <h6 class="mb-0 text-sm font-weight-semibold">
                                                                    {{ $dev->date }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                                            {{ $dev->devise }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">
                                                            {{ $dev->valeur }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr style="background-color: #e7f1ff;">
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                                <h6 class="mb-0 text-sm font-weight-semibold">
                                                                    {{ $dev->date }}
                                                                </h6>
                                                                <span
                                                                    class="badge badge-sm border border-success text-success bg-success ms-2">
                                                                    Actuelle
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                                            {{ $dev->devise }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-success text-sm font-weight-bold">
                                                            {{ $dev->valeur }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>

</x-app-layout>
