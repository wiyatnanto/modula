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
@push('script')
    <script>
        $(function() {
            window.livewire.on('toast', data => {
                const type = data[0];
                const message = data[1];
                let icon = 'fa fa-check mr-1';
                switch (type) {
                    case 'success':
                        $.toast({
                            text: message,
                            position: 'top-center',
                            loaderBg: '#0bb197'
                        });
                        break;
                    case 'error':
                        $.toast({
                            text: message,
                            position: 'top-center',
                            loaderBg: '#ff3d60'
                        });
                        break;
                    case 'info':
                        $.toast({
                            text: message,
                            position: 'top-center',
                            loaderBg: '#2c6299'
                        });
                        break;
                    case 'warning':
                        $.toast({
                            text: message,
                            position: 'top-center',
                            loaderBg: '#fcb92c'
                        });
                        break;
                    default:
                        $.toast({
                            text: message,
                            position: 'top-center',
                            loaderBg: '#0bb197'
                        });
                        break;
                }
            });
        })
    </script>
@endpush
