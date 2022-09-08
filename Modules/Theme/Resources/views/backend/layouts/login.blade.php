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

    <title>Login - Modula Platform</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/vendor/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/vendor/jquery.toast/jquery.toast.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/vendor/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/css/light/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('modules/theme/backend/images/favicon.png') }}" />
</head>

<body>
    <div class="main-wrapper">
        @yield('content')
    </div>
    <!-- core:js -->
    <script src="{{ asset('modules/theme/backend/vendor/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('modules/theme/backend/vendor/jquery.toast/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/select2/select2.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('modules/theme/backend/vendor/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/js/template.js') }}"></script>
    <!-- endinject -->

    <x-theme::molecules.toast/>
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
</body>

</html>
