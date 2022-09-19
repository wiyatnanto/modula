<x-crud::organisms.modal size="xl" preventSubmit="update" submitLabel="Update" id="updatePage"
    title="Update Page">
    <x-slot name="header">
        <h5 class="modal-title">Update Page</h5>
    </x-slot>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <x-crud::atoms.input type="text" placeholder="Name" name="title" wire:model="title" />
        @error('title')
            <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <x-crud::atoms.froala-editor height="350" placeholder="Title" name="content" wire:model="content" />
        @error('content')
            <label id="content-error" class="error invalid-feedback" for="content">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" text="Update" wire:click.prevent="update" />
    </x-slot>
</x-crud::organisms.modal>
