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
                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="name">Nama Peserta Didik</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan Nama Peserta Didik">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="useremail">Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="useremail" name="email" value="admin@perintis.sch.id" placeholder="Masukkan email">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="userpassword">Kata Sandi</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password" placeholder="Masukkan kata sandi">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="term-conditionCheck">
                                            <label class="form-check-label fw-normal" for="term-conditionCheck">Saya setuju <a href="#" class="text-primary">Terms and Conditions</a></label>
                                        </div>
                                        <div class="d-grid mt-4">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Daftar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p class="text-white-50">Sudah memiliki Akun ? <a href="{{ url('auth/login')}}" class="fw-medium text-primary"> Login </a> </p>
                    {{-- <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> Upzet. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p> --}}
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end Account pages -->
@endsection
