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
                                    <h3 class="font-weight-black text-dark display-6 text-center">Confirmation du mot de
                                        passe</h3>
                                    <p class="mb-0 text-center text-sm">
                                        {{ __('Veuillez confirmer votre mot de passe avant de continuer.') }}
                                    </p>
                                </div>

                                <div class="card-body">
                                    <!-- Messages d'erreur -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger text-left" role="alert">
                                            <div class="text-sm font-weight-bold">Veuillez corriger les erreurs
                                                suivantes :</div>
                                            <ul class="mb-0 text-sm">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <!-- Message de session -->
                                    @if (session('status'))
                                        <div class="alert alert-success text-center text-sm mb-4">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.confirm') }}" role="form">
                                        @csrf

                                        <!-- Champ mot de passe -->
                                        <div class="mb-3">
                                            <label for="password" class="form-label text-sm">Mot de passe</label>
                                            <div class="input-group input-group-outline">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"
                                                    placeholder="Saisissez votre mot de passe actuel">
                                                <span class="input-group-text cursor-pointer" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Indicateur de force du mot de passe -->
                                        <div class="mb-4">
                                            <div class="password-strength">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%">
                                                    </div>
                                                </div>
                                                <small class="text-muted text-sm mt-1"
                                                    id="password-strength-text"></small>
                                            </div>
                                        </div>

                                        <!-- Bouton de soumission -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark btn-lg w-100 mb-3">
                                                {{ __('Confirmer le mot de passe') }}
                                            </button>
                                        </div>

                                        <!-- Lien mot de passe oublié -->
                                        <div class="text-center">
                                            @if (Route::has('password.request'))
                                                <a class="text-sm text-dark font-weight-bold"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Mot de passe oublié ?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                                <!-- Informations de sécurité -->
                                <div class="card-footer bg-transparent pt-0">
                                    <div class="alert alert-light border text-center">
                                        <h6 class="text-dark mb-2 text-sm">Sécurité du compte</h6>
                                        <p class="text-xs text-muted mb-0">
                                            <i class="fas fa-shield-alt text-success me-1"></i>
                                            La confirmation de votre mot de passe protège l'accès à vos informations
                                            personnelles.
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
