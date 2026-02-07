<x-guest-layout>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>

    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6 text-center">Vérification de votre
                                        adresse email</h3>
                                    <p class="mb-0 text-center text-sm">
                                        {{ __('Avant de continuer, veuillez vérifier votre adresse email.') }}
                                    </p>
                                </div>

                                <div class="card-body">
                                    <!-- Message de succès -->
                                    @if (session('resent'))
                                        <div class="alert alert-success text-center text-sm mb-4" role="alert">
                                            <i class="fas fa-check-circle me-2"></i>
                                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                                        </div>
                                    @endif

                                    <!-- Message principal -->
                                    <div class="alert alert-info border-0 text-center">
                                        <i class="fas fa-envelope text-primary fa-lg mb-3"></i>
                                        <p class="text-dark font-weight-bold mb-2">
                                            {{ __('Veuillez vérifier votre boîte de réception') }}
                                        </p>
                                        <p class="text-sm text-muted mb-3">
                                            {{ __('Nous avons envoyé un lien de vérification à votre adresse email.') }}
                                            {{ __('Cliquez sur ce lien pour activer votre compte.') }}
                                        </p>
                                    </div>

                                    <!-- Si aucun email n'a été reçu -->
                                    <div class="text-center mt-4">
                                        <p class="text-sm text-muted mb-3">
                                            {{ __('Vous n\'avez pas reçu l\'email ?') }}
                                        </p>

                                        <!-- Formulaire pour renvoyer l'email de vérification -->
                                        <form method="POST" action="{{ route('verification.resend') }}"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-dark btn-sm w-100">
                                                <i class="fas fa-paper-plane me-2"></i>
                                                {{ __('Renvoyer l\'email de vérification') }}
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Lien pour changer d'email si besoin -->
                                    <div class="text-center mt-4">
                                        @if (Route::has('verification.notice'))
                                            <p class="text-sm text-muted mb-2">
                                                {{ __('Email incorrect ?') }}
                                            </p>
                                            <a href="{{ route('profile.edit') }}"
                                                class="text-sm text-dark font-weight-bold">
                                                <i class="fas fa-edit me-1"></i>
                                                {{ __('Modifier mon adresse email') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <!-- Informations de sécurité -->
                                <div class="card-footer bg-transparent pt-0">
                                    <div class="alert alert-light border text-center">
                                        <h6 class="text-dark mb-2 text-sm">Pourquoi vérifier votre email ?</h6>
                                        <p class="text-xs text-muted mb-0">
                                            <i class="fas fa-shield-alt text-success me-1"></i>
                                            La vérification protège votre compte et assure que vous recevez nos
                                            notifications importantes.
                                        </p>
                                        <p class="text-xs text-muted mt-2 mb-0">
                                            <i class="fas fa-clock text-warning me-1"></i>
                                            Le lien de vérification expire dans 24 heures
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image de fond -->
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="background-image:url('../assets/img/image-sign-in.jpg')">
                                    <div
                                        class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                                        <h6 class="text-dark text-sm mt-5">
                                            ©
                                            <script>
                                                document.write(new Date().getFullYear())
                                            </script>
                                            made with <i class="fas fa-heart text-danger"></i> by
                                            <a href="https://xeno20-09.github.io/xeno.github.io/portfolio-sac-details.html"
                                                class="text-secondary text-bold" target="_blank">Allégresse CAKPO</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>
