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
                                    <h6 class="font-weight-semibold text-lg mb-0">Pièces jointes par dossier</h6>
                                    <p class="text-sm">Vérifiez les montants et références des pièces</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <!-- Filtres ou actions supplémentaires peuvent être ajoutés ici -->
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
                                    <input type="text" class="form-control" placeholder="Rechercher un dossier...">
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">N° Dossier
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Date
                                                de dépôt</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Libellé pièce</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Références</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Montant initial</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Montant ligne</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Montant restant</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $currentDmdId = null;
                                        @endphp
                                        @foreach ($pieces as $item)
                                            @php
                                                // Déterminer la classe de badge en fonction du montant restant
                                                if ($item['montantrestant'] < 0) {
                                                    $badgeClass = 'border border-danger text-danger bg-danger';
                                                    $statusText = 'Déficit';
                                                } else {
                                                    $badgeClass = 'border border-warning text-warning bg-warning';
                                                    $statusText = 'À vérifier';
                                                }
                                            @endphp
                                            <tr class="">
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-sm font-weight-semibold">
                                                                {{ $item['numero_doss'] }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">
                                                        {{ $item['date'] }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">
                                                        {{ $item['libellepiece'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">
                                                        {{ $item['referencespiece'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-dark text-sm font-weight-bold">
                                                        {{ $item['montantinitial'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-dark text-sm font-weight-bold">
                                                        {{ $item['montantligne'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-dark text-sm font-weight-bold">
                                                        {{ $item['montantrestant'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge badge-sm {{ $badgeClass }}">
                                                        {{ $statusText }}
                                                    </span>
                                                </td>
                                            </tr>
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
