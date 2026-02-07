<x-guest-layout>

    <div @class(['container', 'position-sticky', 'z-index-sticky', 'top-0'])>
        <div @class(['row'])>
            <div @class(['col-12'])>
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>
    <main @class(['main-content', 'mt-0'])>
        <section>
            <div @class(['page-header', 'min-vh-100'])>
                <div @class(['container'])>
                    <div @class(['row'])>
                        <div @class(['col-md-6'])>
                            <div @class([
                                'position-absolute',
                                'w-40',
                                'top-0',
                                'start-0',
                                'h-100',
                                'd-md-block',
                                'd-none',
                            ])>
                                <div @class([
                                    'oblique-image',
                                    'position-absolute',
                                    'd-flex',
                                    'fixed-top',
                                    'ms-auto',
                                    'h-100',
                                    'z-index-0',
                                    'bg-cover',
                                    'me-n8',
                                ])
                                    style="background-image:url('../assets/img/image-sign-up.jpg')">
                                    <div @class(['my-auto', 'text-start', 'max-width-350', 'ms-7'])>
                                        <h1 @class(['mt-3', 'text-white', 'font-weight-bolder'])>Start your <br> new journey.</h1>

                                    </div>
                                    <div @class(['text-start', 'position-absolute', 'fixed-bottom', 'ms-7'])>
                                        <h6 @class(['text-white', 'text-sm', 'mb-5'])>Copyright
                                            ©
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
                        <div @class(['col-md-4', 'd-flex', 'flex-column', 'mx-auto'])>
                            <div @class(['card', 'card-plain', 'mt-8'])>
                                <div @class(['card-header', 'pb-0', 'text-left', 'bg-transparent'])>
                                    <h3 @class(['font-weight-black', 'text-dark', 'display-6'])>Sign up</h3>
                                    <p @class(['mb-0'])>Nice to meet you! Please enter your details.</p>
                                </div>
                                <div @class(['card-body'])>
                                    <form role="form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <label>Prénoms</label>
                                        <div @class(['mb-3'])>
                                            <input type="text" id="firstname" name="firstname"
                                                @class(['form-control']) placeholder="Entrer your Prénoms"
                                                value="{{ old('firstname') }}" aria-label="Name"
                                                aria-describedby="firstname-addon">
                                            @error('firstname')
                                                <span @class(['text-danger', 'text-sm'])>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Nom</label>

                                        <div @class(['mb-3'])>
                                            <input type="text" id="lastname" name="lastname"
                                                @class(['form-control']) placeholder="Enter your Nom"
                                                value="{{ old('lastname') }}" aria-label="Name"
                                                aria-describedby="lastname-addon">
                                            @error('lastname')
                                                <span @class(['text-danger', 'text-sm'])>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Email Address</label>
                                        <div @class(['mb-3'])>
                                            <input type="email" id="email" name="email"
                                                @class(['form-control']) placeholder="Enter your email address"
                                                value="{{ old('email') }}" aria-label="Email"
                                                aria-describedby="email-addon">
                                            @error('email')
                                                <span @class(['text-danger', 'text-sm'])>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div @class(['mb-3'])>
                                            <input type="password" id="password" name="password"
                                                @class(['form-control']) placeholder="Create a password"
                                                aria-label="Password" aria-describedby="password-addon">
                                            @error('password')
                                                <span @class(['text-danger', 'text-sm'])>{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label>Password</label>
                                        <div @class(['mb-3'])>
                                            <input type="password" id="password-confirm" name="password_confirmation"
                                                @class(['form-control']) placeholder="Create a password"
                                                aria-label="Password" aria-describedby="password-addon">
                                            @error('password-confirm')
                                                <span @class(['text-danger', 'text-sm'])>{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div @class(['text-center'])>
                                            <button type="submit" @class(['btn', 'btn-dark', 'w-100', 'mt-4', 'mb-3'])>Sign up</button>

                                        </div>
                                    </form>
                                </div>
                                <div @class(['card-footer', 'text-center', 'pt-0', 'px-lg-2', 'px-1'])>
                                    <p @class(['mb-4', 'text-xs', 'mx-auto'])>
                                        Already have an account?
                                        <a href="{{ route('login') }}" @class(['text-dark', 'font-weight-bold'])>Sign
                                            in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>
