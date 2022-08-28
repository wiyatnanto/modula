@props(['placeholder' => ''])
<input
    {{ $attributes->merge(['class' => $errors->has($attributes->whereStartsWith('wire:model')->first()) ? 'form-control is-invalid' : 'form-control']) }}
    placeholder="{{ $attributes->whereStartsWith('wire:model')->first() }}">
