@props(['name', 'label'])
<div class="mb-3">
    <div @error($name) class="is-invalid" @enderror>
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        {{ $slot }}
        @error($name)
            <label id="{{ $name }}-error" class="error invalid-feedback"
                for="{{ $name }}">{{ $message }}</label>
        @enderror
    </div>
</div>
