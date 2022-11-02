<x-crud::organisms.modal size="lg" id="createPromoBanner">
    <x-slot name="header">
        <h5 class="modal-title">{{ __('crud::messages.add') }} {{ __('store::messages.promo_banner') }}</h5>
    </x-slot>
    <div class="mb-3">
        <label for="avatar" class="form-label">{{ __('store::messages.promo_banner_image') }}</label>
        <x-crud::atoms.filepond wire:model="image" />
        @error('image')
            <label class="error invalid-feedback" for="image">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">{{ __('store::messages.promo_banner_title') }}</label>
        <x-crud::atoms.input type="text" placeholder="{{ __('store::messages.promo_banner_title') }}" wire:model="title" />
        @error('title')
            <label class="error invalid-feedback" for="title">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sub_title" class="form-label">{{ __('store::messages.promo_banner_sub') }}</label>
        <x-crud::atoms.input type="text" placeholder="{{ __('store::messages.promo_banner_sub') }}" wire:model="sub_title" />
        @error('sub_title')
            <label class="error invalid-feedback" for="sub_title">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="note" class="form-label">{{ __('store::messages.promo_banner_note') }}</label>
        <x-crud::atoms.input type="text" placeholder="Sub Title" wire:model="{{ __('store::messages.promo_banner_note') }}" />
        @error('note')
            <label class="error invalid-feedback" for="note">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="discount_text" class="form-label">{{ __('store::messages.promo_banner_discount') }}</label>
        <x-crud::atoms.input type="text" placeholder="{{ __('store::messages.promo_banner_discount') }}" wire:model="discount_text" />
        @error('discount_text')
            <label class="error invalid-feedback" for="discount_text">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="button_text" class="form-label">{{ __('store::messages.promo_banner_button_text') }}</label>
        <x-crud::atoms.input type="text" placeholder="{{ __('store::messages.promo_banner_button_text') }}" wire:model="button_text" />
        @error('button_text')
            <label class="error invalid-feedback" for="button_text">{{ $message }}</label>
        @enderror
    </div>
    <div class="mb-3">
        <label for="url" class="form-label">{{ __('store::messages.promo_banner_url') }}</label>
        <x-crud::atoms.input type="text" placeholder="{{ __('store::messages.promo_banner_url') }}" wire:model="url" />
        @error('url')
            <label class="error invalid-feedback" for="url">{{ $message }}</label>
        @enderror
    </div>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="{{ __('crud::messages.cancel') }}" />
        <x-crud::atoms.button size="sm" color="primary" text="{{ __('crud::messages.add') }}" wire:click.prevent="store" />
    </x-slot>
</x-crud::organisms.modal>
