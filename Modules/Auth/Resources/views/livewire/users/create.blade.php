<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createUser" title="Crate User">
    <x-slot name="header">
        <h5 class="modal-title">Create User</h5>
    </x-slot>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <x-crud::atoms.input type="text" placeholder="Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <x-crud::atoms.input type="email" placeholder="Email" name="email" wire:model="email" />
        @error('email')
            <label id="email-error" class="error invalid-feedback" for="email">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <x-crud::atoms.input type="password" placeholder="Password" name="password" wire:model="password" />
        @error('password')
            <label id="password-error" class="error invalid-feedback" for="password">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <x-crud::atoms.input type="password" placeholder="Confirm Password" name="password_confirmation"
            wire:model="password_confirmation" />
        @error('password_confirmation')
            <label id="password_confirmation-error" class="error invalid-feedback"
                for="password_confirmation">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="roles" class="form-label">Role</label>
        <x-crud::atoms.select2 dropdownParent="createUser" wire:model.defer="roles" multiple="multiple">
            @foreach ($rolesOptions as $val)
                <option value="{{ $val }}">{{ $val }}</option>
            @endforeach
        </x-crud::atoms.select2>
        @error('roles')
            <label id="password_confirmation-error" class="error invalid-feedback"
                for="roles">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" wire:click.prevent="store"
            text="Create" />
    </x-slot>
</x-crud::organisms.modal>
