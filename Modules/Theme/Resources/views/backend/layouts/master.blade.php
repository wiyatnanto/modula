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
    <title>{{ config('core.siteName') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('modules/theme/backend/fonts/fontawesome-pro/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    @googlefonts

    @stack('style')
    @vite('resources/js/app.js')
    @livewireStyles
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

    {{-- <script src="{{ asset('modules/theme/backend/vendor/jquery/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('modules/theme/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/select2/select2.multi-checkboxes.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/jquery.toast/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('modules/theme/backend/vendor/bootbox/bootbox.min.js') }}"></script> --}}
    <script src="{{ asset('js/theme.js') }}"></script>
    <x-theme::molecules.toast />

    {{-- <script src="{{ asset('js/chat.js') }}" defer></script> --}}
    {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('0065ae67d471dc7f2f3b', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('chat.{{ auth()->user()->id }}');
        channel.bind('Modules\\Chat\\Events\\MessageSent', function(data) {
            window.livewire.emitTo('chat::chat.chatbox', 'broadcastedMessageReceived', data)
        });
        channel.bind('Modules\\Chat\\Events\\MessageRead', function(data) {
            window.livewire.emitTo('chat::chat.chatbox', 'broadcastedMessageRead', data)
        });
    </script> --}}

    @stack('script')
    @livewireScripts

    {{-- <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script> --}}
    {{-- <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script> --}}
</body>

</html>
