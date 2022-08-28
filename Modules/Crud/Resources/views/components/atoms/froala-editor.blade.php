@props(['height' => '200'])
<div wire:ignore>
    <div x-data="{ content: @entangle($attributes->whereStartsWith('wire:model')->first()) }" x-init="() => {
        const editor = new FroalaEditor($refs.editor, {
            //heightMin: {{ $height }},
            //heightMax: {{ $height }},
            //iconsTemplate: 'font_awesome_5',
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
        </style>
    @endpush
    @push('script')
        <script type="text/javascript" src="{{ asset('modules/crud/vendor/froala/js/froala_editor.pkgd.min.js') }}"></script>
    @endpush
@endonce
