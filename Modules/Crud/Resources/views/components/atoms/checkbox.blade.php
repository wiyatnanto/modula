@props(['label' => null])
<div class="form-check">
    <input {{ $attributes }} type="checkbox" class="form-check-input">
    <label class="form-check-label" for="checkDefault">
        {{ $label }}
    </label>
</div>
