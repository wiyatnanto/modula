@props(['label' => 'Dropdown', 'color' => 'primary', 'openOnHover' => false])
<div x-data="{
    open: false
}">
    <div class="dropdown">
        <x-crud::atoms.button size="xs" color="{{ $color }}" class="dropdown-toggle btn-icon-text"
            data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"
            x-on:click="open=!open">
            {{ $label }}
            {{-- <div x-show="open">
                <x-crud::atoms.icon icon="angle-up" class="btn-icon-append" />
            </div>
            <div x-show="!open">
                <x-crud::atoms.icon icon="angle-down" class="btn-icon-append" />
            </div> --}}
        </x-crud::atoms.button>
        <div class="dropdown-menu">
            {{ $slot }}
        </div>
    </div>
</div>
@push('style')
@endpush
