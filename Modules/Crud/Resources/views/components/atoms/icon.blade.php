@props(['icon', 'size'])
<i class="{{ $icon }}" style="width: {{ $size }};height: {{ $size }};"></i>
@once
    @push('script')
        <script>
            feather.replace()
        </script>
    @endpush
@endonce
