@props(['label' => null, 'checked' => false])
<div class="form-check form-switch">
    <input type="checkbox" {{ $attributes }} class="form-check-input"
        id="{{ $attributes->whereStartsWith('wire:model')->first() }}" @checked($checked) />
    <label class="form-check-label"
        for="{{ $attributes->whereStartsWith('wire:model')->first() }}">{{ $label }}</label>
</div>
