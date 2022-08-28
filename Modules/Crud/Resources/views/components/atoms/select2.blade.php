@props([
    'placeholder' => 'Select',
    'dropdownParent' => null,
    'closeOnSelect' => true,
    'tags' => false
])
<div>
    <div wire:ignore>
        <div x-data="{ select: null, selected: @entangle($attributes->whereStartsWith('wire:model')->first()) }" x-init="() => {
            function initSelect() {
                select = $($refs.select).select2({
                    placeholder: 'Select here',
                    closeOnSelect: true,
                    dropdownClass: 'select2-on-modal',
                    tags: '{{ $tags }}',
                    //minimumResultsForSearch: -1,
                    //ajax: {
                    //    url: 'http://modula.com.test/api/survey/options',
                    //    dataType: 'json'
                    //}
                });
                select.on('select2:open', function(e) {
                    //$('.select2-container').css('z-index', 99999);
                });
            }
            window.livewire.on('select2', () => {
                initSelect()
            });
            initSelect()
        
            select.on('change', function(e) {
                @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', $(this).val(), false)
            });
        
            $(window).on('hidden.bs.modal', function() {
                //select.val([]).trigger('change');
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
        </style>
    @endpush
@endonce
