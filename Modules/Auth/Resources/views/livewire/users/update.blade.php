<x-crud::organisms.modal preventSubmit="update({{ $userId }})" submitLabel="Update" id="updateUser"
    title="Update User">
        <div class="mb-3">
            <strong>Name:</strong>
            <x-crud::atoms.input type="text" placeholder="Name" name="name" wire:model="name" />
            @error('name')
                <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            <strong>Email:</strong>
            <x-crud::atoms.input type="email" placeholder="Email" name="email" wire:model="email" />
            @error('email')
                <label id="email-error" class="error invalid-feedback" for="email">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            <strong>Password:</strong>
            <x-crud::atoms.input type="password" placeholder="Password" name="password" wire:model="password" />
            @error('password')
                <label id="password-error" class="error invalid-feedback" for="password">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            <strong>Confirm Password:</strong>
            <x-crud::atoms.input type="password" placeholder="Confirm Password" name="password_confirmation"
                wire:model="password_confirmation" />
            @error('password_confirmation')
                <label id="password_confirmation-error" class="error invalid-feedback"
                    for="password_confirmation">{{ $message }}</label>
            @enderror
        </div>
        <div class="mb-3">
            <strong>Role: {{ json_encode($roles) }}</strong>
            <x-crud::atoms.select2 dropdownParent="updateUser" name="roles" wire:model.defer="roles" multiple="multiple">
                @foreach ($rolesOptions as $val)
                    <option value="{{ $val }}" @if (in_array($val, $roles)) selected @endif">
                        {{ $val }}</option>
                @endforeach
            </x-crud::atoms.select2>
            @error('roles')
                <label id="password_confirmation-error" class="error invalid-feedback"
                    for="roles">{{ $message }}</label>
            @enderror
        </div>
</x-crud::organisms.modal>
