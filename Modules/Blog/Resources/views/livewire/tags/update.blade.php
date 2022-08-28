<x-crud::organisms.modal preventSubmit="update({{ $tagId }})" submitLabel="Update" id="updateTag"
    title="Update Tag">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <x-crud::atoms.input type="text" placeholder="Name" name="title" wire:model="title" />
        @error('title')
            <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
</x-crud::organisms.modal>
