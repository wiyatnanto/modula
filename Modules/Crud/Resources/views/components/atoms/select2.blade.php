@props(['placeholder' => 'Select Roles', 'dropdownParent' => null, 'name', 'closeOnSelect' => true, 'defer' => true])
<div wire:ignore>
    <div x-data="{ selected: @entangle($name) }" x-init="() => {
        function initSelect2() {
            $($refs.select).select2({
                placeholder: 'Select here',
                closeOnSelect: {{ $closeOnSelect }},
                @if($dropdownParent)
                dropdownParent: $('#{{ $dropdownParent }}')
                @endif
            });
        }
    
        initSelect2()
    
        $($refs.select).on('change', function(e) {
            @this.set('{{ $name }}', $($refs.select).val(), {{ $defer }})
        });
        window.livewire.hook('message.received', (message, component) => {
            initSelect2()
        })
        $watch('selected', (value) => {
            $($refs.select).val(selected).trigger('change');
        });
    }">
        <select {{ $attributes }} x-ref="select" class="form-select @error($name) is-invalid @enderror"
            placeholder="{{ $placeholder }}">
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

            .select2-search__field {
                width: 100% !important;
            }
        </style>
    @endpush
@endonce
