<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createSurvey" title="Create Survey">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <x-crud::atoms.input type="text" placeholder="Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="bg_header" class="form-label">Background Image</label>
        <x-crud::atoms.filepond placeholder="Background Image" name="bg_header" wire:model="bg_header" />
        @error('bg_header')
            <label id="bg_header-error" class="error invalid-feedback" for="bg_header">{{ $message }}</label>
        @enderror
    </div>
</x-crud::organisms.modal>
