<div>
    <x-crud::molecules.breadcrumb :items="[
        'Dashboard' => '/dashboard',
        'Store' => '/store/products',
        'Store Fronts' => '/store/storefronts/' . $storeFrontId . '/' . $slug,
    ]" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">
                        <a href="{{ url('store/storefronts') }}" class="text-dark">
                            <x-crud::atoms.icon icon="long-arrow-left" />
                        </a>
                    </h5>
                </div>
                {{-- <div class="me-2">
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="secondary" wire:click="update">
                        <x-crud::atoms.icon icon="long-arrow-left" /> Kembali ke Etalase
                    </x-crud::atoms.button>
                </div> --}}
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" wire:click="update">
                        Update
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        <x-crud::molecules.form-control name="name" label="Store Fronts">
            <x-crud::atoms.input wire:model="name" />
            <p class="mg-t-5 tx-13 text-muted">Nama etalase yang sesuai kategori produk lebih mudah
                dicari pembeli</p>
        </x-crud::molecules.form-control>
        <div class="d-flex justify-content-start align-items-center mt-4">
            <div>
                <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                    data-bs-target="#addProducts" wire:click="openProducts">
                    <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add Products
                </x-crud::atoms.button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-category">
                <thead>
                    @if ($products)
                        <tr>
                            <th scope="col" class="tx-bold">
                                Kategori
                            </th>
                            <th scope="col" class="tx-bold">Merek</th>
                            <th scope="col" class="tx-bold">Harga</th>
                            <th scope="col" class="tx-bold"></th>
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
                                            <img src="{{ asset('storage/store/products/' . $product->images->first()?->image) }}"
                                                class="rounded me-2" alt="">
                                        @endif
                                        <div class="media-body">
                                            <p class="product-title">
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
                                <td class="align-middle">
                                    <a type="button" class="text-danger" x-data
                                        x-on:click="() => {
                                        bootbox.dialog({
                                            closeButton: false,
                                            size: 'small',
                                            centerVertical: true,
                                            message: `
                                                Are you sure delete this items?
                                            `,
                                            buttons: {
                                                ok:{
                                                    label: 'Yes',
                                                    className: 'btn-sm btn-danger',
                                                    callback: function(){
                                                        @this.emit('deleteStoreFrontProduct', {{ $product->id }})              
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
                                    }">
                                        <x-crud::atoms.icon icon="trash-alt" />
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                <div class="ht-100p d-flex flex-column align-items-center justify-content-center">
                                    <div class="wd-100p wd-sm-300 wd-lg-300 mg-b-15">
                                        <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/icarus/kratos/dadc0fe1.jpg"
                                            class="img-fluid" alt="">
                                        <h5 class="text-center tx-16 tx-medium">Oops, produk yang kamu cari
                                            tidak ditemukan</h5>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </x-crud::molecules.card>
    <x-crud::organisms.modal size="lg" id="addProducts">
        <x-slot name="header">
            <h5 class="modal-title">Add Products</h5>
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
                            Produk
                            <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th scope="col" class="align-middle tx-bold">Merek</th>
                        <th scope="col" class="align-middle tx-bold">Harga</th>
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
                                                <img src="{{ asset('storage/store/products/' . $image->image) }}"
                                                    class="rounded me-2" alt="">
                                            @endif
                                        @endforeach
                                        <div class="media-body">
                                            <p class="product-title">
                                                <a href="{{ asset('store/products/edit-product/' . $product->id) }}">
                                                    {{ $product->name }}
                                                </a>
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
        <x-slot name="footer">
            <x-crud::atoms.button size="sm" color="secondary" data-bs-dismiss="modal" aria-label="btn-close"
                text="Close" />
            <x-crud::atoms.button size="sm" color="primary" text="Add Products"
                wire:click.prevent="updateStoreFrontProducts" />
            <x-crud::atoms.button size="sm" color="primary" text="Add Products & Close"
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
