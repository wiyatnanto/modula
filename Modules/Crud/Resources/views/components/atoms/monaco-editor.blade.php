@props(['height' => '400px', 'theme' => 'vs-dark'])
<div wire:ignore x-data="{ code: @entangle($attributes->whereStartsWith('wire:model')->first()) }">
    <div x-init="() => {
        document.addEventListener('DOMContentLoaded', () => {
            const modelUri = monaco.Uri.parse('json://grid/settings.json');
            const jsonModel = monaco.editor.createModel(JSON.stringify(code, null, '\t'), 'json', modelUri);
            var editor = monaco.editor.create($refs.editor, {
                model: jsonModel,
                language: 'handlebars',
                automaticLayout: true,
                theme: '{{ $theme }}',
            });
            editor.getModel().onDidChangeContent(() => {
                console.log('a')
                @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', JSON.parse(editor.getValue()))
            });
            $watch('code', (value) => {
                console.log('b')

                @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', JSON.parse(editor.getValue()))
            });
        })
    }" class="modula-code-editor" x-ref="editor">
    </div>
</div>
@once
    @push('style')
        <style>
            .modula-code-editor {
                min-height: {{ $height }};
            }
        </style>
    @endpush
    @push('script')
        <script src="{{ url('js/monaco.js') }}"></script>
    @endpush
@endonce
