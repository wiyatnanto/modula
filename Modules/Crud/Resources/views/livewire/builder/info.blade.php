<div>
    <div class="row mb-2 mt-3">
        <div class="col-md-8">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <x-crud::atoms.input type="text" placeholder="Name or Title" name="title" wire:model="title" />
                @error('title')
                    <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Module Note</label>
                <x-crud::atoms.input type="text" placeholder="Note" name="note" wire:model="note" />
                @error('note')
                    <label id="note-error" class="error invalid-feedback" for="note">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <x-crud::atoms.input type="text" placeholder="Description" name="desc" wire:model="desc" />
                @error('desc')
                    <label id="desc-error" class="error invalid-feedback" for="desc">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <x-crud::atoms.input type="text" placeholder="Author" name="author" wire:model="author" />
                @error('author')
                    <label id="author-error" class="error invalid-feedback" for="author">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Class Name</label>
                <x-crud::atoms.input type="text" placeholder="Class Name" name="name" wire:model="name"
                    readonly />
                @error('name')
                    <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="table" class="form-label">Table Master</label>
                <x-crud::atoms.input type="text" placeholder="Table Name" name="table" wire:model="table" readonly />
                @error('table')
                    <label id="table-error" class="error invalid-feedback" for="table">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="type" class="form-label">Crud Type</label>
                <x-crud::atoms.select2 name="type" wire:model.defer="type" defer="false">
                    <option></option>
                    <option value="datatable" @if ($type == '' or $type == 'datatable') selected @endif> DataTable Complete
                    </option>
                    <option value="default" @if ($type == 'default') selected @endif> Default
                    </option>
                </x-crud::atoms.select2>
                @error('type')
                    <label id="type-error" class="error invalid-feedback" for="type">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="setting-orderby" class="form-label">Order By</label>
                <x-crud::atoms.select2 name="setting.orderby" wire:model.defer="setting.orderby" defer="false">
                    <option></option>
                    @foreach ($orderbyOptions as $val)
                        <option value="{{ $val['field'] }}">{{ $val['label'] }}</option>
                    @endforeach
                </x-crud::atoms.select2>
                @error('setting.orderby')
                    <label id="setting-orderby-error" class="error invalid-feedback"
                        for="setting.orderby">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="setting-ordertype" class="form-label">Order Type</label>
                <x-crud::atoms.select2 name="setting.ordertype" wire:model.defer="setting.ordertype" defer="false">
                    <option></option>
                    <option value="asc" @if ($setting['ordertype'] == 'asc') selected="selected" @endif> Ascending
                    </option>
                    <option value="desc" @if ($setting['ordertype'] == 'desc') selected="selected" @endif> Descending
                    </option>
                </x-crud::atoms.select2>
                @error('setting.ordertype')
                    <label id="setting-ordertype-error" class="error invalid-feedback"
                        for="setting.ordertype">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                <label for="perpage" class="form-label">Display Rows</label>
                <x-crud::atoms.select2 name="setting.perpage" wire:model.defer="setting.perpage" defer="false">
                    <option></option>
                    @foreach (['10', '20', '30', '50'] as $val)
                        <option value="{{ $val }}">{{ $val }}</option>
                    @endforeach
                </x-crud::atoms.select2>
                @error('setting.perpage')
                    <label id="setting-perpage-error" class="error invalid-feedback"
                        for="setting.perpage">{{ $message }}</label>
                @enderror
            </div>
        </div>
    </div>
    <div class="mb-2">
        <button type="button" class="btn btn-sm btn-primary" wire:click="update()">Update Info</button>
    </div>
</div>
