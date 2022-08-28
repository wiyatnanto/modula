<div wire:ignore wire:key="{{ $attributes->whereStartsWith('wire:key')->first() }}">
    <div x-data="{ content: @entangle($attributes->whereStartsWith('wire:model')->first()) }" x-init="() => {
        const editor = new FroalaEditor($refs.editor, {
            toolbarInline: true,
            charCounterCount: false,
            toolbarButtons: ['bold', 'italic', 'underline', 'textColor', 'backgroundColor', 'clearFormatting'],
            events: {
                'contentChanged': function() {
                    @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', editor.html.get(), false)
                },
                'focus': function() {
                    this.$el.addClass('editing')
                },
                'blur': function() {
                    this.$el.removeClass('editing')
                }
            }
        });
    }">
        <div x-ref="editor" {{ $attributes }}>{{ $slot }}</div>
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

            .fr-toolbar.fr-inline {
                box-shadow: 0 0px 0px 0px rgb(0 0 0 / 20%), 0 0px 2px 0 rgb(0 0 0 / 18%), 0 1px 17px 0 rgb(0 0 0 / 12%);
                border-radius: 6px;
            }

            .fr-view {
                padding: 5px 0px;
            }

            .fr-view {
                border-bottom: 1px solid transparent;
            }

            .fr-view.editing {
                background-color: #eaecef;
                border-bottom: 1px solid #6471ff;
            }
        </style>
    @endpush
    @push('script')
        <script type="text/javascript" src="{{ asset('modules/crud/vendor/froala/js/froala_editor.pkgd.min.js') }}"></script>
    @endpush
@endonce
