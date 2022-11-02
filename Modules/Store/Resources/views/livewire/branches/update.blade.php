<x-crud::organisms.modal size="lg" id="updateBranch">
    <x-slot name="header">
        <h5 class="modal-title">{{ __('crud::messages.update') }} {{ __('store::messages.branch') }}</h5>
    </x-slot>
    <x-crud::molecules.form-control name="name" label="{{ __('store::messages.branch_name') }}">
        <x-crud::atoms.input wire:model="name" placeholder="{{ __('store::messages.branch_name') }}" />
    </x-crud::molecules.form-control>
    <x-crud::molecules.form-control name="address" label="{{ __('store::messages.branch_address') }}">
        <x-crud::atoms.froala-editor wire:model="address" placeholder="{{ __('store::messages.branch_address') }}" />
    </x-crud::molecules.form-control>
    <x-crud::molecules.form-control name="coordinate.lat" label="{{ __('store::messages.branch_location_lat') }}">
        <x-crud::atoms.input wire:model="coordinate.lat" />
    </x-crud::molecules.form-control>
    <x-crud::molecules.form-control name="coordinate.lng" label="{{ __('store::messages.branch_location_lng') }}">
        <x-crud::atoms.input wire:model="coordinate.lng" />
    </x-crud::molecules.form-control>
    <x-crud::molecules.form-control name="image" label="{{ __('store::messages.branch_image') }}">
        <div wire:ignore x-data="{ image: @entangle('image') }" x-init="() => {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform,
                FilePondPluginImageEdit
            );
            const file = FilePond.create($refs.input);
            file.setOptions({
                allowProcess: true,
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('image', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('image', filename, load)
                    },
                    load: (source, load, error, progress, abort, headers) => {
                        var myRequest = new Request(source);
                        fetch(myRequest).then(function(response) {
                            response.blob().then(function(myBlob) {
                                load(myBlob)
                            });
                        });
                    }
                },
            });
            if (image !== null) {
                file.server.load = (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                }
            }
            $watch('image', function(value) {
                if (value !== null) {
                    if (!value.includes('livewire-file:') && value !== null) {
                        file.files = [{
                            source: '/storage/' + value,
                            options: {
                                type: 'local'
                            }
                        }];
                    }
                } else {
                    file.removeFile()
                }
            })
        }">
            <input type="file" x-ref="input" />
        </div>
    </x-crud::molecules.form-control>
    <x-slot name="footer">
        <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
            text="{{ __('crud::messages.cancel') }}" />
        <x-crud::atoms.button size="sm" color="primary" text="{{ __('crud::messages.update') }}" wire:click.prevent="update" />
    </x-slot>
</x-crud::organisms.modal>
