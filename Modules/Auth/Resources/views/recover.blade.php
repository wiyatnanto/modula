@extends('theme::backend.layouts.auth')

@section('content')
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-8">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="">
                            <div class="text-center">
                                <a href="{{ url('/') }}" class="">
                                    <img src="{{ asset('modules/theme/backend/images/logo-dark.png') }}" alt="" height="40" class="auth-logo logo-dark mx-auto mb-3">
                                    <img src="{{ asset('modules/theme/backend/images/logo-light.png') }}" alt="" height="40" class="auth-logo logo-light mx-auto mb-3">
                                </a>
                            </div>
                            <!-- end row -->
                            <h4 class="font-size-18 text-muted mt-2 text-center">Registrasi!</h4>
                            <p class="mb-4 text-center">Daftar segera di TK Perintis</p>
                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            Masukkan <b>Email</b> and ikuti instruksi yang dikirimkan!
                                        </div>

                                        <div class="mt-4">
                                            <label class="form-label" for="useremail">Email</label>
                                            <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                        </div>
                                        <div class="d-grid mt-4">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Kirim Email</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p class="text-white-50">Belum memiliki Akun ? <a href="{{ url('auth/register') }}" class="fw-medium text-primary"> Daftar </a> </p>
                    {{-- <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> Upzet. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p> --}}
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end Account pages -->
@endsection
