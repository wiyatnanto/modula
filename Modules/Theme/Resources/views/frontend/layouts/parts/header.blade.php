<!-- HEADER -->
<div class="header header-1">

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center no-gutters">
                <div class="col-sm-7 col-md-7 col-xs-7 col-7">
                    <div class="info">
                        <div class="info-item">
                            <i class="fal fa-phone me-1"></i> +62 812-9905-0058
                        </div>
                        <div class="info-item">
                            <i class="fal fa-envelope me-1"></i> <a href="mailto:admin@perintis.sch.id" title="">admin@perintis.sch.id</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-md-5 col-xs-5 col-5">
                    <div class="sosmed-icon float-end d-inline-flex">
                        <a href="https://www.facebook.com/TK-Perintis-108207835140580" class="fb"><i class="fab fa-facebook"></i></a> 
                        <a href="#" class="tw"><i class="fab fa-twitter"></i></a> 
                        <a href="https://www.instagram.com/tk.perintis/" class="ig"><i class="fab fa-instagram"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR SECTION -->
    <div class="navbar-main">
        <div class="container">
            <nav id="navbar-example" class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('modules/theme/frontend/images/logo.png') }}" alt="" height="45">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}"><i class="fad fa-home-heart me-2"></i> Beranda</a>
                        </li>
                        <li class="nav-item dropdown dmenu">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Sekolah
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Sejarah Pendirian</a>
                                <a class="dropdown-item" href="#">Visi dan Misi</a>
                                <a class="dropdown-item" href="#">Tenaga Pendidik</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown dmenu">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Program
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">KBM Ceria Merdeka</a>
                                <a class="dropdown-item" href="#">Cinta Sekolah</a>
                                <a class="dropdown-item" href="#">Hari Keluarga</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown dmenu">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Sarana
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Kelas</a>
                                <a class="dropdown-item" href="#">Playground</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="teachers.html">Media & Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kontak</a>
                        </li>
                        @if(auth()->check())
                        <li class="nav-item dropdown dmenu">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fad fa-user-graduate"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ url('auth/logout') }}">Keluar</a>
                            </div>
                        </li>
                        @else
                        <li class="nav-item dropdown dmenu">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fad fa-user-graduate"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('auth/login') }}">Masuk</a>
                                <a class="dropdown-item" href="{{ url('auth/register') }}">Daftar</a>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav> <!-- -->

        </div>
    </div>

</div>