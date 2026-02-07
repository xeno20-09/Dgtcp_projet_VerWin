<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="mb-3 mb-md-0">
                                    <h6 class="font-weight-semibold text-lg mb-1">Liste des demandes</h6>
                                    <p class="text-sm mb-0">
                                        @if (Auth::user()->poste == 'Vérificateur')
                                            Demandes à traiter en tant que vérificateur
                                        @else
                                            Vue d'ensemble de toutes les demandes
                                        @endif
                                    </p>
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
                                        <thead class="">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-3">
                                                    <div class="d-flex align-items-center">
                                                        <span>N° DOSSIER</span>
                                                        <button class="btn btn-link btn-sm p-0 ms-1 sort-btn"
                                                            data-sort="numero">
                                                            <svg width="12" height="12" viewBox="0 0 24 24"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M12 5.83L15.17 9l1.41-1.41L12 3 7.41 7.59 8.83 9 12 5.83zm0 12.34L8.83 15l-1.41 1.41L12 21l4.59-4.59L15.17 15 12 18.17z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                    <div class="d-flex align-items-center">
                                                        <span>DATE DÉPÔT</span>
                                                        <button class="btn btn-link btn-sm p-0 ms-1 sort-btn"
                                                            data-sort="date">
                                                            <svg width="12" height="12" viewBox="0 0 24 24"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M12 5.83L15.17 9l1.41-1.41L12 3 7.41 7.59 8.83 9 12 5.83zm0 12.34L8.83 15l-1.41 1.41L12 21l4.59-4.59L15.17 15 12 18.17z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </th>

                                                @if (Auth::user()->poste == 'Vérificateur')
                                                    <th
                                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                        SÉCRÉTAIRE
                                                    </th>
                                                @endif

                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    MONTANT
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    DEVISE
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    MONTANT FCFA
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    STATUT
                                                </th>
                                                <th
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    ACTIONS
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($demande as $item)
                                                <tr class="align-middle">
                                                    <td class="ps-3">
                                                        <div class="d-flex align-items-center">
                                                            @if ($item->vu_chef_division == null)
                                                            @endif
                                                            <div>
                                                                <h6 class="mb-0 text-sm font-weight-semibold">
                                                                    {{ $item->numero_doss }}
                                                                </h6>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <p class="mb-0 text-sm font-weight-semibold">
                                                                {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}
                                                            </p>
                                                            {{--    <small class="text-muted">
                                                                {{ \Carbon\Carbon::parse($item->date)->diffForHumans() }}
                                                            </small> --}}
                                                        </div>
                                                    </td>

                                                    @if (Auth::user()->poste == 'Vérificateur')
                                                        <td class="align-middle text-center">
                                                            <div class="avatar-group avatar-group-sm">
                                                                <div
                                                                    class="avatar avatar-xs bg-gradient-primary rounded-circle">
                                                                    <span class="text-white text-xs">
                                                                        {{ substr($item->firstname, 0, 1) }}{{ substr($item->lastname, 0, 1) }}
                                                                    </span>
                                                                </div>
                                                                <span class="text-sm ms-1">
                                                                    {{ $item->firstname }} {{ $item->lastname }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                    @endif

                                                    <td class="align-middle text-center">
                                                        <span class="text-sm font-weight-bold">
                                                            {{ number_format($item->montant, 2, ',', ' ') }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="badge badge-sm bg-info bg-opacity-10 text-info border border-info">
                                                            {{ $item->devise }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-sm font-weight-bold text-success">
                                                            {{ number_format($item->montant_con, 0, ',', ' ') }}
                                                        </span>
                                                        <small class="text-muted d-block">FCFA</small>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="badge badge-sm bg-info bg-opacity-10 text-info border border-info">
                                                            {{ $item->status_dmd }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="btn-group btn-group-sm" role="group">

                                                            <a href="{{ route('voir_demandes', ['id' => $item->id]) }}"
                                                                class="btn btn-outline-info" data-bs-toggle="tooltip"
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
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>
