<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Store' => '/store/products']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">{{ __('store::messages.product_list') }}</h5>
                </div>
                <div class="me-2">
                    <x-crud::molecules.dropdown label="Atur Sekaligus" color="light">
                        <a type="button" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Dalam Pengembangan">Tambah Sekaligus</a>
                        <a type="button" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Dalam Pengembangan">Ubah Sekaligus</a>
                    </x-crud::molecules.dropdown>
                </div>
                <div>
                    <x-crud::atoms.link href="{{ url('store/products/add-product') }}"
                        class="btn btn-xs btn-primary btn-icon-text">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add Product
                    </x-crud::atoms.link>
                </div>
            </div>
        </x-slot>
        <div class="row">
            <div class="col-sm-3">
                <x-crud::atoms.input wire:model="search" placeholder="Search Product" />
            </div>
            <div class="col-sm-3">
                <x-crud::atoms.select2checkbox wire:model="categoriesFilter" placeholder="Select Category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-crud::atoms.select2checkbox>
            </div>
            <div class="col-sm-3">
                <x-crud::atoms.select2checkbox wire:model="storefrontsFilter" placeholder="Select Store Front">
                    @foreach ($storefronts as $storefront)
                        <option value="{{ $storefront->id }}">{{ $storefront->name }}</option>
                    @endforeach
                </x-crud::atoms.select2checkbox>
            </div>
            <div class="col-sm-3">
                <x-crud::atoms.select2 wire:model="sortByFilter">
                    <option></option>
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                    <option value="name_asc">Nama: A - Z</option>
                    <option value="name_desc">Nama: Z - A</option>
                    <option value="quantity_asc">Stok Tersedikit</option>
                    <option value="quantity_desc">Stok Terbanyak</option>
                </x-crud::atoms.select2>
            </div>
            <div class="col-sm-12">
                @if ($sortField !== 'id' || count($categoriesFilter) > 0 || count($storefrontsFilter) > 0)
                    <div class="d-flex mt-3 mb-3">
                        <div class="me-2">
                            <a type="button" wire:click="clearFilter()" class="text-muted">Reset Semua
                                Filter</a>
                        </div>
                        <div class="me-2">
                            @if ($sortField !== 'id')
                                @php
                                    $sortLabel = [
                                        'name' => ['label' => 'Nama:', 'asc' => 'A - Z', 'desc' => 'Z - A'],
                                        'price' => ['label' => 'Harga', 'asc' => 'Terendah', 'desc' => 'Tertinggi'],
                                        'quantity' => ['label' => 'Stok', 'desc' => 'Terbanyak', 'asc' => 'Tersedikit'],
                                    ];
                                @endphp
                                @if (isset($sortLabel[$sortField]))
                                    <span class="badge bg-light text-black me-1">
                                        {{ $sortLabel[$sortField]['label'] }}
                                        {{ $sortLabel[$sortField][$sortAsc ? 'asc' : 'desc'] }}
                                        <button class="btn btn-xs btn-link p-0" wire:click="removeSort()"
                                            style="font-size: 0px;">
                                            <x-crud::atoms.icon icon="times" class="text-muted"
                                                style="font-size: .65rem;" />
                                        </button>
                                    </span>
                                @endif
                            @endif
                            @if (count($categoriesFilter) > 0)
                                @foreach ($categoriesFilterLabel as $key => $category)
                                    <span class="badge bg-light text-black me-1">
                                        {{ $category->name }}
                                        <button class="btn btn-xs btn-link p-0"
                                            wire:click="removeCategoriesFilter({{ $category->id }})"
                                            style="font-size: 0px;">
                                            <x-crud::atoms.icon icon="times" class="text-muted"
                                                style="font-size: .65rem;" />
                                        </button>
                                    </span>
                                @endforeach
                            @endif
                            @if (count($storefrontsFilter) > 0)
                                @foreach ($storefrontsFilterLabel as $key => $storefront)
                                    <span class="badge bg-light text-black me-1">
                                        {{ $storefront->name }}
                                        <button class="btn btn-xs btn-link p-0"
                                            wire:click="removeStorefrontFilter({{ $storefront->id }})"
                                            style="font-size: 0px;">
                                            <x-crud::atoms.icon icon="times" class="text-muted"
                                                style="font-size: .65rem;" />
                                        </button>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="table-responsive mt-2">
            <table class="table table-product">
                <thead>
                    @if (count($products) > 0)
                        <tr>
                            <th scope="col" width="50">
                                <x-crud::atoms.checkbox wire:model="selectAll" />
                            </th>
                            @if (!count($selected))
                                <th scope="col" class="align-middle tx-bold" wire:click.prevent="sortBy('name')">
                                    {{ __('store::messages.product') }}
                                    <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th scope="col" class="align-middle tx-bold">{{ __('store::messages.statistic') }}
                                </th>
                                <th scope="col" class="align-middle tx-bold">{{ __('store::messages.brand') }}</th>
                                <th scope="col" class="align-middle tx-bold" wire:click.prevent="sortBy('price')">
                                    {{ __('store::messages.price') }}
                                    <x-crud::molecules.sorticon name="price" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th scope="col" class="align-middle tx-bold" wire:click.prevent="sortBy('quantity')">
                                    {{ __('store::messages.stock') }}
                                    <x-crud::molecules.sorticon name="quantity" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th scope="col" class="align-middle tx-bold" width="30">
                                    {{ __('crud::messages.active') }}</th>
                                <th scope="col" class="align-middle tx-bold" width="50"></th>
                            @else
                                <th scope="col" class="align-middle tx-bold p-0" colspan="7">
                                    <x-crud::atoms.button size="xs" color="danger" class="btn-icon-text"
                                        x-on:click="() => {
                                            bootbox.dialog({
                                                closeButton: false,
                                                size: 'small',
                                                centerVertical: true,
                                                title: `Hapus Item?`,
                                                message: `Penghapusan item tidak dapat dibatalkan, anda yakin menghapus item ini?`,
                                                buttons: {
                                                    no:{
                                                        label: 'Batal',
                                                        className: 'btn-sm btn-secondary',
                                                        callback: function(){
                                                                            
                                                        }
                                                    },
                                                    ok:{
                                                        label: 'Ya, Hapus',
                                                        className: 'btn-sm btn-danger',
                                                        callback: function(){
                                                           window.livewire.emit('bulkDelete')         
                                                        }
                                                    }
                                                }     
                                            });
                                        }">
                                        Hapus Sekaligus
                                        <x-crud::atoms.icon icon="trash-alt" class="btn-icon-append" />
                                    </x-crud::atoms.button>
                                </th>
                            @endif
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $key => $product)
                            <tr>
                                <td class="align-middle">
                                    <x-crud::atoms.checkbox wire:model="selected.{{ $product->id }}" />
                                </td>
                                <td>
                                    <div class="media d-flex align-items-center">
                                        @foreach ($product->images as $key_image => $image)
                                            @if (!$key_image)
                                                <img src="{{ asset('storage/' . $image->image) }}"
                                                    class="rounded me-2" alt="">
                                            @endif
                                        @endforeach
                                        <div class="media-body">
                                            <a class="fw-bold"
                                                href="{{ asset('store/products/edit-product/' . $product->id) }}">
                                                {{ $product->name }}
                                            </a>
                                            <p>SKU: {{ $product->sku }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Produk dilihat berdasakarkan Google Analytics">
                                                <x-crud::atoms.icon icon="shapes" class="text-muted" />
                                                {{ count($product->variantValues) }}
                                            </span>
                                        </div>
                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Dalam Pengembangan"><i class="fal fa-shopping-bag text-muted"></i>
                                            -</div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group mg-b-10 wd-100">
                                        {{ $product->brand->name }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div x-data="{ selected: '' }" x-init="() => {
                                        $($refs.price).maskMoney({ thousands: '.', precision: 0 });
                                        $($refs.price).on('change.maskMoney', function() {
                                            Livewire.emit('updatePrice', $($refs.price).attr('data-id'), $($refs.price).val());
                                        });
                                    }">
                                        <div class="input-group mg-b-10 wd-200">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" x-ref="price" data-id="{{ $product->id }}"
                                                class="form-control" placeholder="Harga"
                                                value="{{ number_format(round($product->price), 0, ',', '.') }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input type="number"
                                        wire:change.defer="updateStock('{{ $product->id }}',$event.target.value)"
                                        class="form-control wd-100" value="{{ $product->quantity }}"
                                        placeholder="Stok">
                                    @if ($product->quantity === 0)
                                        <i data-feather="alert-octagon" class="tx-danger wd-16 ht-16 mg-t-10 mg-l-5"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Produk tidak bisa dibeli karena stok kurang dari jumlah min."></i>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <x-crud::atoms.switch wire:click="toggleActive({{ $product->id }})"
                                        checked="{{ $product->status }}" />
                                </td>
                                <td class="align-middle">
                                    <x-crud::molecules.dropdown label="{{ __('crud::messages.action') }}">
                                        @can('roles.update')
                                            <a class="dropdown-item"
                                                href="{{ url('store/products/edit-product/' . $product->id) }}">{{ __('crud::messages.edit') }}</a>
                                        @endcan
                                        @can('roles.delete')
                                            <div x-data>
                                                <button class="dropdown-item action-delete"
                                                    x-on:click="() => {
                                                            bootbox.dialog({
                                                                closeButton: false,
                                                                size: 'small',
                                                                centerVertical: true,
                                                                message: `
                                                                    Penghapusan item tidak dapat dibatalkan, anda yakin menghapus item ini??
                                                                `,
                                                                buttons: {
                                                                    ok:{
                                                                        label: 'Yes',
                                                                        className: 'btn-sm btn-danger',
                                                                        callback: function(){
                                                                            @this.emit('delete', {{ $product->id }})              
                                                                        }
                                                                    },
                                                                    no:{
                                                                        label: 'Cancel',
                                                                        className: 'btn-sm btn-secondary',
                                                                        callback: function(){
                                                                                            
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
                    @else
                        <tr class="mt-2">
                            <td class="align-middle" colspan="8">
                                Product not found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $products->links('pagination::bootstrap-5-livewire') }}
        </div>
    </x-crud::molecules.card>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush
@push('script')
    <script src="{{ asset('js/store.js') }}"></script>
@endpush
