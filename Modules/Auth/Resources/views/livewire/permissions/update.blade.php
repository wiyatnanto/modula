<x-crud::organisms.modal id="updatePermission">
    <x-slot name="header">
        <h5 class="modal-title">Update Permission</h5>
    </x-slot>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <x-crud::atoms.input type="text" placeholder="Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="xs" color="secondary" data-bs-dismiss="modal" text="Cancel" />
        <x-crud::atoms.button size="xs" color="primary" wire:click.prevent="update({{ $permissionId }})"
            text="Update" />
    </x-slot>
</x-crud::organisms.modal>
