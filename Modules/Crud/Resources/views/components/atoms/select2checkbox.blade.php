@props([
    'placeholder' => 'Select',
    'dropdownParent' => null,
    'closeOnSelect' => true,
    'tags' => false,
])
<div
    {{ $attributes->merge(['class' => $errors->has($attributes->whereStartsWith('wire:model')->first()) ? 'is-invalid' : '']) }}>
    <div wire:ignore>
        <div x-data="{ selected: $wire.entangle('{{ $attributes->whereStartsWith('wire:model')->first() }}') }" x-init="() => {
            const select = $($refs.select)
        
            function initSelect() {
                select.select2MultiCheckboxes({
                    templateSelection: function(selected, total) {
                        return 'Pilih kategori ' + (selected.length > 0 ? '( ' + selected.length + ' )' : '');
                    }
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
        
            initSelect();
        
            select.val(selected).trigger('change');
        
            select.on('change', function(e) {
                @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', select.val(), false)
            });
        
            $watch('selected', (value) => {
                select.val(value).trigger('change.select2');
            });
        
            {{-- $(window).on('hidden.bs.modal', function() {
                select.val(null).trigger('change');
            }); --}}
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

            .select2-container--default .select2-results__option[aria-selected=true] {
                background-color: transparent !important;
            }

            .select2-results__option--highlighted {
                background-color: rgba(13, 110, 253, 0.1) !important;
                color: #000000 !important;
            }

            .select2-container--default .select2-results__option .wrap:before {
                font-family: 'Font Awesome 5 Pro';
                color: var(--bs-primary);
                font-size: 18px;
                content: "\f0c8";
                padding-right: 10px;
            }

            .select2-container--default .select2-results__option[aria-selected=true] .wrap::before {
                font-family: 'Font Awesome 5 Pro';
                font-weight: 900;
                color: var(--bs-primary);
                font-size: 18px;
                content: "\f14a";
                padding-right: 10px;
            }

            .select2-container--default .select2-selection--single .select2-selection__clear {
                right: 18px;
                top: 1px;
                color: #888888;
            }
        </style>
    @endpush
@endonce
