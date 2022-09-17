@props(['previewHeight' => 185])
<div>
    <div wire:ignore x-data="{ file: @entangle($attributes->whereStartsWith('wire:model')->first()) }" x-init="() => {
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const pond = FilePond.create($refs.input);
        $(window).on('shown.bs.modal', function() {
            pond.setOptions({
                instantUpload: true,
                maxFileSize: '1MB',
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        console.log('asdadas')
                        @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                    }
                },
                onremovefile: function(error, file) {
                    @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', null);
                },
                imageCropAspectRatio: '1:1',
                imagePreviewMinHeight: {{ $previewHeight }},
                imagePreviewMaxHeight: {{ $previewHeight }},
                imagePreviewHeight: {{ $previewHeight }},
            });
    
            if (@this.get('{{ $attributes->whereStartsWith('wire:model')->first() }}') !== null) {
                pond.server.load = (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                }
                pond.files = [{
                    source: '/storage/' + @this.get('{{ $attributes->whereStartsWith('wire:model')->first() }}'),
                    options: {
                        type: 'local'
                    }
                }];
            }
        });
        $watch('file', (value) => {
            console.log('watch', @this.get('{{ $attributes->whereStartsWith('wire:model')->first() }}'))
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
