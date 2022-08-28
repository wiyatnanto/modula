<div>
    <div class="row mb-2 mt-3">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="type" class="form-label">Publish Type</label>
                <div>
                    <x-crud::atoms.radio type="radio" label="Embed" name="type" id="type" wire:model="type"
                        value="embed" />
                    <x-crud::atoms.radio type="radio" label="Generate" name="type" id="type" wire:model="type"
                        value="generate" />
                </div>
            </div>
            <div class="@if ($type !== 'embed') d-none @endif">
                <div class="mb-3">
                    <div class="alert alert-success">The crud code is embedded in the view (Blade) by adding the
                        following line of code (below).
                    </div>
                </div>
                <div class="mb-3">
                    <label for="emebed" class="form-label">Example of embedding Crud</label>
                    <x-crud::atoms.code-editor name="code" />
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-sm btn-primary btn-icon-text">
                        <i class="btn-icon-prepend mdi mdi-content-copy"></i>
                        Copy Code
                    </button>
                </div>
            </div>
            <div class="@if ($type !== 'generate') d-none @endif">
                <div class="mb-3">
                    <div class="alert alert-danger">Class (Livewire) and view (Blade) code files will be created in the
                        module. The file will overwrite and delete the previous file. Please be careful in publishing
                        crud
                    </div>
                </div>
                <div class="mb-3">
                    <label for="module" class="form-label">Generate to Module</label>
                    <x-crud::atoms.select2 name="module" wire:model.defer="module" defer="true">
                        <option></option>
                        @foreach ($modulesOptions as $module)
                            <option value="{{ $module }}">{{ $module }}</option>
                        @endforeach
                    </x-crud::atoms.select2>
                    @error('module')
                        <label id="module-error" class="error invalid-feedback" for="module">{{ $message }}</label>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="class" class="form-label">Class</label>
                    <p>Modules/<code>module name</code>/Http/Livewire/<code>crud name</code>/Table.php</p>
                </div>
                <div class="mb-3">
                    <label for="views" class="form-label">Views</label>
                    <p>Modules/<code>module name</code>/Resources/views/livewire/<code>crud name</code>/table.blade.php
                    </p>
                    <p>Modules/<code>module name</code>/Resources/views/livewire/<code>crud name</code>/create.blade.php
                    </p>
                    <p>Modules/<code>module name</code>/Resources/views/livewire/<code>crud name</code>/update.blade.php
                    </p>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-sm btn-danger btn-icon-text" wire:click="publish">
                        <i class="btn-icon-prepend mdi mdi-reload"></i>
                        Publish Code
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
