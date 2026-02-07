<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des demandes</h6>
                                    <p class="text-sm mb-0">Voir les informations sur toutes les demandes</p>
                                </div>
                                <div class="mt-2 mt-sm-0">
                                    {{--        <div class="input-group input-group-outline">
                                        <input type="text" class="form-control" placeholder="Rechercher..."
                                            id="searchInput">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                            </svg>
                                        </span>
                                    </div> --}}
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
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                            </div>

                            <!-- Tableau -->
                            <div class="table-responsive p-0">
                                @if ($jointure->isEmpty())
                                    <div class="text-center py-5">
                                        <div class="mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.801 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                            </svg>
                                        </div>
                                        <h6 class="text-muted mb-2">Aucune demande disponible</h6>
                                        <p class="text-muted mb-4">Les nouvelles demandes apparaîtront ici</p>
                                    </div>
                                @else
                                    <table class="table align-items-center mb-0 table-hover" id="demandesTable">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-4">
                                                    N° Dossier
                                                </th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                    Date de dépôt
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Secrétaire
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Montant
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Devise
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Montant FCFA
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Statut
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($demande as $item)
                                                <tr class="table-row">
                                                    <td class="ps-4">
                                                        <div class="d-flex align-items-center">

                                                            <div>
                                                                <h6 class="mb-0 text-sm font-weight-semibold">
                                                                    {{ $item->numero_doss }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">
                                                            {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">
                                                            {{ $item->firstname }} {{ $item->lastname }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-sm font-weight-normal">
                                                            {{ number_format($item->montant, 2, ',', ' ') }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="badge badge-sm bg-gradient-info text-white">
                                                            {{ $item->devise }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-sm font-weight-bold text-success">
                                                            {{ number_format($item->montant_con, 0, ',', ' ') }} FCFA
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">

                                                        <span class="badge badge-sm bg-gradient-info text-white">
                                                            {{ $item->status_dmd }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            @if ($item->vu_chef_division == null)
                                                                <a href="{{ route('formulairecd_demande_mj', ['id' => $item->id]) }}"
                                                                    class="btn btn-sm btn-outline-primary"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-title="Modifier la demande">
                                                                    <svg width="14" height="14"
                                                                        viewBox="0 0 15 16" fill="currentColor">
                                                                        <path
                                                                            d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" />
                                                                    </svg>
                                                                </a>
                                                            @endif

                                                            <a href="{{ url('detailles_demandes', ['id' => $item->id]) }}"
                                                                class="btn btn-sm btn-outline-info"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-title="Voir les détails">
                                                                <svg width="14" height="14" viewBox="0 0 24 24"
                                                                    fill="none" stroke="currentColor"
                                                                    stroke-width="2">
                                                                    <path
                                                                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                                    <circle cx="12" cy="12" r="3" />
                                                                </svg>
                                                            </a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <x-app.footer />
            </div>
    </main>
</x-app-layout>
