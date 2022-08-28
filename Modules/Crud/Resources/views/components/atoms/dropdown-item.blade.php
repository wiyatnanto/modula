@props(['to' => null, 'name', 'value'])
<a @if ($to) href="{{ $to }}" @endif
    {{ $attributes->merge([
        'class' => 'dropdown-item ',
    ]) }}
    @if ($value) @click="() => { 
        @this.set(model,'{{ $value }}') 
        open = false
        text = '{{ $value }}'
    }" @endif
    :class="open ? 'show' : ''">
    {{ $slot }}
</a>
