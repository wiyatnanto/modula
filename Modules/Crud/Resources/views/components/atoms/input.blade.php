@props(['placeholder', 'name', 'id'])
<input {{ $attributes }}  class="form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}">
