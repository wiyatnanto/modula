@props(['placeholder' => 'Select Roles', 'dropdownParent' => null, 'name'])
<div wire:ignore wire:key="{{ $dropdownParent }}">
    <div x-data="{ selected: @entangle('roles') }" x-init="() => {
        select2 = $($refs.select).select2({
            placeholder: 'Select here',
            dropdownParent: $('#{{ $dropdownParent }}')
        });
        window.livewire.hook('message.processed', (message, component) => {
            //initSelect()
        });
        console.log(selected)
        select2.on('select2:select', (event) => {
            selected = select2.select2('data').map(e => e.id);
        });
        select2.on('select2:unselect', (event) => {
            selected = select2.select2('data').map(e => e.id);
        });
        $watch('selected', (value) => {
            alert('asdasd{{ $dropdownParent }}' + selected)
        });
    
        function initSelect() {
            select2.select2({
                placeholder: 'Select herexxx',
                dropdownParent: $('#{{ $dropdownParent }}')
            })
        }
    }">{{ $attributes->wire('selected') }}
        <select {{ $attributes }} x-ref="select" class="form-select @error($name) is-invalid @enderror"
            multiple="multiple" placeholder="{{ $placeholder }}" wire:key="{{ $dropdownParent }}"
            id="{{ $dropdownParent }}">
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
@endonce
