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
                            <h3 class="tx-semibold tx-20">Kategori</h3>
                        </div>
                        <div>
                            <button data-toggle="modal" data-target="#createModel" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                    <div class="mg-y-15 alert alert-store">
                        <h4 class="tx-semibold tx-15 tx-gray-800">Semua kategori</h4>
                        <p class="mg-b-0">Atur kategori produk agar semakin mudah ditemukan pembeli. Klik tombol <i class="fas fa-stream mg-t-5"></i> untuk mengatur level kategori</p>
                    </div>
                    <div class="card rounded-10">
                        <div class="card-body">
                            <div class="row row-sm">
                                <div class="col-sm-3">
                                    <div class="search-form wd-100p mg-b-15">
                                        <input wire:model="search" type="search" class="form-control" placeholder="Cari kategori" @if($view==='tree' ) disabled @endif>
                                        <button wire:ignore class="btn" type="button" class="bg-grey-600"><i class="far fa-search wd-20"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="d-flex">
                                        @if($view === 'list')
                                        <button type="button" wire:click="$set('view', 'tree')" class="btn btn-sm btn-white btn-icon mg-r-20 wd-40">
                                            <i class="fas fa-stream mg-t-5"></i>
                                        </button>
                                        @elseif($view === 'tree')
                                        <button type="button" wire:click="$set('view', 'list')" class="btn btn-sm btn-white btn-icon mg-r-20 wd-40">
                                            <i class="fas fa-list mg-t-5"></i>
                                        </button>
                                        @endif
                                        <div class="custom-control custom-switch mg-t-10">
                                            <input wire:click="toggleFilterActive()" type="checkbox" id="filterActive" class="custom-control-input" @if($filterActive) checked @endif @if($view==='tree' ) disabled @endif>
                                            <label class="custom-control-label" for="filterActive"> {{ $filterActive ? 'Tampil Hanya Aktif' : 'Tampil Semua' }} </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @if($view === 'list')
                            <div class="table-responsive">
                                <table class="table table-category">
                                    <thead>
                                        @if($categories)
                                        <tr>
                                            <th scope="col" class="tx-bold">Kategori Utama
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
                                            <th scope="col" class="tx-bold" width="50"></th>
                                        </tr>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @if($categories)
                                        @foreach($categories as $key => $category)
                                        <tr wire:sortable.item="{{ $category->id }}" wire:key="task-{{ $category->id }}">
                                            <td>
                                                <div class="media d-block d-sm-flex mn-wd-100">
                                                    <div class="media-body">
                                                        <p class="mg-t-5 mg-b-0 tx-bold tx-gray-800" href="{{ url('#') }}">{{ $category->name }}</p>
                                                        <span data-toggle="tooltip" data-placement="top" title="Dalam Pengembangan" class="tx-13 tx-gray-500">
                                                            {{ count($category->products)}} Produk
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch mg-t-15">
                                                    <input wire:click="toggleActive({{ $category->id}})" type="checkbox" class="custom-control-input" id="switch-{{ $key }}" @if($category->status) checked @endif>
                                                    <label class="custom-control-label" for="switch-{{ $key }}"> </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-xs btn-white dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" type="button" href="{{ asset('store/product/edit-product/'.$category->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                        <a wire:key=="{{ $category->id }}" class="dropdown-item trash-category"  x-on:click="alert('Hello World!')" data-name="{{ $category->name }}" data-id="{{ $category->id }}" type="button"><i class="fas fa-trash-alt"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @endif
                                @if($view === 'tree')
                                <p class="mg-0 mg-t-10 tx-italic tx-13 tx-gray-600"> Kategori dapat diatur maksimal 3 level </p>
                                <div class="row row-sm">
                                    <div class="col-md-8">
                                        <div x-data x-init="() => {
                                            $($refs.tree).nestable({
                                                maxDepth: 3,
                                                callback: function(l,e){
                                                    console.log($($refs.tree).nestable('serialize'))
                                                    @this.emit('updateOrderTree', $($refs.tree).nestable('serialize'))
                                                }
                                            });
                                            }">
                                            <div class="dd" x-ref="tree">
                                                <ol class="dd-list">
                                                    @foreach($categories as $category)
                                                    @if($category->parent_id === 0)
                                                    <li class="dd-item" data-id="{{ $category->id }}">
                                                        <div class="dd-handle dd3-handle"></div>
                                                        <div class="dd3-content">
                                                            {{ $category->name }}
                                                            <span class="badge badge-pill badge-primary">
                                                                {{ count($category->products).' Produk' }}
                                                            </span>
                                                            <span class="pos-absolute r-10"><a wire:click="edit({{ $category->id }})" data-toggle="modal" data-target="#updateModal" type="button">Ubah</a></span>
                                                        </div>
                                                        @if(count($category->children) > 0)
                                                        <ol class="dd-list">
                                                            @foreach($category->children as $category2)
                                                            <li class="dd-item" data-id="{{ $category2->id }}">
                                                                <div class="dd-handle dd3-handle"></div>
                                                                <div class="dd3-content">
                                                                    {{ $category2->name }}
                                                                    <span class="badge badge-pill badge-primary">
                                                                        {{ count($category2->products).' Produk' }}
                                                                    </span>
                                                                    <span class="pos-absolute r-10"><a wire:click="edit({{ $category2->id }})" data-toggle="modal" data-target="#updateModal" type="button">Ubah</a></span>
                                                                </div>
                                                                @if(count($category2->children) > 0)
                                                                <ol class="dd-list">
                                                                    @foreach($category2->children as $category3)
                                                                    <li class="dd-item" data-id="{{ $category3->id }}">
                                                                        <div class="dd-handle dd3-handle"></div>
                                                                        <div class="dd3-content">
                                                                            {{ $category3->name }}
                                                                            <span class="badge badge-pill badge-primary">
                                                                                {{ count($category3->products).' Produk' }}
                                                                            </span>
                                                                            <span class="pos-absolute r-10"><a wire:click="edit({{ $category3->id }})" data-toggle="modal" data-target="#updateModal" type="button">Ubah</a></span>
                                                                        </div>
                                                                    </li>
                                                                    @endforeach
                                                                </ol>
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ol>
                                                        @endif
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @include('store::livewire.category.create')
                                @include('store::livewire.category.update')
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
    function deleteCategory(e) {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        var dialogTrash = bootbox.confirm({
            size: 'small',
            animate: false,
            centerVertical: true,
            className: 'trash',
            message: `
            <div class="tx-center pd-t-20">
                <div class="tx-20 tx-semibold mg-b-15">Hapus Kategori?</div>
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
    }
    $('.dropdown-item.trash-category').click(function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        var dialogTrash = bootbox.confirm({
            size: 'small',
            animate: false,
            centerVertical: true,
            className: 'trash',
            message: `
            <div class="tx-center pd-t-20">
                <div class="tx-20 tx-semibold mg-b-15">Hapus Kategori?</div>
                <div class="tx-17 tx-gray-800 mg-b-10">` + name + `</div>
                <div class="tx-14 tx-gray-600">Penghapusan kategori tidak dapat dibatalkan</div>
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