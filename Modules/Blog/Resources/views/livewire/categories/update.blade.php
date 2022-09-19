<x-crud::organisms.modal preventSubmit="update({{ $categoryId }})" submitLabel="Update" id="updateCategory"
    title="Update Page">
    <x-slot name="header">
        <h5 class="modal-title">Update Post Category</h5>
    </x-slot>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <x-crud::atoms.input type="text" placeholder="Category Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" text="Update" wire:click.prevent="update" />
    </x-slot>
</x-crud::organisms.modal>
