<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createCrud" title="Crate Crud">
    <div class="mb-3">
        <strong>Module Title:</strong>
        <x-crud::atoms.input type="text" placeholder="Module Title" name="title" wire:model="title" />
        @error('title')
            <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <strong>Desc:</strong>
        <x-crud::atoms.input type="text" placeholder="Description" name="note" wire:model="note" />
        @error('note')
            <label id="note-error" class="error invalid-feedback" for="note">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <strong>Class Controller:</strong>
        <x-crud::atoms.input type="text" placeholder="Class Controller" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <strong>Table:</strong>
        <x-crud::atoms.select2 name="table" dropdownParent="createCrud" wire:model.defer="table">
            <option></option>
            @foreach ($tableOptions as $val)
                <option value="{{ $val }}">{{ $val }}</option>
            @endforeach
        </x-crud::atoms.select2>
        @error('table')
            <label id="table-error" class="error invalid-feedback" for="table">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <strong>Joined Table:</strong>
        <x-crud::atoms.switch type="checkbox" label="Join" name="joinedToggle" id="joinedToggle"
            wire:model="joinedToggle" />
        @error('joinedToggle')
            <label id="joinedToggle-error" class="error invalid-feedback" for="joinedToggle">{{ $message }}</label>
        @enderror
    </div>
    @if ($joinedToggle)
        <div class="mb-3">
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
    @endif
    <div class="mb-3">
        <strong>Author:</strong>
        <x-crud::atoms.input type="text" placeholder="Author" name="author" wire:model="author" />
        @error('author')
            <label id="author-error" class="error invalid-feedback" for="author">{{ $message }}</label>
        @enderror
    </div>
</x-crud::organisms.modal>
