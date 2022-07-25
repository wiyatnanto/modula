@props(['label' => null, 'id'])
<div class="form-check form-switch">
    <input {{ $attributes }} class="form-check-input" id="{{$id}}">
    <label class="form-check-label" for="{{$id}}">{{ $label }}</label>
</div>