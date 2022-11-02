@props(['instantUpload' => true, 'maxFileSize' => '1MB', 'previewHeight' => null, 'imageCropAspectRatio' => null, 'imagePreview' => true])
<div>
    <div wire:ignore x-data="{ file: @entangle($attributes->whereStartsWith('wire:model')->first()) }" x-init="() => {
        @if($imagePreview)
        FilePond.registerPlugin(FilePondPluginImagePreview);
        @endif
        const pond = FilePond.create($refs.input);
        $(window).on('shown.bs.modal', function() {
            pond.setOptions({
                maxFileSize: '{{ $maxFileSize }}',
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        console.log('asdadas')
                        @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                    },
                    load: (source, load, error, progress, abort, headers) => {
                        var myRequest = new Request(source);
                        fetch(myRequest).then(function(response) {
                            response.blob().then(function(myBlob) {
                                load(myBlob)
                            });
                        });
                    }
                }
            });
            @if($instantUpload)
            pond.setOptions({
                instantUpload: true
            })
            @endif
            @if($imageCropAspectRatio)
            pond.setOptions({
                imageCropAspectRatio: '{{ $imageCropAspectRatio }}'
            })
            @endif
            @if($previewHeight)
            pond.setOptions({
                imagePreviewMinHeight: {{ $previewHeight }},
                imagePreviewMaxHeight: {{ $previewHeight }},
                imagePreviewHeight: {{ $previewHeight }}
            })
            @endif
            if (file !== null) {
                pond.server.load = (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                }
                pond.files = [{
                    source: '/storage/' + file,
                    options: {
                        type: 'local'
                    }
                }];
            }
            $watch('file', function(value) {
                if (value !== null) {
                    if (!value.includes('livewire-file:') && value !== null) {
                        pond.files = [{
                            source: '/storage/' + value,
                            options: {
                                type: 'local'
                            }
                        }];
                    }
                } else {
                    pond.removeFile()
                }
            })
        });
    }" style="overflow: hidden;">
        <x-crud::atoms.input x-ref="input" type="file" {{ $attributes }} />
    </div>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('modules/crud/vendor/filepond/filepond.min.css') }}" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush
@push('script')
    <script src="{{ asset('modules/crud/vendor/filepond/filepond.min.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
@endpush
