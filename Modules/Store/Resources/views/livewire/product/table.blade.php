<div>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="http://modula.com.test/dashboard">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            asdsa
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-line" role="tablist">
                        <li class="nav-item">
                            <a wire:click="$set('tab',0)" class="nav-link {{ $tab === 0 ? 'active' : '' }}"
                                data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">Semua Produk
                                ({{ $countActive + $countInActive }})</a>
                        </li>
                        @if ($countActive > 0)
                            <li class="nav-item">
                                <a wire:click="$set('tab',1)" class="nav-link {{ $tab === 1 ? 'active' : '' }}"
                                    data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">Aktif
                                    ({{ $countActive }})</a>
                            </li>
                        @endif
                        @if ($countInActive > 0)
                            <li class="nav-item">
                                <a wire:click="$set('tab',2)" class="nav-link {{ $tab === 2 ? 'active' : '' }}"
                                    data-toggle="tab" role="tab" aria-controls="profile"
                                    aria-selected="false">Nonaktif
                                    ({{ $countInActive }})</a>
                            </li>
                        @endif
                    </ul>
                    <div class="row row-sm">
                        <div class="col-sm-3">
                            <div class="search-form wd-100p mg-y-15">
                                <input wire:model="search" type="search" class="form-control"
                                    placeholder="Cari nama produk atau SKU">
                                <button wire:ignore class="btn" type="button" class="bg-grey-600"><i
                                        class="far fa-search wd-20"></i></button>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div wire:ignore class="mg-y-15">
                                <div x-data="{ selected: '' }" x-init="category = $($refs.category).select2MultiCheckboxes({
                                    placeholder: 'Pilih Kategori',
                                    templateSelection: function(selected, total) {
                                        return 'Pilih kategori ' + (selected.length > 0 ? '( ' + selected.length + ' )' : '');
                                    }
                                });
                                
                                $($refs.category).on('select2:select', function(e) {
                                    Livewire.emit('categoriesFilter', $($refs.category).select2('val'));
                                });
                                
                                $($refs.category).on('select2:unselect', function(e) {
                                    Livewire.emit('categoriesFilter', $($refs.category).select2('val'));
                                });
                                
                                $($refs.category).val('').trigger('change');
                                
                                window.addEventListener('unselect2category', (data) => {
                                    $($refs.category).val(data.detail).trigger('change');
                                })">
                                    <select x-ref="category" class="wd-100p" data-placeholder="Pilih Kategori">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div wire:ignore class="mg-y-15">
                                <div x-data="{ selected: '' }" x-init="storefront = $($refs.storefront).select2MultiCheckboxes({
                                    placeholder: 'Pilih Etalase',
                                    templateSelection: function(selected, total) {
                                        return 'Pilih Etalase ' + (selected.length > 0 ? '( ' + selected.length + ' )' : '');
                                    }
                                });
                                $($refs.storefront).on('select2:select', function(e) {
                                    Livewire.emit('storefrontsFilter', $($refs.storefront).select2('val'));
                                });
                                $($refs.storefront).on('select2:unselect', function(e) {
                                    Livewire.emit('storefrontsFilter', $($refs.storefront).select2('val'));
                                });
                                $($refs.storefront).val('').trigger('change');
                                window.addEventListener('unselect2storefront', (data) => {
                                    $($refs.storefront).val(data.detail).trigger('change');
                                })">
                                    <select x-ref="storefront" class="wd-100p" data-placeholder="Pilih Etalase">
                                        @foreach ($storefronts as $storefront)
                                            <option value="{{ $storefront->id }}">{{ $storefront->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div wire:ignore class="mg-y-15">
                                <div x-data="{ selected: '' }" x-init="order = $($refs.order).select2({
                                    placeholder: 'Pilih Urutan',
                                    minimumResultsForSearch: -1,
                                    theme: 'default'
                                });
                                order.on('select2:select', function(e) {
                                    selected = event.target.value;
                                    Livewire.emit('sortByFilter', e.target.value);
                                });
                                order.val('').trigger('change');
                                window.addEventListener('unselect2sort', (data) => {
                                    order.val('').trigger('change');
                                })">
                                    <select x-ref="order" class="wd-100p" data-placeholder="Pilih Urutan">
                                        <option value="price_asc">Harga Terendah</option>
                                        <option value="price_desc">Harga Tertinggi</option>
                                        <option value="name_asc">Nama: A - Z</option>
                                        <option value="name_desc">Nama: Z - A</option>
                                        <option value="quantity_asc">Stok Tersedikit</option>
                                        <option value="quantity_desc">Stok Terbanyak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($sortBy !== false || count($categoriesFilter) > 0 || count($storefrontsFilter) > 0)
                        <div class="mg-b-20 mg-t-10 d-flex">
                            <a href="#" wire:click="clearFilter()" class="tx-gray-800 pd-t-5 mg-r-15">Reset Semua
                                Filter</a>
                            @if ($sortBy !== false)
                                <button type="button" class="btn btn-xs btn-white btn-filter rounded-pill mg-r-10"
                                    wire:click="removeSort()">
                                    <?php
                                    $sortLabel = [
                                        'name' => ['label' => 'Nama:', 'asc' => 'A - Z', 'desc' => 'Z - A'],
                                        'price' => ['label' => 'Harga', 'asc' => 'Terendah', 'desc' => 'Tertinggi'],
                                        'quantity' => ['label' => 'Stok', 'asc' => 'Terbanyak', 'desc' => 'Tersedikit'],
                                    ];
                                    ?>
                                    {{ $sortLabel[$sortBy]['label'] }} {{ $sortLabel[$sortBy][$sortAsc] }}
                                    <i class="fal fa-times mg-l-5"></i>
                                </button>
                            @endif
                            @if (count($categoriesFilter) > 0)
                                @foreach ($categoriesFilterLabel as $key => $category)
                                    <button type="button" class="btn btn-xs btn-white btn-filter rounded-pill mg-r-10"
                                        wire:click="removeCategoriesFilter({{ $category->id }})">
                                        {{ $category->name }}
                                        <i class="fal fa-times mg-l-5"></i>
                                    </button>
                                @endforeach
                            @endif
                            @if (count($storefrontsFilter) > 0)
                                @foreach ($storefrontsFilterLabel as $key => $storefront)
                                    <button type="button" class="btn btn-xs btn-white btn-filter rounded-pill mg-r-10"
                                        wire:click="removeStorefrontFilter({{ $storefront->id }})">
                                        {{ $storefront->name }}
                                        <i class="fal fa-times mg-l-5"></i>
                                    </button>
                                @endforeach
                            @endif
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-product">
                            <thead>
                                @if (count($products) > 0)
                                    <tr>
                                        <th scope="col" width="50">
                                            <label class="custom-control custom-checkbox" wire:key="all">
                                                <input type="checkbox" class="custom-control-input"
                                                    wire:model="selectAll" id="selectAll">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </th>
                                        @if ($selected === null)
                                            <th scope="col">Info Produk
                                                @if ($sortBy == 'name')
                                                    @if ($sortAsc === 'desc')
                                                        <span wire:click="sortBy('name')"><i
                                                                class="fal fa-sort-alpha-up tx-16 tx-gray-600"></i></span>
                                                    @else
                                                        <span wire:click="sortBy('name')"><i
                                                                class="fal fa-sort-alpha-down tx-16 tx-gray-600"></i>
                                                        </span>
                                                    @endif
                                                @else
                                                    <img wire:click="sortBy('name')"
                                                        src="{{ asset('modules/store/img/sort.png') }}"
                                                        width="18" height="18" alt="Sort">
                                                @endif
                                            </th>
                                            <th scope="col">Statistik</th>
                                            <th scope="col">Merek</th>
                                            <th scope="col">Harga
                                                @if ($sortBy == 'price')
                                                    @if ($sortAsc === 'desc')
                                                        <span wire:click="sortBy('price')"><i
                                                                class="fal fa-sort-numeric-up tx-16 tx-gray-600"></i></span>
                                                    @else
                                                        <span wire:click="sortBy('price')"><i
                                                                class="fal fa-sort-numeric-down tx-16 tx-gray-600"></i>
                                                        </span>
                                                    @endif
                                                @else
                                                    <img wire:click="sortBy('price')"
                                                        src="{{ asset('modules/store/img/sort.png') }}"
                                                        width="18" height="18" alt="Sort">
                                                @endif
                                            </th>
                                            <th scope="col">Stok
                                                @if ($sortBy == 'quantity')
                                                    @if ($sortAsc === 'desc')
                                                        <span wire:click="sortBy('quantity')"><i
                                                                class="fal fa-sort-numeric-up tx-16 tx-gray-600"></i></span>
                                                    @else
                                                        <span wire:click="sortBy('quantity')"><i
                                                                class="fal fa-sort-numeric-down tx-16 tx-gray-600"></i>
                                                        </span>
                                                    @endif
                                                @else
                                                    <img wire:click="sortBy('quantity')"
                                                        src="{{ asset('modules/store/img/sort.png') }}"
                                                        width="18" height="18" alt="Sort">
                                                @endif
                                            </th>
                                            <th scope="col" class="tx-bold" width="30">Aktif</th>
                                            <th scope="col" class="tx-bold" width="50"></th>
                                        @else
                                            <th scope="col" class="tx-bold" colspan="7">
                                                <a href="#" type="button"
                                                    class="btn btn-xs btn-outline-danger" id="trash-all-product">
                                                    Hapus Produk <i class="fas fa-trash-alt mg-l-10"></i>
                                                </a>
                                            </th>
                                        @endif
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                @if (count($products) > 0)
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox select mt-2"
                                                    wire:key="{{ $product->id }}">
                                                    <input type="checkbox" class="custom-control-input"
                                                        data-id="{{ $product->id }}"
                                                        wire:model="selected.{{ $product->id }}">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="media d-block d-sm-flex">
                                                    @foreach ($product->images as $key_image => $image)
                                                        @if (!$key_image)
                                                            <img src="{{ asset('storage/files/store/products/' . $image->image) }}"
                                                                class="wd-50 ht-50 mg-r-15 rounded" alt="">
                                                        @endif
                                                    @endforeach
                                                    <div class="media-body">
                                                        <a class="mg-b-5 tx-gray-700"
                                                            href="{{ asset('store/product/edit-product/' . $product->id) }}">{{ $product->name }}</a>
                                                        <p class="mg-b-0">SKU: {{ $product->sku }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="tx-spacing-1 tx-12 tx-grey-600 mg-b-5"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Dalam Pengembangan">Skor: Sempurna</h6>
                                                <div class="progress bg-transparent wd-100 op-7 ht-10 mg-b-15 mg-r-20"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Dalam Pengembangan">
                                                    <div class="progress-bar bg-primary wd-20p" role="progressbar"
                                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="20">
                                                    </div>
                                                    <div class="progress-bar bg-primary wd-20p bd-l bd-white"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="20"></div>
                                                    <div class="progress-bar bg-primary wd-20p bd-l bd-white"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="20"></div>
                                                    <div class="progress-bar bg-primary wd-20p bd-l bd-white"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="20"></div>
                                                    <div class="progress-bar bg-gray-300 wd-20p bd-l bd-white"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="20"></div>
                                                </div>
                                                <span class="tx-13 tx-gray-700" data-toggle="tooltip"
                                                    data-placement="top" title="Dalam Pengembangan">
                                                    <i class="far fa-eye"></i> 15
                                                </span>
                                                <span class="mg-l-10 tx-13 tx-gray-700" data-toggle="tooltip"
                                                    data-placement="top" title="Dalam Pengembangan">
                                                    <i class="fal fa-shopping-bag"></i> 15
                                                </span>
                                            </td>
                                            <td>
                                                <div class="input-group mg-b-10 wd-100">
                                                    {{ $product->brand->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div x-data="{ selected: '' }" x-init="price = $($refs.price).maskMoney({ thousands: '.', precision: 0 });
                                                $($refs.price).on('change.maskMoney', function() {
                                                    Livewire.emit('updatePrice', $($refs.price).attr('data-id'), $($refs.price).val());
                                                });">
                                                    <div class="input-group mg-b-10 wd-200">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <input type="text" x-ref="price"
                                                            data-id="{{ $product->id }}" class="form-control"
                                                            placeholder="Harga"
                                                            value="{{ number_format(round($product->price), 0, ',', '.') }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="d-flex">
                                                <input type="text"
                                                    wire:change="updateStock('{{ $product->id }}',$event.target.value)"
                                                    class="form-control wd-100" value="{{ $product->quantity }}"
                                                    placeholder="Stok">
                                                @if ($product->quantity === 0)
                                                    <i data-feather="alert-octagon"
                                                        class="tx-danger wd-16 ht-16 mg-t-10 mg-l-5"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Produk tidak bisa dibeli karena stok kurang dari jumlah min."></i>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch mg-t-15">
                                                    <input wire:click="toggleActive({{ $product->id }})"
                                                        type="checkbox" class="custom-control-input"
                                                        id="switch-{{ $key }}"
                                                        @if ($product->status) checked @endif>
                                                    <label class="custom-control-label"
                                                        for="switch-{{ $key }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-xs btn-white dropdown-toggle"
                                                        type="button" id="dropdownMenuButton"
                                                        data-toggle="dropdown">
                                                        Atur
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" type="button"
                                                            href="{{ route('store.product.edit', ['id' => $product->id]) }}"><i
                                                                class="fas fa-pencil-alt"></i> Edit</a>
                                                        <a class="dropdown-item" type="button"><i
                                                                class="fas fa-clone"></i> Duplikat Produk</a>
                                                        <a class="dropdown-item trash-product"
                                                            data-name="{{ $product->name }}"
                                                            data-id="{{ $product->id }}" type="button"><i
                                                                class="fas fa-trash-alt"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">
                                            Product tidak ditemukan
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('modules/store/css/store-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/store/css/store.css') }}">
@endpush
@push('script')
    <script src="{{ asset('modules/store/js/store-bundle.js') }}"></script>
    <script src="{{ asset('modules/store/js/store.js') }}"></script>
    <script>
        $("#selectAll").click(function() {
            $('.custom-checkbox.select input:checkbox').not(this).prop('checked', this.checked);
            var selected = [];
            $('.custom-checkbox.select input:checked').not(this).each(function() {
                selected.push($(this).attr('data-id'));
            });
            Livewire.emit('selectAll', selected)
        });
    </script>
@endpush
