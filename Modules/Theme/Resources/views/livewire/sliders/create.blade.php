<x-crud::organisms.modal preventSubmit="store()" submitLabel="Create" id="createSlide" title="Crate Slide">
    <x-slot name="header">
        <h5 class="modal-title">New Slide</h5>
    </x-slot>
    <div class="mb-3">
        <label for="avatar" class="form-label">Image</label>
        <x-crud::atoms.filepond wire:model="image" />
        @error('image')
            <label class="error invalid-feedback" for="image">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <x-crud::atoms.input type="text" placeholder="Title" wire:model="title" />
        @error('title')
            <label class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sub_title" class="form-label">Sub Title</label>
        <x-crud::atoms.input type="text" placeholder="Sub Title" wire:model="sub_title" />
        @error('sub_title')
            <label class="error invalid-feedback" for="sub_title">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="note" class="form-label">Note</label>
        <x-crud::atoms.input type="text" placeholder="Sub Title" wire:model="note" />
        @error('note')
            <label class="error invalid-feedback" for="note">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="button_text" class="form-label">Button Text</label>
        <x-crud::atoms.input type="text" placeholder="Button Text" wire:model="button_text" />
        @error('button_text')
            <label class="error invalid-feedback" for="button_text">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="url" class="form-label">Url</label>
        <x-crud::atoms.input type="text" placeholder="Url" wire:model="url" />
        @error('url')
            <label class="error invalid-feedback" for="url">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" wire:click.prevent="store" text="Create" />
    </x-slot>
</x-crud::organisms.modal>
