@props(['size' => null, 'type' => 'text'])
@php
if (isset($size)) {
    $size = 'form-control-' . $size;
}
@endphp
<input type="{{ $type }}"
    {{ $attributes->merge(['class' => $errors->has($attributes->whereStartsWith('wire:model')->first()) ? "form-control ${size} is-invalid" : "form-control ${size}"]) }}>
