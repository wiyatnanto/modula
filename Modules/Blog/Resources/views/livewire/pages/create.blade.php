<x-crud::organisms.modal size="xl" preventSubmit="store()" submitLabel="Create" id="createPage" title="Create Page">
    <x-slot name="header">
        <h5 class="modal-title">Add New Page</h5>
    </x-slot>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <x-crud::atoms.input placeholder="Title" name="title" wire:model="title" />
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
        <x-crud::atoms.button size="sm" color="primary" text="Create" wire:click.prevent="store" />
    </x-slot>
</x-crud::organisms.modal>
