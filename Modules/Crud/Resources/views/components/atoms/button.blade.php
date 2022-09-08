@props(['size' => 'md', 'color' => 'primary', 'text' => 'Button'])
<button {{ $attributes->merge(['class' => "btn btn-${size} btn-${color}"]) }}>
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        {{ $text }}
    @endif
</button>
