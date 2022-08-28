<div wire:ignore x-data="{
    inEdit: false,
    text: @entangle($attributes->whereStartsWith('wire:model')->first())
}" x-init="() => {

    console.log(text)
}">
    <div @click="inEdit = true" x-show="!inEdit" x-text="text" {{ $attributes->merge(['class' => 'inline-edit']) }}>
        {{ $slot }}</div>
    <div x-show="inEdit" @click.outside="inEdit = false">
        <x-crud::atoms.input class="inline-inedit" placeholder="Edit"
            wire:model="{{ $attributes->whereStartsWith('wire:model')->first() }}" />
    </div>
    <style>
        .inline-edit {
            border-bottom: 1px solid transparent !important;
        }

        .inline-inedit {
            padding: 0px;
            border: none;
            background-color: #eaecef !important;
            border-bottom: 1px solid #6471ff !important;
            border-radius: 0px;
        }
    </style>
</div>
