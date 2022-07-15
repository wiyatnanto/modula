@props(['placeholder', 'name', 'id'])
<div>
    <input wire.model="name" class="form-control @error('{{ $name }}') is-invalid @enderror">
</div>
