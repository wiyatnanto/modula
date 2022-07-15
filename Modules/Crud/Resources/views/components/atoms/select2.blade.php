@props(['placeholder' => 'Select Roles', 'name', 'id'])
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
        <select {{ $attributes }} x-ref="select" class="form-select {{ $name }} @error($name) is-invalid @enderror" multiple="multiple"
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

            .was-validated .form-select:invalid+.select2 .select2-selection {
                border-color: #dc3545 !important;
            }

            .was-validated .form-select:valid+.select2 .select2-selection {
                border-color: #28a745 !important;
            }

            *:focus {
                outline: 0px;
            }
        </style>
    @endpush
    @push('script')
    @endpush
@endonce
