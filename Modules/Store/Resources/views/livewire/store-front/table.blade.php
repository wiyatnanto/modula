<div>
    <div class="modula-wrapper">
        <div class="modula-sidebar @if($minimize) minimize @endif">
            <div class="modula-sidebar-header">
                <a wire:click="toggleSidebar" class="modula-sidebar-toggle">
                    @if($minimize) <i class="fas fa-chevron-right"></i> @else <i class="fas fa-chevron-left"></i> @endif
                    <span>Sembunyikan Menu</span>
                </a>
            </div>
            <div class="modula-sidebar-body">
                @livewire('store::sidebar')
            </div>
        </div>
        <div class="modula-content @if($minimize) minimize @endif">
            <div class="modula-content-header">
                <i data-feather="search"></i>
                <div class="search-form">
                    <input type="search" class="form-control" placeholder="Search for files and folders">
                </div>
                <nav class="nav d-none d-sm-flex mg-l-auto">
                    <a href="" class="nav-link"><i data-feather="list"></i></a>
                    <a href="" class="nav-link"><i data-feather="alert-circle"></i></a>
                    <a href="" class="nav-link"><i data-feather="settings"></i></a>
                </nav>
            </div>
            <div class="modula-content-body no-header">
                <div class="pd-20 pd-lg-20 pd-xl-20">
                    <div class="d-flex mt-2">
                        <div class="flex-grow-1">
                            <h3 class="tx-semibold tx-20">Etalase</h3>
                        </div>
                        <div>
                            <button id="add-storefront" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                    <div class="mg-y-15 alert alert-store">
                        <h4 class="tx-semibold tx-15 tx-gray-800">Semua Etalase</h4>
                        <p class="mg-b-0">Kelompokkan produkmu ke dalam etalase agar semakin mudah ditemukan pembeli. * Beberapa fitur pada modul etalase dalam pengembangan </p>
                    </div>
                    <div class="card rounded-10">
                        <div class="card-body">
                            <div class="row row-sm">
                                <div class="col-sm-3">
                                    <div class="search-form wd-100p mg-b-15">
                                        <input wire:model="search" type="search" class="form-control" placeholder="Cari kategori">
                                        <button wire:ignore class="btn" type="button" class="bg-grey-600"><i class="far fa-search wd-20"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="custom-control custom-switch mg-t-10">
                                        <input wire:click="toggleFilterActive()" type="checkbox" id="filterActive" class="custom-control-input" @if($filterActive) checked @endif>
                                        <label class="custom-control-label" for="filterActive"> {{ $filterActive ? 'Tampil Hanya Aktif' : 'Tampil Semua' }} </label>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-category">
                                    <thead>
                                        @if($storeFronts)
                                        <tr>
                                            <th scope="col" class="tx-bold">Kategori
                                                @if($sortBy == 'name')
                                                {{ $sortAsc }}
                                                @if($sortAsc === 'desc')
                                                <span wire:click="sortBy('name')"><i data-feather="arrow-up" class="wd-16 ht-16 tx-primary"></i></span>
                                                @else
                                                <span wire:click="sortBy('name')"><i data-feather="arrow-down" class="wd-16 ht-16 tx-primary"></i></span>
                                                @endif
                                                @else
                                                <img src="{{ asset('modules/store/img/sort.png') }}" wire:click="sortBy('name')" width="18" height="18" alt="Sort">
                                                @endif
                                            </th>
                                            <th scope="col" class="tx-bold" width="30">Aktif</th>
                                            <th scope="col" class="tx-bold" width="150"></th>
                                        </tr>
                                        @endif
                                    </thead>
                                    <tbody wire:sortable="updateOrder">
                                        @if($storeFronts)
                                        @foreach($storeFronts as $key => $storeFront)
                                        <tr wire:sortable.item="{{ $storeFront->id }}" wire:key="task-{{ $storeFront->id }}">
                                            <td>
                                                <div class="media d-block d-sm-flex mn-wd-100">
                                                    <img src="{{ count($storeFront->products) > 0 ? asset('storage/files/store/products/'.$storeFront->products->first()->images->first()->image) : asset('modules/core/images/placeholder.png') }}" class="wd-50 ht-50 mg-r-15 rounded">
                                                    <div class="media-body">
                                                        <p class="mg-t-5 mg-b-0 tx-bold tx-gray-800" href="{{ url('#') }}">{{ $storeFront->name }}</p>
                                                        <span data-toggle="tooltip" data-placement="top" title="Dalam Pengembangan" class="tx-13 tx-gray-500">
                                                            {{ count($storeFront->products)}} Produk
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch mg-t-15">
                                                    <input wire:click="toggleActive({{ $storeFront->id}})" type="checkbox" class="custom-control-input" id="switch-{{ $key }}" @if($storeFront->status) checked @endif>
                                                    <label class="custom-control-label" for="switch-{{ $key }}"> </label>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-white btn-icon mg-r-10" wire:sortable.handle>
                                                    <i class="fas fa-arrows-alt"></i>

                                                    <div class="dropdown">
                                                        <button class="btn btn-xs btn-white dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Atur
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item set-storefront" type="button" href="{{ asset('store/storefront/'.$storeFront->id) }}"><i class="fas fa-pencil-alt"></i> Atur Etalase</a>
                                                            <a class="dropdown-item trash-storefront" data-name="{{ $storeFront->name }}" data-id="{{ $storeFront->id }}" type="button"><i class="fas fa-trash-alt"></i> Hapus</a>
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
                                                        <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/icarus/kratos/dadc0fe1.jpg" class="img-fluid" alt="">
                                                        <h5 class="text-center tx-16 tx-medium">Oops, produk yang kamu cari tidak ditemukan</h5>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('modules/store/css/store-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/store/css/store.css') }}">
    <style type="text/css">
        .dd-handle:hover {
            color: #0a58ca !important;
            background: #fff;
            cursor: default;
        }
    </style>
    @endpush
    @push('scripts')
    <script src="{{ asset('modules/store/js/store-bundle.js') }}"></script>
    <script src="{{ asset('modules/store/js/store.js') }}"></script>
    <script type="text/javascript">
        $('#add-storefront').click(function() {
            var dialog = bootbox.confirm({
                title: 'Buat Kategori Baru',
                message: `
                <div class="form-group">
                    <label for="name">Etalase</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama Etalase">
                </div>`,
                centerVertical: true,
                buttons: {
                    cancel: {
                        label: "Batal",
                        className: 'btn-white'
                    },
                    confirm: {
                        label: "Buat",
                        className: 'btn-primary'
                    }
                },
                callback: function(result) {
                    if (result) {
                        Livewire.emit('storeStoreFront', $('#name').val())
                    }
                }
            });
        });
        $('.dropdown-item.trash-storefront').click(function() {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');

            var dialogTrash = bootbox.confirm({
                size: 'small',
                animate: false,
                centerVertical: true,
                className: 'trash',
                message: `
                <div class="tx-center pd-t-20">
                    <div class="tx-20 tx-semibold mg-b-15">Hapus Etalase?</div>
                    <div class="tx-17 tx-gray-800 mg-b-10">` + name + `</div>
                    <div class="tx-14 tx-gray-600">Penghapusan etalase tidak dapat dibatalkan</div>
                </div>`,
                closeButton: false,
                callback: function(result) {
                    if (result) {
                        Livewire.emit('delete', id);
                    }
                },
                buttons: {
                    cancel: {
                        label: "Batal",
                        className: 'btn-sm btn-white'
                    },
                    confirm: {
                        label: "Hapus",
                        className: 'btn-sm btn-primary'
                    }
                }
            });
        });
    </script>
    @endpush