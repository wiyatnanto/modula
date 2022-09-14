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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('modules/theme/backend/css/light/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('modules/theme/backend/images/favicon.png') }}" />
</head>

<body>
    <div class="main-wrapper">
        @yield('content')
    </div>
    <script src="{{ asset('modules/theme/backend/vendor/feather-icons/feather.min.js') }}"></script>
    <x-theme::molecules.toast />
</body>

</html>
