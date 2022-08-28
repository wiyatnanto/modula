<x-crud::organisms.modal preventSubmit="update({{ $moduleName }})" submitLabel="Update" id="updateModule"
    title="Update Permission">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <x-crud::atoms.input type="text" placeholder="Name" name="name" wire:model="name" />
            @error('name')
                <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
            @enderror
        </div>
</x-crud::organisms.modal>
