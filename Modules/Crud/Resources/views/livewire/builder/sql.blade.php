<div>
    <div class="row mb-2 mt-3">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="table" class="form-label">Master Table</label>
                <x-crud::atoms.input type="text" placeholder="Master Table" name="table" wire:model="table" readonly />
                @error('table')
                    <label id="table-error" class="error invalid-feedback" for="table">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="joinedToggle" class="form-label">Join Table</label>
                <x-crud::atoms.switch type="checkbox" label="Join" name="joinedToggle" id="joinedToggle"
                    wire:model="joinedToggle" />
                @error('joinedToggle')
                    <label id="joinedToggle-error" class="error invalid-feedback"
                        for="joinedToggle">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-0 alert alert-primary">
                The tables are joined will appear in the table column
            </div>
            <div class="mb-3">
                @if ($joinedToggle)
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="200">Table</th>
                                <th>Master Key</th>
                                <th>Joined Key</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($joinedTables as $i => $val)
                                <tr wire:key="{{ $i }}">
                                    <td>
                                        <x-crud::atoms.select2 name="joinedTables.{{ $i }}"
                                            wire:model.defer="joinedTables.{{ $i }}" defer="false">
                                            <option></option>
                                            @foreach ($tableOptions as $val)
                                                <option value="{{ $val }}">{{ $val }}</option>
                                            @endforeach
                                        </x-crud::atoms.select2>
                                    </td>
                                    <td>
                                        <x-crud::atoms.input type="text" placeholder="Master Table Key"
                                            name="joinedMasters.{{ $i }}"
                                            wire:model="joinedMasters.{{ $i }}" />
                                    </td>
                                    <td>
                                        <x-crud::atoms.input type="text" placeholder="Joined Table Key"
                                            name="joinedKeys.{{ $i }}"
                                            wire:model="joinedKeys.{{ $i }}" />
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary btn-icon"
                                            wire:click="addJoinedTables">
                                            <i class="mdi mdi-plus"></i>
                                        </button>
                                        @if ($i !== 0)
                                            <button type="button" class="btn btn-sm btn-danger btn-icon"
                                                wire:click="removeJoinedTables({{ $i }})">
                                                <i class="mdi mdi-minus"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="mb-2">
        <button type="button" class="btn btn-sm btn-primary" wire:click="update()">Update SQL</button>
    </div>
</div>
