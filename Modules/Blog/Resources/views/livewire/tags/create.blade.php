<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createTag">
    <x-slot name="header">
        <h5 class="modal-title">Add New Tag</h5>
    </x-slot>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <x-crud::atoms.input type="text" placeholder="Title" name="title" wire:model="title" />
        @error('title')
            <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" text="Create" wire:click.prevent="store" />
    </x-slot>
</x-crud::organisms.modal>