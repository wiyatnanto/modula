<x-crud::organisms.modal size="md" id="createStoreFront">
    <x-slot name="header">
        <h5 class="modal-title">{{ __('crud::messages.add') }} {{ __('store::messages.storefront') }}</h5>
    </x-slot>
    <x-crud::molecules.form-control name="name" label="{{ __('store::messages.storefront_name') }}">
        <x-crud::atoms.input wire:model="name" />
    </x-crud::molecules.form-control>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="{{ __('crud::messages.cancel') }}" />
        <x-crud::atoms.button size="sm" color="primary" text="{{ __('crud::messages.add') }}" wire:click.prevent="store" />
    </x-slot>
</x-crud::organisms.modal>
