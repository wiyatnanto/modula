<div>
    <x-crud::molecules.breadcrumb :items="[
        __('store::messages.dashboard') => '/dashboard',
        __('store::messages.products') => '/store/products',
        __('store::messages.storefronts') => '/store/storefronts',
    ]" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">{{ __('store::messages.storefronts') }}</h5>
                </div>
                <div class="me-3">
                    <x-crud::atoms.input size="sm" wire:model="search"
                        placeholder="{{ __('crud::messages.search') }} {{ __('store::messages.storefront') }}" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createStoreFront">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" />
                        {{ __('crud::messages.add') }} {{ __('store::messages.storefront') }}
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-category">
                <thead>
                    @if ($storeFronts)
                        <tr>
                            <th class="align-middle tx-bold" wire:click.prevent="sortBy('name')">
                                {{ __('store::messages.storefront') }}
                                <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th class="align-middle tx-bold" width="40">
                                {{ __('crud::messages.active') }}</th>
                            <th class="align-middle tx-bold" width="50">
                                {{ __('crud::messages.action') }}
                            </th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @if ($storeFronts)
                        @foreach ($storeFronts as $key => $storeFront)
                            <tr wire:sortable.item="{{ $storeFront->id }}" wire:key="task-{{ $storeFront->id }}">
                                <td class="align-middle">
                                    <div class="media d-flex align-items-center">
                                        <img src="{{ count($storeFront->products) > 0 ? asset('storage/' . $storeFront->products->first()->images->first()->image) : asset('modules/core/images/placeholder.png') }}"
                                            class="rounded me-2" alt="">
                                        <div class="media-body">
                                            <p class="product-title">
                                                <a
                                                    href="{{ asset('store/storefronts/' . $storeFront->id . '/' . $storeFront->slug) }}">
                                                    {{ $storeFront->name }}
                                                </a>
                                            </p>
                                            <p>{{ count($storeFront->products) }} {{ __('store::messages.product') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <x-crud::atoms.switch wire:click="toggleActive({{ $storeFront->id }})"
                                        checked="{{ $storeFront->status }}" />
                                </td>
                                <td class="align-middle">
                                    <x-crud::molecules.dropdown label="{{ __('crud::messages.action') }}">
                                        @can('brands.update')
                                            <a class="dropdown-item" type="button"
                                                href="{{ asset('store/storefronts/' . $storeFront->id . '/' . $storeFront->slug) }}">{{ __('crud::messages.update') }}</a>
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
                                                                        @this.emit('delete', {{ $storeFront->id }})                
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
            {{ $storeFronts->links('pagination::bootstrap-5-livewire') }}
        </div>
        @include('store::livewire.storefronts.create')
    </x-crud::molecules.card>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush
@push('script')
    <script src="{{ asset('js/store.js') }}"></script>
@endpush
