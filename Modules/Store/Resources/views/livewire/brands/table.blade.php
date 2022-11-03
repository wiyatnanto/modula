<div>
    <x-crud::molecules.breadcrumb :items="[
        __('store::messages.dashboard') => '/dashboard',
        __('store::messages.store') => '/store/products',
        __('store::messages.brands') => '/store/brands',
    ]" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">{{ __('store::messages.brands') }}</h5>
                </div>
                <div class="me-2">
                    <x-crud::atoms.input size="sm" wire:model="search"
                        placeholder="{{ __('crud::messages.search') }} {{ __('store::messages.brand') }}" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createBrand">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" />
                        {{ __('crud::messages.add') }} {{ __('store::messages.brand') }}
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-category">
                <thead>
                    @if ($brands)
                        <tr>
                            <th scope="col" class="align-middle tx-bold" wire:click.prevent="sortBy('name')">
                                {{ __('store::messages.brand') }}
                                <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle tx-bold" width="40">
                                {{ __('crud::messages.active') }}</th>
                            <th scope="col" class="align-middle tx-bold" width="50">
                                {{ __('crud::messages.action') }}</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @if ($brands)
                        @foreach ($brands as $key => $brand)
                            <tr wire:sortable.item="{{ $brand->id }}" wire:key="task-{{ $brand->id }}">
                                <td class="align-middle">
                                    <div class="media d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $brand->image) }}" class="rounded me-2"
                                            alt="Brand Image">
                                        <div class="media-body">
                                            <a href="#" class="fw-bold" data-bs-toggle="modal"
                                                data-bs-target="#updateBrand" wire:click="edit({{ $brand->id }})">
                                                {{ $brand->name }}
                                            </a>
                                            <p>{{ $brand->products_count }} {{ __('store::messages.product') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <x-crud::atoms.switch wire:click="toggleActive({{ $brand->id }})"
                                        checked="{{ $brand->status }}" />
                                </td>
                                <td class="align-middle text-end">
                                    <x-crud::molecules.dropdown label="{{ __('crud::messages.action') }}">
                                        @can('brands.update')
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#updateBrand"
                                                wire:click="edit({{ $brand->id }})">{{ __('crud::messages.edit') }}</button>
                                        @endcan
                                        @can('brands.delete')
                                            <div x-data>
                                                <button class="dropdown-item action-delete"
                                                    x-on:click="() => {
                                                        bootbox.dialog({
                                                            closeButton: false,
                                                            size: 'small',
                                                            centerVertical: true,
                                                            title: `{{ __('crud::messages.confirm_delete_title') }}`,
                                                            message: `{{ __('crud::messages.confirm_delete_body') }}`,
                                                            buttons: {
                                                                no:{
                                                                    label: '{{ __('crud::messages.cancel') }}',
                                                                    className: 'btn-sm btn-secondary'
                                                                },
                                                                ok:{
                                                                    label: '{{ __('crud::messages.confirm_delete_yes') }}',
                                                                    className: 'btn-sm btn-danger',
                                                                    callback: function(){
                                                                        @this.emit('delete', {{ $brand->id }})              
                                                                    }
                                                                }
                                                            }
                                                        });
                                                    }">{{ __('crud::messages.delete') }}</button>
                                            </div>
                                        @endcan
                                    </x-crud::molecules.dropdown>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $brands->links('pagination::bootstrap-5-livewire') }}
        </div>
        @include('store::livewire.brands.create')
        @include('store::livewire.brands.update')
    </x-crud::molecules.card>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush
@push('script')
    <script src="{{ asset('js/store.js') }}"></script>
@endpush
