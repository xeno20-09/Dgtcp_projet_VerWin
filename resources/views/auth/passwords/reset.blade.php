<x-guest-layout>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6 text-center">Reset Password</h3>
                                </div>
                                <div class="card-body text-center">
                                    @if ($errors->any())
                                        <div>
                                            <div>Something went wrong!</div>

                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form role="form" action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Email"
                                                aria-label="Email" id="email" name="email"
                                                value="{{ old('email') }}" required autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="Enter your password" aria-label="Password" id="password"
                                                name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" id="password_confirmation" class="form-control"
                                                name="password_confirmation" placeholder="Confirm your password"
                                                aria-label="Password" id="password_confirmation"
                                                name="password_confirmation" required>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="my-4 mb-2 btn btn-dark btn-lg w-100">Send</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                            <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                style="background-image:url('../assets/img/image-sign-in.jpg')">
                                <div
                                    class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">

                                    <h6 class="text-dark text-sm mt-5"> ©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                        made with <x-bi-hearts /> by
                                        <a href="https://xeno20-09.github.io/xeno.github.io/portfolio-sac-details.html"
                                            class="text-secondary text-bold" target="_blank">Allégresse
                                            CAKPO</a>
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
