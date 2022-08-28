<div>
    <div class="row mb-2 mt-3">
        <div class="col-md-12">
            <div class="mb-0">
                <label for="roles" class="form-label">Select Role</label>
                <x-crud::atoms.select2 name="roles" placeholder="Select Role" wire:model.defer="roles"
                    multiple="multiple" defer="false">
                    @foreach ($rolesOptions as $val)
                        <option value="{{ $val }}">{{ $val }}</option>
                    @endforeach
                </x-crud::atoms.select2>
                <div class="mt-2 mb-0 alert alert-primary">
                    Warning: Permissions will be saved according to the selected role. A removed role will also remove
                    access permissions
                </div>
                @error('roles')
                    <label id="password_confirmation-error" class="error invalid-feedback"
                        for="roles">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Role</th>
                            @foreach ($permissionKeys as $keys)
                                <th>{{ $keys }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Arr::sort($roles) as $role)
                            <tr>
                                <td><code>{{ $role }}</code></td>
                                @foreach ($permissionKeys as $keys)
                                    <td wire:key="{{ $role }}.{{ $keys }}">
                                        <x-crud::atoms.switch type="checkbox"
                                            name="permissions.{{ $role }}.{{ $keys }}"
                                            id="permissions.{{ $role }}.{{ $keys }}"
                                            wire:model="permissions.{{ $role }}.{{ $keys }}" />
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <button class="btn btn-sm btn-primary" wire:click="update()">Save Permissions </button>
            </div>
        </div>
    </div>
</div>
