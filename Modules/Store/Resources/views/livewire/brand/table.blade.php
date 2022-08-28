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
                            <h3 class="tx-semibold tx-20">Merek</h3>
                        </div>
                        <div>
                            <button data-toggle="modal" data-target="#createModel" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                    <div class="mg-y-15 alert alert-store">
                        <h4 class="tx-semibold tx-15 tx-gray-800">Semua Merek</h4>
                        <p class="mg-b-0">Atur merek produk agar semakin mudah ditemukan pembeli.</p>
                    </div>
                    <div class="card rounded-10">
                        <div class="card-body">
                            <div class="row row-sm">
                                <div class="col-sm-3">
                                    <div class="search-form wd-100p mg-b-15">
                                        <input wire:model="search" type="search" class="form-control"
                                            placeholder="Cari kategori">
                                        <button wire:ignore class="btn" type="button" class="bg-grey-600"><i
                                                class="far fa-search wd-20"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="custom-control custom-switch mg-t-10">
                                        <input wire:click="toggleFilterActive()" type="checkbox" id="filterActive"
                                            class="custom-control-input" @if($filterActive) checked @endif>
                                        <label class="custom-control-label" for="filterActive"> {{ $filterActive ?
                                            'Tampil Hanya Aktif' : 'Tampil Semua' }} </label>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-category">
                                    <thead>
                                        @if($brands)
                                        <tr>
                                            <th scope="col" class="tx-bold">Brand
                                                @if($sortBy == 'name')
                                                {{ $sortAsc }}
                                                @if($sortAsc === 'desc')
                                                <span wire:click="sortBy('name')"><i data-feather="arrow-up"
                                                        class="wd-16 ht-16 tx-primary"></i></span>
                                                @else
                                                <span wire:click="sortBy('name')"><i data-feather="arrow-down"
                                                        class="wd-16 ht-16 tx-primary"></i></span>
                                                @endif
                                                @else
                                                <img src="{{ asset('modules/store/img/sort.png') }}"
                                                    wire:click="sortBy('name')" width="18" height="18" alt="Sort">
                                                @endif
                                            </th>
                                            <th scope="col" class="tx-bold" width="30">Aktif</th>
                                            <th scope="col" class="tx-bold" width="50"></th>
                                        </tr>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @if($brands)
                                        @foreach($brands as $key => $brand)
                                        <tr wire:sortable.item="{{ $brand->id }}" wire:key="task-{{ $brand->id }}">
                                            <td>
                                                <div class="media d-block d-sm-flex mn-wd-100">
                                                    <img src="{{ asset('storage/files/store/brands/'.$brand->image) }}"
                                                        class="img-fluid wd-50 ht-50 mg-r-15 rounded">
                                                    <div class="media-body">
                                                        <p class="mg-t-5 mg-b-0 tx-bold tx-gray-800"
                                                            href="{{ url('#') }}">{{ $brand->name }}</p>
                                                        <span data-toggle="tooltip" data-placement="top"
                                                            title="Dalam Pengembangan" class="tx-13 tx-gray-700">
                                                            {{ count($brand->products)}} Produk
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch mg-t-15">
                                                    <input wire:click="toggleActive({{ $brand->id}})" type="checkbox"
                                                        class="custom-control-input" id="switch-{{ $key }}"
                                                        @if($brand->status) checked @endif>
                                                    <label class="custom-control-label" for="switch-{{ $key }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-xs btn-white dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" wire:click="edit({{ $brand->id }})"
                                                            data-toggle="modal" data-target="#updateModal"
                                                            type="button"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                        <a class="dropdown-item trash-brand" type="button"
                                                            data-name="{{ $brand->name }}" data-id="{{ $brand->id }}"><i
                                                                class="fas fa-trash-alt"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">
                                                <div
                                                    class="ht-100p d-flex flex-column align-items-center justify-content-center">
                                                    <div class="wd-100p wd-sm-300 wd-lg-300 mg-b-15">
                                                        <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/icarus/kratos/dadc0fe1.jpg"
                                                            class="img-fluid" alt="">
                                                        <h5 class="text-center tx-16 tx-medium">Oops, produk yang kamu
                                                            cari tidak ditemukan</h5>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @include('store::livewire.brand.create')
                                @include('store::livewire.brand.update')
                            </div>
                        </div>
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
    $('.dropdown-item.trash-brand').click(function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        var dialogTrash = bootbox.confirm({
            size: 'small',
            animate: false,
            centerVertical: true,
            className: 'trash',
            message: `
            <div class="tx-center pd-t-20">
                <div class="tx-20 tx-semibold mg-b-15">Hapus Merek?</div>
                <div class="tx-17 tx-gray-800 mg-b-10">` + name + `</div>
                <div class="tx-14 tx-gray-600">Penghapusan merek tidak dapat dibatalkan</div>
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