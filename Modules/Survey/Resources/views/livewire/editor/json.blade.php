<div class="json-editor">
    @if ($config)
        {{ json_encode($config) }}
        <button wire:click="update">sdadsd</button>
    @endif
    <x-crud::atoms.monaco-editor height="650px" theme="vs-dark" wire:model="config" />
</div>
@push('style')
    <style>
        .json-editor {
            height: calc(100vh - 200px);
            max-height: calc(100vh - 200px);
            overflow: scroll;
        }
    </style>
@endpush
