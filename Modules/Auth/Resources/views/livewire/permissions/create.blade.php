<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createPermission" title="Crate Permission">
    <div class="mb-3">
        <strong>Name:</strong>
        <x-crud::atoms.input type="text" placeholder="Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
</x-crud::organisms.modal>
