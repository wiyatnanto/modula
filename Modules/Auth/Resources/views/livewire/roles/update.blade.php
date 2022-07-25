<x-crud::organisms.modal preventSubmit="update({{ $roleId }})" submitLabel="Update" id="updateRole"
    title="Update Roles">
    <div class="mb-3">
        <strong>Name:</strong>
        <x-crud::atoms.input type="text" placeholder="Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <strong>Role: {{ json_encode($permissions) }}</strong>
        <x-crud::atoms.select2 dropdownParent="updateRole" name="permissions" wire:model.defer="permissions" multiple="multiple">
            @foreach ($permissionsOptions as $key =>  $val)
                <option value="{{ $key }}" @if (in_array($key, $permissions)) selected @endif">
                    {{ $val }}</option>
            @endforeach
        </x-crud::atoms.select2>
        @error('permissions')
            <label class="error invalid-feedback"
                for="permissions">{{ $message }}</label>
        @enderror
    </div>
</x-crud::organisms.modal>
