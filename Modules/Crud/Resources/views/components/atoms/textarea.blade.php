@props(['placeholder' => ''])
<textarea
    {{ $attributes->merge(['class' => $errors->has($attributes->whereStartsWith('wire:model')->first()) ? 'form-control is-invalid' : 'form-control']) }}
    placeholder="{{ $placeholder }}"></textarea>
