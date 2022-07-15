<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create User {{ json_encode($roles) }} {{ $name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Name:</strong>
                    <x-crud::atoms.input type="password" placeholder="Name" name="name" wire:model="name" />
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
                    <x-crud::atoms.input type="password" placeholder="Confirm Password" name="password_confirmation" wire:model="password_confirmation" />
                    @error('password_confirmation')
                        <label id="password_confirmation-error" class="error invalid-feedback"
                            for="password_confirmation">{{ $message }}</label>
                    @enderror
                </div>
                <div class="mb-3">
                    <strong>Role:</strong>
                    <x-crud::atoms.select2 name="roles" id="selectRoles">
                        @foreach ($rolesOptions as $val)
                            <option value="{{ $val }}">{{ $val }}</option>
                        @endforeach
                    </x-crud::atoms.select2>
                    @error('roles')
                        <label id="password_confirmation-error" class="error invalid-feedback"
                            for="roles">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-secondary">Cancel</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-sm btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>
@once
 @push('script')
    <script>
        $(function() {
            $('#createModal').on('hide.bs.modal', function() {
                livewire.emit('resetInputFields');
            });
        });
    </script>
 @endpush   
@endonce
