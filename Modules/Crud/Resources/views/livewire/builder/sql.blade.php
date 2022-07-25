<div>
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="mb-3">
                <strong>Master Table:</strong>
                <x-crud::atoms.input type="text" placeholder="Master Table" name="db" wire:model="db" readonly />
                @error('db')
                    <label id="db-error" class="error invalid-feedback" for="db">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <strong>Joined Table:</strong>
                <table class="table">
                    <thead>
                        <tr>
                            <th width="200">Table {{ count($joinedTables) }}</th>
                            <th>Master Key</th>
                            <th>Joined Key</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($joinedTables as $key => $value)
                            <tr wire:key="{{ $key }}">
                                <td>
                                    <x-crud::atoms.select2 name="joinedTables.{{ $key }}"
                                        dropdownParent="createCrud" wire:model.defer="joinedTables.{{ $key }}"
                                        defer="false">
                                        <option></option>
                                        @foreach ($tableOptions as $val)
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endforeach
                                    </x-crud::atoms.select2>
                                    {{ $key }}
                                </td>
                                <td>
                                    <x-crud::atoms.input type="text" placeholder="Master Table Key"
                                        name="joinedMasters.{{ $key }}"
                                        wire:model="joinedMasters.{{ $key }}" />
                                </td>
                                <td>
                                    <x-crud::atoms.input type="text" placeholder="Joined Table Key"
                                        name="joinedKeys.{{ $key }}"
                                        wire:model="joinedKeys.{{ $key }}" />
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary btn-icon"
                                        wire:click="addJoinedCount()">
                                        <i class="mdi mdi-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger btn-icon"
                                        wire:click="removeJoinedCount('{{ $key }}')">
                                        <i class="mdi mdi-minus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mb-2">
        <button type="button" class="btn btn-sm btn-primary" wire:click="update()">Update SQL</button>
    </div>
</div>
