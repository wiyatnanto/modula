<x-crud::organisms.modal size="xl" preventSubmit="update" submitLabel="Update" id="updatePage" title="Update Page">
    <x-slot name="header">
        <h5 class="modal-title">{{ __('crud::messages.update') }} {{ __('blog::messages.page') }}</h5>
    </x-slot>
    <div class="mb-3">
        <label for="title" class="form-label">{{ __('blog::messages.page_title') }}</label>
        <x-crud::atoms.input placeholder="{{ __('blog::messages.page_title') }}" wire:model="title" />
        @error('title')
            <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">{{ __('blog::messages.page_content') }}</label>
        <x-crud::atoms.froala-editor height="350" wire:model="content" />
        @error('content')
            <label id="content-error" class="error invalid-feedback" for="content">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" text="{{ __('crud::messages.cancel') }}"
            data-bs-dismiss="modal" aria-label="btn-close" />
        <x-crud::atoms.button size="sm" color="primary" text="{{ __('crud::messages.update') }}"
            wire:click.prevent="update" />
    </x-slot>
</x-crud::organisms.modal>
