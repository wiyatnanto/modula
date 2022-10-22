@props([
    'placeholder' => 'Select',
    'dropdownParent' => null,
    'closeOnSelect' => true,
    'tag' => false,
])
<div
    {{ $attributes->merge(['class' => $errors->has($attributes->whereStartsWith('wire:model')->first()) ? 'is-invalid' : null]) }}>
    <div wire:ignore>
        <div x-data="{ selected: @entangle($attributes->whereStartsWith('wire:model')->first()) }" x-init="() => {
            let select = $($refs.select)
        
            function initSelect() {
                select.select2({
                    placeholder: 'Select here',
                    closeOnSelect: true,
                    dropdownClass: 'select2-on-modal',
                    tags: '{{ $tag }}'
                });
                select.on('select2:open', function(e) {
                    $('.select2-container').css('z-index', 99999);
                });
                select.on('select2:close', function(e) {
                    $('.select2-container').css('z-index', 1);
                });
            }
            window.livewire.on('select2', () => {
                initSelect()
            });
        
            initSelect()
        
            select.on('change', function(e) {
                @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', $(this).val(), false)
            });
        
            $watch('selected', (value) => {
                select.val(value).trigger('change.select2');
            });
        }">
            <select {{ $attributes }} x-ref="select" class="form-select" placeholder="{{ $placeholder }}">
                {{ $slot }}
            </select>
        </div>
    </div>
</div>
@once
    @push('style')
        <style>
            .select2-container {
                width: -moz-available !important;
                width: -webkit-fill-available !important;
            }

            .select2-search__field {
                width: 100% !important;
            }

            .is-invalid .select2 .select2-selection {
                border-color: #ff3366;
            }
        </style>
    @endpush
@endonce
