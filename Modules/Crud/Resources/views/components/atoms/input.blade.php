@props(['placeholder', 'name'])
<input {{ $attributes }}  class="form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}" name="{{ $name }}">
