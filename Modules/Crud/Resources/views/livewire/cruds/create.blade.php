<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createCrud" title="Crate Crud">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <x-crud::atoms.input type="text" placeholder="Module Title" name="title" wire:model="title" />
        @error('title')
            <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="note" class="form-label">Note</label>
        <x-crud::atoms.input type="text" placeholder="Description" name="note" wire:model="note" />
        @error('note')
            <label id="note-error" class="error invalid-feedback" for="note">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Class Controller</label>
        <x-crud::atoms.input type="text" placeholder="Class Controller" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="table" class="form-label">Table</label>
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
        <label for="joinedToggle" class="form-label">Joined Table</label>
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
                                <x-crud::atoms.select2 name="joinedTables.{{$i}}"
                                    dropdownParent="createCrud" wire:model.defer="joinedTables.{{$i}}"
                                    defer="false">
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
                                @if($i !== 0)
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
        </div>
    @endif
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <x-crud::atoms.input type="text" placeholder="Author" name="author" wire:model="author" />
        @error('author')
            <label id="author-error" class="error invalid-feedback" for="author">{{ $message }}</label>
        @enderror
    </div>
</x-crud::organisms.modal>
