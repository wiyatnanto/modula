@props(['placeholder' => 'Select Roles', 'dropdownParent' => null, 'name', 'id' => null])
<div wire:ignore>
    <div x-data="{ model: @entangle('roles'), }" x-init="select = $($refs.select).not('.select2-hidden-accessible').select2({
        width: 'resolve',
        closeOnSelect: false,
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
        select.val(model);
        select.trigger('change');
    });
    $watch('model', (value) => {
        select.trigger('change');
    });
    ">
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
