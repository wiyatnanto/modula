<x-crud::organisms.modal id="updateRole">
    <x-slot name="header">
        <h5 class="modal-title">Update Role</h5>
    </x-slot>
    <div class="mb-3">
        <label for="name" class="form-label">Role Name</label>
        <x-crud::atoms.input type="text" placeholder="Role Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="permissions" class="form-label">Permission</label>
        <x-crud::atoms.select2 dropdownParent="updateRole" name="permissions" wire:model.defer="permissions"
            multiple="multiple">
            @foreach ($permissionsOptions as $key => $val)
                <option value="{{ $key }}" @if (in_array($key, $permissions)) selected @endif">
                    {{ $val }}</option>
            @endforeach
        </x-crud::atoms.select2>
        @error('permissions')
            <label class="error invalid-feedback" for="permissions">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" wire:click.prevent="update({{ $roleId }})"
            text="Update" />
    </x-slot>
</x-crud::organisms.modal>
