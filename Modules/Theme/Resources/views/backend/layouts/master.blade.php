<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <title>Modula Platform</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <link rel="stylesheet" href="{{ asset('modules/theme/backend/vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('modules/theme/backend/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/vendor/jquery.toast/jquery.toast.min.css') }}">

    <link rel="stylesheet" href="{{ asset('modules/theme/backend/fonts/fontawesome-pro/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('modules/theme/backend/css/light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('modules/theme/backend/images/favicon.png') }}" />
    @stack('style')

    @vite('resources/js/app.js')
    @livewireStyles

    <style>
        .ps {
            overflow: hidden !important;
            overflow-anchor: none;
            -ms-overflow-style: none;
            touch-action: auto;
            -ms-touch-action: auto
        }

        .ps__rail-x {
            display: none;
            opacity: 0;
            transition: background-color .2s linear, opacity .2s linear;
            -webkit-transition: background-color .2s linear, opacity .2s linear;
            height: 15px;
            bottom: 0;
            position: absolute
        }

        .ps__rail-y {
            display: none;
            opacity: 0;
            transition: background-color .2s linear, opacity .2s linear;
            -webkit-transition: background-color .2s linear, opacity .2s linear;
            width: 15px;
            right: 0;
            position: absolute
        }

        .ps--active-x>.ps__rail-x,
        .ps--active-y>.ps__rail-y {
            display: block;
            background-color: transparent
        }

        .ps--focus>.ps__rail-x,
        .ps--focus>.ps__rail-y,
        .ps--scrolling-x>.ps__rail-x,
        .ps--scrolling-y>.ps__rail-y,
        .ps:hover>.ps__rail-x,
        .ps:hover>.ps__rail-y {
            opacity: .6
        }

        .ps .ps__rail-x.ps--clicking,
        .ps .ps__rail-x:focus,
        .ps .ps__rail-x:hover,
        .ps .ps__rail-y.ps--clicking,
        .ps .ps__rail-y:focus,
        .ps .ps__rail-y:hover {
            background-color: #eee;
            opacity: .9
        }

        .ps__thumb-x {
            background-color: #aaa;
            border-radius: 6px;
            transition: background-color .2s linear, height .2s ease-in-out;
            -webkit-transition: background-color .2s linear, height .2s ease-in-out;
            height: 6px;
            bottom: 2px;
            position: absolute
        }

        .ps__thumb-y {
            background-color: #aaa;
            border-radius: 6px;
            transition: background-color .2s linear, width .2s ease-in-out;
            -webkit-transition: background-color .2s linear, width .2s ease-in-out;
            width: 6px;
            right: 2px;
            position: absolute
        }

        .ps__rail-x.ps--clicking .ps__thumb-x,
        .ps__rail-x:focus>.ps__thumb-x,
        .ps__rail-x:hover>.ps__thumb-x {
            background-color: #999;
            height: 11px
        }

        .ps__rail-y.ps--clicking .ps__thumb-y,
        .ps__rail-y:focus>.ps__thumb-y,
        .ps__rail-y:hover>.ps__thumb-y {
            background-color: #999;
            width: 11px
        }

        @supports (-ms-overflow-style:none) {
            .ps {
                overflow: auto !important
            }
        }

        @media screen and (-ms-high-contrast:active),
        (-ms-high-contrast:none) {
            .ps {
                overflow: auto !important
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <x-theme::organisms.sidebar />
        <div class="page-wrapper">
            <x-theme::organisms.header />
            <div class="page-content">
                <div>@yield('content')</div>
            </div>
            <x-theme::organisms.footer />
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('modules/theme/backend/vendor/jquery/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('modules/theme/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('modules/theme/backend/vendor/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('modules/theme/backend/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/select2/select2.multi-checkboxes.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/jquery.toast/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/bootbox/bootbox.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('modules/theme/backend/js/template.js') }}"></script>
    <!-- endinject -->

    <x-theme::molecules.toast />
    <!-- Custom js for this page -->
    @stack('script')
    <!-- End custom js for this page -->
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>
