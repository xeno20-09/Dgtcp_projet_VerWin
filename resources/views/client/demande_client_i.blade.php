<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('/assets/img/header-blue-purple.jpg')"></div>

        <div class="container-fluid py-4 px-5">
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
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <!-- Carte d'alerte -->
                    <div class="card border-0 shadow-lg">
                        <!-- En-tête -->
                        <div class="card-header bg-gradient-danger text-white border-0">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="mb-0">Alerte</h4>
                                    <small>Une erreur est survenue</small>
                                </div>
                            </div>
                        </div>

                        <!-- Corps -->
                        <div class="card-body text-center py-5">
                            <!-- Icône d'erreur -->
                            <div class="mb-4">
                                <div
                                    class="avatar avatar-xl bg-gradient-danger rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Message d'erreur -->
                            <h5 class="text-danger mb-3">Attention</h5>
                            <div class="alert alert-danger bg-danger bg-opacity-10 border border-danger mx-auto"
                                style="max-width: 500px;">
                                <div class="d-flex align-items-center">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                                        class="text-danger me-2">
                                        <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            </div>


                        </div>

                        <!-- Pied de page -->
                        <div class="card-footer bg-light border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"
                                            class="me-1">
                                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ now()->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                                <div>
                                    @foreach ($user as $item)
                                        <a href="{{ url('Client') }}" class="btn btn-primary">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" class="me-2">
                                                <path
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            Retour à l'accueil
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        </div>
    </main>
</x-app-layout>
