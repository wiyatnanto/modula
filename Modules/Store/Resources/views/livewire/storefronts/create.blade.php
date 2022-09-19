<x-crud::organisms.modal size="md" id="createStoreFront">
    <x-slot name="header">
        <h5 class="modal-title">Add New Store Front</h5>
    </x-slot>
    <x-crud::molecules.form-control name="name" label="Store Front Name">
        <x-crud::atoms.input wire:model="name" />
    </x-crud::molecules.form-control>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" text="Create" wire:click.prevent="store" />
    </x-slot>
</x-crud::organisms.modal>
