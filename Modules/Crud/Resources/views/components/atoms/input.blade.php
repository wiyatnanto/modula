@props(['size' => null])
@php
if (isset($size)) {
    $size = 'form-control-' . $size;
    // dd($size);
}
@endphp
<input type="text"
    {{ $attributes->merge(['class' => $errors->has($attributes->whereStartsWith('wire:model')->first()) ? "form-control ${size} is-invalid" : "form-control ${size}"]) }}>
