<div>
    <x-crud::molecules.breadcrumb :items="[
        __('store::messages.dashboard') => '/dashboard',
        __('store::messages.products') => '/store/products',
        __('store::messages.storefronts') => '/store/storefronts/' . $storeFrontId . '/' . $slug,
    ]" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">{{ __('crud::messages.update') }}</h5>
                </div>
                <div class="me-2">
                    <a href="{{ url('store/storefronts') }}" class="btn btn-xs btn-secondary">
                        {{ __('crud::messages.cancel') }}
                    </a>
                </div>
                <div>
                    <x-crud::atoms.button size="xs" color="primary" wire:click="update">
                        {{-- <x-crud::atoms.icon class="btn-icon-prepend" icon="save" /> --}}
                        {{ __('crud::messages.update') }}
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        <x-crud::molecules.form-control name="name" label="{{ __('store::messages.storefront_name') }}">
            <x-crud::atoms.input wire:model="name" />
            <p class="mg-t-5 tx-13 text-muted">{{ __('store::messages.storefront_name_note') }}</p>
        </x-crud::molecules.form-control>
        <div class="d-flex justify-content-start align-items-center mt-2">
            <div>
                <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                    data-bs-target="#addProducts" wire:click="openProducts">
                    <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" />
                    {{ __('store::messages.product') }}
                </x-crud::atoms.button>
            </div>
        </div>
        <div class="table-responsive mt-2">
            <table class="table table-category">
                <thead>
                    @if ($products)
                        <tr>
                            <th scope="col" class="lign-middle x-bold">
                                {{ __('store::messages.product') }}
                            </th>
                            <th scope="col" class="lign-middle tx-bold" width="100">
                                {{ __('store::messages.brand') }}</th>
                            <th scope="col" class="lign-middle tx-bold" width="100">
                                {{ __('store::messages.price') }}</th>
                            <th scope="col" class="lign-middle tx-bold" width="50">
                                {{ __('crud::messages.action') }}</th>
                        </tr>
                    @endif
                </thead>
                <tbody wire:sortable="updateOrder">
                    @if ($products)
                        @foreach ($products as $key => $product)
                            <tr wire:sortable.item="{{ $product->id }}" wire:key="task-{{ $product->id }}">
                                <td class="align-middle">
                                    <div class="media d-flex align-items-center">
                                        @if (count($product->images) > 0)
                                            <img src="{{ asset('storage/' . $product->images->first()?->image) }}"
                                                class="rounded me-2" alt="">
                                        @endif
                                        <div class="media-body">
                                            <p>
                                                {{ $product->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    {{ $product->brand->name }}
                                </td>
                                <td class="align-middle">
                                    {{ number_format(round($product->price), 0, ',', '.') }}
                                </td>
                                <td class="align-middle text-center">
                                    <a type="button" class="text-danger" x-data
                                        x-on:click="() => {
                                        bootbox.dialog({
                                            closeButton: false,
                                            size: 'small',
                                            centerVertical: true,
                                            title: `{{ __('crud::messages.confirm_delete_title') }} {{ __('crud::messages.of') }} {{ __('store::messages.storefront') }}` ,
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
                                                        @this.emit('deleteStoreFrontProduct', {{ $product->id }})               
                                                    }
                                                }
                                            }     
                                        });
                                    }">
                                        <x-crud::atoms.icon icon="minus-circle" />
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $products->links('pagination::bootstrap-5-livewire') }}
        </div>
    </x-crud::molecules.card>
    <x-crud::organisms.modal size="lg" id="addProducts">
        <x-slot name="header">
            <h5 class="modal-title">{{ __('crud::messages.add') }}
                {{ __('store::messages.product') }}</h5>
        </x-slot>
        <div class="d-flex justify-content-start align-items-center">
            <div>
                <x-crud::atoms.input size="sm" wire:model="searchAllProducts" placeholder="Search Product" />
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-product">
                <thead>
                    <tr>
                        <th scope="col" width="80">
                            {{ count($selectedProducts) > 0 ? count($selectedProducts) . ' Choices' : 'Choice' }}</th>
                        <th scope="col" class="align-middle tx-bold" wire:click.prevent="sortBy('name')">
                            {{ __('store::messages.product') }}
                            <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th scope="col" class="align-middle tx-bold">{{ __('store::messages.brand') }}</th>
                        <th scope="col" class="align-middle tx-bold">{{ __('store::messages.price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($allProducts) > 0)
                        @foreach ($allProducts as $key => $product)
                            <tr>
                                <td class="align-middle">
                                    <x-crud::atoms.checkbox wire:model="selectedProducts.{{ $product->id }}" />
                                </td>
                                <td>
                                    <div class="media d-flex align-items-center">
                                        @foreach ($product->images as $key_image => $image)
                                            @if (!$key_image)
                                                <img src="{{ asset('storage/' . $image->image) }}" class="rounded me-2"
                                                    alt="">
                                            @endif
                                        @endforeach
                                        <div class="media-body">
                                            <p>
                                                {{ $product->name }}
                                            </p>
                                            <p>SKU: {{ $product->sku }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group mg-b-10 wd-100">
                                        {{ $product->brand->name }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    {{ number_format(round($product->price), 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $allProducts->links('pagination::bootstrap-5-livewire') }}
        </div>
        <x-slot name="footer">
            <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
                text="{{ __('crud::messages.cancel') }}" />
            <x-crud::atoms.button size="sm" color="primary"
                text="{{ __('crud::messages.add') }} {{ __('store::messages.products') }}"
                wire:click.prevent="updateStoreFrontProducts" />
            <x-crud::atoms.button size="sm" color="primary"
                text="{{ __('crud::messages.add') }} {{ __('store::messages.products') }} & {{ __('crud::messages.close') }}"
                wire:click.prevent="updateStoreFrontProducts(true)" />
        </x-slot>
    </x-crud::organisms.modal>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush
@push('script')
    <script src="{{ asset('js/store.js') }}"></script>
@endpush
