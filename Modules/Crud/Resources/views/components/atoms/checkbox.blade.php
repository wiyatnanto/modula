@props(['label' => null])
<div class="form-check">
    <input
        {{ $attributes->merge(['class' => $errors->has($attributes->whereStartsWith('wire:model')->first()) ? 'form-check-input is-invalid' : 'form-check-input']) }}
        type="checkbox">
    <label class="form-check-label" for="checkDefault">
        {{ $label }}
    </label>
</div>
