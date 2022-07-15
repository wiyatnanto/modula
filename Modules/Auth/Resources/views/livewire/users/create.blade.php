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
                    <input placeholder="Name" class="form-control @error('name') is-invalid @enderror" type="text"
                        wire:model="name">
                    <x-crud::atoms.input type="password" placeholder="Name" name="name" wire.model.defer="name" />
                    @error('name')
                        <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
                    @enderror
                </div>
                <div class="mb-3">
                    <strong>Email:</strong>
                    <input placeholder="Email" class="form-control @error('email') is-invalid @enderror" type="text"
                        wire:model="email">
                    @error('email')
                        <label id="email-error" class="error invalid-feedback" for="email">{{ $message }}</label>
                    @enderror
                </div>
                <div class="mb-3">
                    <strong>Password:</strong>
                    <input placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                        type="password" wire:model="password">
                    @error('password')
                        <label id="password-error" class="error invalid-feedback" for="password">{{ $message }}</label>
                    @enderror
                </div>
                <div class="mb-3">
                    <strong>Confirm Password:</strong>
                    <input placeholder="Confirm Password"
                        class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                        wire:model="password_confirmation">
                    @error('password_confirmation')
                        <label id="password_confirmation-error" class="error invalid-feedback"
                            for="password_confirmation">{{ $message }}</label>
                    @enderror
                </div>
                <div class="mb-3">
                    <strong>Role:</strong>
                    <x-crud::atoms.select2 id="selectRoles">
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
