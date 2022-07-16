@props(['placeholder' => 'Select Roles', 'dropdownParent' => null, 'name', 'id' => null])
<div wire:ignore>
    <div x-data="{ model: @entangle('roles'), }" x-init="select = $($refs.select).select2({
        placeholder: 'Select here',
        dropdownParent: $('#{{ $dropdownParent }}')
    });
    select.on('select2:select', (event) => {
        console.log('select', select.select2('data').map(e => e.id))
        model = select.select2('data').map(e => e.id)
    });
    
    select.on('select2:unselect', (event) => {
        console.log('unselect', select.select2('data').map(e => e.id))
        model = select.select2('data').map(e => e.id)
    
    });
    $('#{{ $dropdownParent }}').on('hide.bs.modal', function() {
        alert('hide')
        select.val(model);
        select.trigger('change');
    });">
        <select {{ $attributes }} x-ref="select"
            class="form-select {{ $name }} @error($name) is-invalid @enderror" multiple="multiple"
            placeholder="{{ $placeholder }}" id="{{ $id }}">
            {{ $slot }}
        </select>
    </div>
</div>

@once
    @push('style')
        <style>
            .select2-container {
                width: 100% !important;
            }
        </style>
    @endpush
    @push('script')
        <script>
            $('.form-select').select2({
                placeholder: 'Select here',
                dropdownParent: $('#{{ $dropdownParent }}')
            });
        </script>
    @endpush
@endonce
