@props(['name', 'sortField', 'sortAsc'])
<div class="sort-icon">
    @if ($sortField === $name)
        @if ($sortAsc)
            <x-crud::atoms.icon icon="mdi mdi-sort-ascending" size="16px" />
        @else
            <x-crud::atoms.icon icon="mdi mdi-sort-descending" size="16px" />
        @endif
    @endif
</div>
@once
    @push('style')
        <style>
            .sort-icon {
                position: relative;
                float: right;
                right: 1em;
            }
        </style>
    @endpush
@endonce
