@props(['size' => 'md', 'color' => 'primary'])
<button {{ $attributes->merge(['class' => "btn btn-${size} btn-${color}"]) }}>
    {{ $slot }}
</button>
