<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">


            <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="card card-body" id="profile">
                        <div class="row z-index-2 justify-content-center align-items-center">
                            <div class="col-sm-auto col-4"></div>
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">
                                    <p class="mb-0 font-weight-bold text-sm"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert" id="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert" id="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-5 row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="card" id="basic-info">
                        <div class="card-header">
                            <h5>Les états sur les demandes</h5>
                        </div>
                        <form action="{{ route('listedmd') }}" method="POST" class="card-body p-lg-5">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <label class="form-label mt-4">Date de début</label>
                                    <input name="fdate" type="date" class="form-control">
                                </div>

                                <div class="col">
                                    <label class="form-label mt-4">Date de fin</label>
                                    <input name="sdate" type="date" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label mt-4">État</label>
                                    <select class="form-select" name="status" required>
                                        <option value="Autorisée">Autorisée</option>
                                        <option value="Rejetée">Rejetée</option>
                                        <option value="Suspendu">Suspendu</option>
                                        <option value="En cours">En cours</option>
                                        <option value="All">Tous</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="mt-4 btn btn-white btn-sm float-end">
                                Rechercher
                            </button>
                        </form>


                    </div>
                </div>


                <div class="col-lg-11 col-12">
                    <div class="card" id="basic-info">
                        <div class="card-header">
                            <h5>Etats sur les devises</h5>
                        </div>
                        <form action="{{ route('laliste') }}" method="POST" class="card-body p-lg-5">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <label class="form-label mt-4">Date de début</label>
                                    <input name="fdate2" type="date" class="form-control">
                                </div>

                                <div class="col">
                                    <label class="form-label mt-4">Date de fin</label>
                                    <input name="sdate2" type="date" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label mt-4">État</label>
                                    <select class="form-select" name="status2" required>
                                        <option value="Autorisée">Autorisée</option>
                                        <option value="Rejetée">Rejetée</option>
                                        <option value="Suspendu">Suspendu</option>
                                        <option value="En cours">En cours</option>
                                        <option value="All">Tous</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label mt-4">Devise</label>
                                    <select class="form-select" name="devise" required>
                                        <option value="null">Selectionner une devise</option>
                                        <option value="Euro">Euro</option>
                                        <option value="Dollar des États-Unis">Dollar us</option>
                                        <option value="Yen japonais">Yen japonais</option>
                                        <option value="Livre sterling">Livre sterling</option>
                                        <option value="Dollar canadien">Dollar canadien</option>
                                        <option value="Yuan chinois">Yuan chinois</option>
                                        <option value="Dirham des Émirats arabes unis">Dirham Emirats Arabes
                                            Unis</option>
                                        <option value="Dinar algérien">Dinar algérien</option>
                                        <option value="Livre égyptienne">Livre égyptienne</option>
                                        <option value="Cedi ghanéen">Cedi ghanéen</option>
                                        <option value="Franc guinéen">Franc guinéen</option>
                                        <option value="Quetzal guatémaltèque">Quetzal guatémaltèque</option>
                                        <option value="Naira nigérian">Naira nigérian</option>
                                        <option value="Dollar néo-zélandais">Dollar néo-zélandais</option>
                                        <option value="Franc rwandais">Franc rwandais</option>
                                        <option value="Riyal saoudien">Riyal saoudien</option>
                                        <option value="Franc CFA d'Afrique centrale">Franc CFA d'Afrique
                                            centrale</option>
                                        @foreach ($liste as $devises)
                                            <option value="{{ $devises->nom }}">
                                                {{ $devises->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="mt-4 btn btn-white btn-sm float-end">
                                Rechercher
                            </button>
                        </form>


                    </div>
                </div>
            </div>

        </div>
    </main>
</x-app-layout>
