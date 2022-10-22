<x-crud::organisms.modal size="lg" id="createBranch">
    <x-slot name="header">
        <h5 class="modal-title">Add New Branch</h5>
    </x-slot>
    <x-crud::molecules.form-control name="name" label="Name">
        <x-crud::atoms.input wire:model="name" />
    </x-crud::molecules.form-control>
    <x-crud::molecules.form-control name="address" label="Address">
        <x-crud::atoms.froala-editor wire:model="address" />
    </x-crud::molecules.form-control>
    <x-crud::molecules.form-control name="coordinate.lat" label="Latitude">
        <x-crud::atoms.input wire:model="coordinate.lat" />
    </x-crud::molecules.form-control>
    <x-crud::molecules.form-control name="coordinate.long" label="Longitude">
        <x-crud::atoms.input wire:model="coordinate.long" />
    </x-crud::molecules.form-control>
    <x-crud::molecules.form-control name="image" label="Image">
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
                            source: '/storage/store/branches/' + value,
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
            text="Cancel" />
        <x-crud::atoms.button size="sm" color="primary" text="Create" wire:click.prevent="store" />
    </x-slot>
</x-crud::organisms.modal>
