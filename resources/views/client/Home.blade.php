    <x-app-layout>

        <main class="main-content max-height-vh-100 h-100">
            <x-app.navbar />
            <div class="pt-5 pb-6 bg-cover" style="background-image: url('/assets/img/header-blue-purple.jpg')"></div>
            <div class="container my-3 py-3">
                <div class="row mt-n6 mb-6">
                    <div class="col-lg-12 col-sm-6">
                        <div class="card blur border border-white mb-4 shadow-xs">
                            <div class="card-body p-4">

                                <p class="text-sm mb-1">{{ Auth::user()->firstname }}
                                    {{ Auth::user()->lastname }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="horizontal mb-4 dark">
                <div class="row">
                    @foreach ($user as $item)
                        <form action="{{ route('Fclient', $item->id) }}" method="Post"
                            class="card-body cardbody-color p-lg-5">
                    @endforeach
                    @csrf



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
                                    <h5>Verification</h5>
                                </div>
                                <div class="pt-0 card-body">
                                    <!-- Première partie du formulaire -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Date de dépôt du
                                                    dossier</label>
                                                <input name="date_depot" type="text" value=""
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="" class="form-label mt-4">Numero du dossier</label>
                                                <input name="numero_dossier" type="text" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>




                        <div class="col-lg-11 col-12">
                            <div class="card" id="basic-info">

                                <div class="pt-0 card-body">

                                    <button type="submit"
                                        class="mt-6 mb-0 btn btn-white btn-sm float-start">Rechercher</button>

                                </div>

                            </div>
                        </div>




                    </div>
                    </form>
                </div>

                <x-app.footer />
            </div>
        </main>

    </x-app-layout>
