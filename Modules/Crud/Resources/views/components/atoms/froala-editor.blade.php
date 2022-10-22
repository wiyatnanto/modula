@props(['height' => '200', 'imageUploadURL' => '/storage/blog/posts/'])
<div wire:ignore>
    <div x-data="{ content: @entangle($attributes->whereStartsWith('wire:model')->first()) }" x-init="() => {
        const editor = new FroalaEditor($refs.editor, {
            toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink', 'insertImage', 'insertVideo', 'insertFile', 'insertTable', '|', 'emoticons', 'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'print', 'help', 'html', '|', 'undo', 'redo', 'trackChanges', 'markdown'],
            events: {
                initialized: function() {
                    this.events.on('contentChanged', function(e) {
                        @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', editor.html.get(), true)
                    }, true);
                }
            }
        });
        $watch('content', (value) => {
            editor.html.set(value);
        });
    }">
        <textarea x-ref="editor" {{ $attributes }}></textarea>
    </div>
</div>
@once
    @push('style')
        <link href="{{ asset('modules/crud/vendor/froala/css/froala_editor.pkgd.min.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .fr-toolbar .fr-command.fr-btn svg.fr-svg,
            .fr-popup .fr-command.fr-btn svg.fr-svg,
            .fr-modal .fr-command.fr-btn svg.fr-svg {
                height: 20px !important;
            }

            .fr-toolbar .fr-command.fr-btn i,
            .fr-toolbar .fr-command.fr-btn svg,
            .fr-popup .fr-command.fr-btn i,
            .fr-popup .fr-command.fr-btn svg,
            .fr-modal .fr-command.fr-btn i,
            .fr-modal .fr-command.fr-btn svg {
                width: 20px !important;
            }

            .fr-popup {
                z-index: 999999 !important;
            }
        </style>
    @endpush
    @push('script')
        <script type="text/javascript" src="{{ asset('modules/crud/vendor/froala/js/froala_editor.pkgd.min.js') }}"></script>
    @endpush
@endonce
