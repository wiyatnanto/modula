<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="modula">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site_name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/fonts/fontawesome-pro/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    @stack('style')
    @vite('resources/js/app.js')
</head>

<body>
    <div class="main-wrapper">
        @yield('content')
    </div>
    <script src="{{ asset('js/theme.js') }}"></script>
    <x-theme::molecules.toast />
</body>

</html>
