@props(['size', 'color' => 'default', 'text'])
<button {{ $attributes }} class="btn btn-{{ $size }} btn-{{ $color }}">{{ $text }}</button>
