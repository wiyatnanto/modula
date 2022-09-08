<div>
    <x-crud::molecules.breadcrumb :items="['Home' => '/', 'Store' => '/store/products', 'Brands' => '/store/brands']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-3">
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createCrud">
                        <x-crud::atoms.icon id="add-storefront" class="btn-icon-prepend" icon="plus" /> Add New
                    </x-crud::atoms.button>
                </div>
                <div class="me-auto">
                    <x-crud::atoms.switch type="checkbox" name="target" id="target" wire:model="filterActive"
                        label="{{ $filterActive ? 'Tampil Hanya Aktif' : 'Tampil Semua' }}" />
                </div>
                <div>
                    <input wire:model="search" type="search" class="form-control" placeholder="Search Brand" />
                </div>
            </div>
            <div class="alert alert-primary mt-3 mb-0">Kelompokkan produkmu ke dalam etalase agar semakin
                mudah ditemukan pembeli. * Beberapa
                fitur pada modul etalase dalam pengembangan</div>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-category">
                <thead>
                    @if ($storeFronts)
                        <tr>
                            <th scope="col" class="tx-bold">Kategori
                                @if ($sortBy == 'name')
                                    {{ $sortAsc }}
                                    @if ($sortAsc === 'desc')
                                        <span wire:click="sortBy('name')"><i data-feather="arrow-up"
                                                class="wd-16 ht-16 tx-primary"></i></span>
                                    @else
                                        <span wire:click="sortBy('name')"><i data-feather="arrow-down"
                                                class="wd-16 ht-16 tx-primary"></i></span>
                                    @endif
                                @else
                                    <img src="{{ asset('modules/store/img/sort.png') }}" wire:click="sortBy('name')"
                                        width="18" height="18" alt="Sort">
                                @endif
                            </th>
                            <th scope="col" class="tx-bold" width="30">Aktif</th>
                            <th scope="col" class="tx-bold" width="150"></th>
                        </tr>
                    @endif
                </thead>
                <tbody wire:sortable="updateOrder">
                    @if ($storeFronts)
                        @foreach ($storeFronts as $key => $storeFront)
                            <tr wire:sortable.item="{{ $storeFront->id }}" wire:key="task-{{ $storeFront->id }}">
                                <td>
                                    <div class="media d-block d-sm-flex mn-wd-100">
                                        <img src="{{ count($storeFront->products) > 0 ? asset('storage/files/store/products/' . $storeFront->products->first()->images->first()->image) : asset('modules/core/images/placeholder.png') }}"
                                            class="wd-50 ht-50 mg-r-15 rounded">
                                        <div class="media-body">
                                            <p class="mg-t-5 mg-b-0 tx-bold tx-gray-800" href="{{ url('#') }}">
                                                {{ $storeFront->name }}</p>
                                            <span data-toggle="tooltip" data-placement="top" title="Dalam Pengembangan"
                                                class="tx-13 tx-gray-500">
                                                {{ count($storeFront->products) }} Produk
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-switch mg-t-15">
                                        <input wire:click="toggleActive({{ $storeFront->id }})" type="checkbox"
                                            class="custom-control-input" id="switch-{{ $key }}"
                                            @if ($storeFront->status) checked @endif>
                                        <label class="custom-control-label" for="switch-{{ $key }}">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-white btn-icon mg-r-10"
                                        wire:sortable.handle>
                                        <i class="fas fa-arrows-alt"></i>

                                        <div class="dropdown">
                                            <button class="btn btn-xs btn-white dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Atur
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item set-storefront" type="button"
                                                    href="{{ asset('store/storefront/' . $storeFront->id) }}"><i
                                                        class="fas fa-pencil-alt"></i> Atur Etalase</a>
                                                <a class="dropdown-item trash-storefront"
                                                    data-name="{{ $storeFront->name }}"
                                                    data-id="{{ $storeFront->id }}" type="button"><i
                                                        class="fas fa-trash-alt"></i> Hapus</a>
                                            </div>
                                        </div>
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
</div>
@push('style')
    <style type="text/css">
        .dd-handle:hover {
            color: #0a58ca !important;
            background: #fff;
            cursor: default;
        }

        .media img {
            border: 1px solid #eeeeee;
            object-fit: contain;
            width: 56px !important;
            height: 56px !important;
        }

        .media .product-title a {
            font-weight: 600;
            color: #000000;
        }
    </style>
@endpush
