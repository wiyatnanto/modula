<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createPage" title="Create Page">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <x-crud::atoms.input type="text" placeholder="Title" name="title" wire:model="title" />
        @error('title')
            <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
</x-crud::organisms.modal>