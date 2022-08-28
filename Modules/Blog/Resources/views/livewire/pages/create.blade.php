<x-crud::organisms.modal size="xl" preventSubmit="store()" submitLabel="Create" id="createPage" title="Create Page">
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
</x-crud::organisms.modal>
