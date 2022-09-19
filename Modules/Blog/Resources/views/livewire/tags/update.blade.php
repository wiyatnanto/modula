<x-crud::organisms.modal preventSubmit="update({{ $tagId }})" submitLabel="Update" id="updateTag"
    title="Update Tag">
    <x-slot name="header">
        <h5 class="modal-title">Update Tag</h5>
    </x-slot>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <x-crud::atoms.input type="text" placeholder="Name" name="title" wire:model="title" />
        @error('title')
            <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" text="Update" wire:click.prevent="update" />
    </x-slot>
</x-crud::organisms.modal>
