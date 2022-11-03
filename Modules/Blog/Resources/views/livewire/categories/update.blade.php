<x-crud::organisms.modal size="md" id="updateCategory">
    <x-slot name="header">
        <h5 class="modal-title">{{ __('crud::messages.update') }} {{ __('blog::messages.category') }}</h5>
    </x-slot>
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('blog::messages.category_name') }}</label>
        <x-crud::atoms.input type="text" placeholder="Category Name" name="name" wire:model="name" />
        @error('name')
            <label id="name-error" class="error invalid-feedback" for="name">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="{{ __('crud::messages.cancel') }}" />
        <x-crud::atoms.button size="sm" color="primary" text="{{ __('crud::messages.update') }}"
            wire:click.prevent="update" />
    </x-slot>
</x-crud::organisms.modal>
