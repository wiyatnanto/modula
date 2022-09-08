@props(['type' => 'far', 'icon'])
<i {{ $attributes->merge(['class' => isset($icon) ? "${type} fa-${icon}" : ""]) }}></i>
