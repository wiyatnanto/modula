<div>
    @if (Session::has('success'))
        <script>
            $.toast({
                text: "{{ session('success') }}",
                position: 'top-center',
                loaderBg: '#0bb197'
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            $.toast({
                text: "{{ session('error') }}",
                position: 'top-center',
                loaderBg: '#ff3d60'
            });
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            $.toast({
                text: "{{ session('info') }}",
                position: 'top-center',
                loaderBg: '#2c6299'
            });
        </script>
    @endif
    @if (Session::has('warning'))
        <script>
            $.toast({
                text: "{{ session('warning') }}",
                position: 'top-center',
                loaderBg: '#fcb92c'
            });
        </script>
    @endif
</div>
