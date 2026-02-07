<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- En-tête avec le nom de l'utilisateur -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div
                                    class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-xl">
                                    <i class="fas fa-user text-white opacity-10"></i>
                                </div>
                                <div class="ms-3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des demandes à revoir</h6>
                                    <p class="text-sm">Voir les informations sur toutes les demandes nécessitant votre
                                        attention</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <!-- Vous pouvez ajouter un bouton d'action ici si nécessaire -->
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
                                    <input type="text" class="form-control" placeholder="Rechercher une demande...">
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">N°Dossier
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Date
                                                de dépôt</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Nom Client
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Prénom
                                                Client</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Montant</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Devise</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Contre Montant FCFA</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Status Dossier</th>
                                            <th class="text-secondary opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($demande as $item)
                                            <?php
                                            $verif = $item['status_dmd'];
                                            $statusColor = '';
                                            $statusBadge = '';
                                            
                                            switch ($verif) {
                                                case 'En cours':
                                                    $statusColor = 'primary';
                                                    $statusBadge = 'border border-primary text-primary bg-primary';
                                                    break;
                                                case 'Autorisée':
                                                    $statusColor = 'success';
                                                    $statusBadge = 'border border-success text-success bg-success';
                                                    break;
                                                case 'Suspendu':
                                                    $statusColor = 'warning';
                                                    $statusBadge = 'border border-warning text-warning bg-warning';
                                                    break;
                                                default:
                                                    $statusColor = 'danger';
                                                    $statusBadge = 'border border-danger text-danger bg-danger';
                                                    break;
                                            }
                                            ?>
                                            <tr class="table-{{ $statusColor }}">
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-sm font-weight-semibold">
                                                                {{ $item['numero_doss'] }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">
                                                        {{ $item['date'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">
                                                        {{ $item['nom_client'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">
                                                        {{ $item['prenom_client'] }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">
                                                        {{ $item['montant'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">
                                                        {{ $item['devise'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-normal">
                                                        {{ $item['montant_con'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge badge-sm {{ $statusBadge }}">
                                                        {{ $item['status_dmd'] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('get_correction_form_ask', ['id' => $item['id']]) }}"
                                                        class="text-secondary font-weight-bold text-xs me-2"
                                                        data-bs-toggle="tooltip" data-bs-title="Corriger la demande">
                                                        <svg width="14" height="14" viewBox="0 0 15 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z"
                                                                fill="#64748B" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('get_list_details_ask', ['id_ask' => $item['id']]) }}"
                                                        class="text-secondary font-weight-bold text-xs me-2"
                                                        data-bs-toggle="tooltip" data-bs-title="Voir les détails">
                                                        <svg width="14" height="14" viewBox="0 0 16 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8 2C4.667 2 2 4.667 2 8s2.667 6 6 6 6-2.667 6-6-2.667-6-6-6zm0 10.667A4.668 4.668 0 013.333 8 4.668 4.668 0 018 3.333 4.668 4.668 0 0112.667 8 4.668 4.668 0 018 12.667zm0-8A3.335 3.335 0 004.667 8 3.335 3.335 0 008 11.333 3.335 3.335 0 0011.333 8 3.335 3.335 0 008 4.667zm0 5.333a2 2 0 110-4 2 2 0 010 4z"
                                                                fill="#64748B" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination si nécessaire -->
                            <div class="card-footer border-top py-3 px-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0 text-sm">Total: {{ count($demande) }} demandes</p>
                                    <!-- Ajouter la pagination ici si nécessaire -->
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
