<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createUser" title="Crate User">
    @if ($createMode)
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
            <strong>Role:</strong>
            <x-crud::atoms.select2 name="roles" dropdownParent="createUser" id="selectRolesb">
                <option></option>
                @foreach ($rolesOptions as $val)
                    <option value="{{ $val }}">{{ $val }}</option>
                @endforeach
            </x-crud::atoms.select2>
            @error('roles')
                <label id="password_confirmation-error" class="error invalid-feedback"
                    for="roles">{{ $message }}</label>
            @enderror
        </div>
    @endif
</x-crud::organisms.modal>
@once
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-wrapper {
            position: relative,
                top: 0px,
                right: 100px,
        }
    </style>
    @push('script')
        <script>
            $(function() {
                $('#createUser').on('hide.bs.modal', function() {
                    livewire.emit('resetInputFields');
                });
                window.addEventListener('openModalCreate', event => {
                    $('#createUser').modal('show');
                });
                window.addEventListener('closeModalCreate', event => {
                    $('#createUser').modal('hide');
                    livewire.emit('resetInputFields');
                });
            });
        </script>
    @endpush
@endonce
