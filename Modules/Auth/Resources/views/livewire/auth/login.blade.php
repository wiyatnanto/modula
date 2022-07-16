<div class="page-wrapper full-page">
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper">

                            </div>
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Noble<span>UI</span></a>
                                <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                <form method="POST" class="forms-sample" action="{{ route('login.post') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">{{ __('auth::auth.email') }}</label>
                                        <x-crud::atoms.input type="email" placeholder="Email" name="email"/>
                                        @error('email')
                                            <label id="password-error" class="error invalid-feedback"
                                                for="email">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword"
                                            class="form-label">{{ __('auth::auth.password') }}</label>
                                        <x-crud::atoms.input type="password" placeholder="Password" name="password"/>
                                        @error('password')
                                            <label id="password-error" class="error invalid-feedback"
                                                for="password">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="authCheck">
                                        <label class="form-check-label" for="authCheck">
                                            {{ __('auth::auth.remember') }}
                                        </label>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="btn btn-primary me-2 mb-2 mb-md-0 text-white">{{ __('auth::auth.login') }}</button>
                                        <button type="button"
                                            class="btn btn-outline-default btn-icon-text mb-2 mb-md-0">
                                            <img src="https://img.icons8.com/color/16/000000/google-logo.png"
                                                class="me-2">
                                            {{-- <i class="btn-icon-prepend" data-feather="twitter"></i> --}}
                                            {{ __('auth::auth.loginwith') }}
                                        </button>
                                    </div>
                                    <a href="register.html"
                                        class="d-block mt-3 text-muted">{{ __('auth::auth.register') }}</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-theme::molecules.toast />
</div>
