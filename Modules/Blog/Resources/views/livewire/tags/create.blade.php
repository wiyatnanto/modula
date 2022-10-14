<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createTag">
    <x-slot name="header">
        <h5 class="modal-title">Add New Tag</h5>
    </x-slot>
    <div class="mb-3">
        <label for="name" class="form-label">Tag Name</label>
        <x-crud::atoms.input type="text" placeholder="Tag Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" text="Create" wire:click.prevent="store" />
    </x-slot>
</x-crud::organisms.modal>