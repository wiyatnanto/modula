@props(['label' => null, 'inline' => false])
<div class="form-check {{ $inline ? 'form-check-inline' : 'form-check' }}">
    <input {{ $attributes }} type="radio" class="form-check-input" />
    <label class="form-check-label" for="checkDefault">
        {{ $label }}
    </label>
</div>
