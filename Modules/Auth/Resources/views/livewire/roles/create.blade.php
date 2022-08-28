<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createRole" title="Create Roles">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <x-crud::atoms.input type="text" placeholder="Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="permissions" class="form-label">Permission {{ json_encode($permissions) }}</label>
        <x-crud::atoms.select2 name="permissions" dropdownParent="createRole" closeOnSelect="false"
            wire:model.defer="permissions" multiple="multiple">
            @foreach ($permissionsOptions as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </x-crud::atoms.select2>
        @error('permissions')
            <label id="password_confirmation-error" class="error invalid-feedback"
                for="permissions">{{ $message }}</label>
        @enderror
    </div>
</x-crud::organisms.modal>
