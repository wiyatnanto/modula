<x-crud::organisms.modal preventSubmit="update({{ $userId }})" submitLabel="Update" id="updateUser"
    title="Update User">
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
@push('script')
    <script>
        // Livewire.on('toast', data => {
        //     alert('asdas')
        // })
    </script>
@endpush
