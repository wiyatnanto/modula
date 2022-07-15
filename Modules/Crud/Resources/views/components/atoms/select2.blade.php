@props(['placeholder' => 'Select Roles', 'id'])
<div wire:ignore>
    <div x-data="{ selected: @entangle('roles') }" x-init="select = $($refs.select).select2({
        allowClear: true,
        dropdownParent: $('#createModal')
    });
    select.on('change', function(e) {
        @this.set('roles', select.select2('data').map(e => e.id))
    });
    $('#createModal').on('hide.bs.modal', function() {
        select.val('');
        select.trigger('change');
    });">
        <select {{ $attributes }} x-ref="select" class="js-example-basic-multiple form-select" multiple="multiple" placeholder="{{ $placeholder }}" id="{{ $id }}">
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
    @endpush
@endonce
