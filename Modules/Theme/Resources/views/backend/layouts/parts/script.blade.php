<script>
    $(function() {
        @if (Session::has('message'))
            $.toast({
                text: "{{ session('message') }}",
                position: 'top-center',
                loaderBg: '#0bb197'
            });
        @endif

        @if (Session::has('error'))
            $.toast({
                text: "{{ session('error') }}",
                position: 'top-center',
                loaderBg: '#ff3d60'
            });
        @endif

        @if (Session::has('info'))
            $.toast({
                text: "{{ session('info') }}",
                position: 'top-center',
                loaderBg: '#2c6299'
            });
        @endif

        @if (Session::has('warning'))
            $.toast({
                text: "{{ session('warning') }}",
                position: 'top-center',
                loaderBg: '#fcb92c'
            });
        @endif

        window.addEventListener('toast', event => {
                switch (expression) {
                    case 'message':
                        // code block
                        break;
                    case 'error':
                        // code block
                        break;
                    default:
                        // code block
                }
                if (event.detail === 'message')
                    $.toast({
                        text: "{{ session('message') }}",
                        position: 'top-center',
                        loaderBg: '#0bb197'
                    });
            @endif

            @if (Session::has('error'))
                $.toast({
                    text: "{{ session('error') }}",
                    position: 'top-center',
                    loaderBg: '#ff3d60'
                });
            @endif

            @if (Session::has('info'))
                $.toast({
                    text: "{{ session('info') }}",
                    position: 'top-center',
                    loaderBg: '#2c6299'
                });
            @endif

            @if (Session::has('warning'))
                $.toast({
                    text: "{{ session('warning') }}",
                    position: 'top-center',
                    loaderBg: '#fcb92c'
                });
            @endif
        }) $('.select2-select').select2();
    })
</script>
