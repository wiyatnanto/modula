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
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-style1 mg-b-0">
                    <li class="breadcrumb-item"><a href="#">Daftar Produk</a></li>
                    <li class="breadcrumb-item"><a href="#">Etalase Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Atur Etalase</li>
                  </ol>
                </nav>
                <div class="d-flex mt-2 mg-b-20">
                    <div class="flex-grow-1">
                        <h3 class="tx-semibold tx-20"><a href="{{ url('store/storefront') }}" class="text-muted mg-r-10"><i class="far fa-arrow-left"></i> </a>Etalase</h3>
                    </div>
                    <div>
                        <button wire:click="update()" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
                <div class="card rounded-10 mg-b-10">
                   <div class="card-body">
                        <label for="name">Etalase</label>
                        <input type="text" wire:model="name" class="form-control" id="name" aria-describedby="namaHelp" placeholder="Tulis nama etalase di sini">
                        <p id="namaHelp" class="mg-t-5 tx-13 text-muted">Nama etalase yang sesuai kategori produk lebih mudah dicari pembeli</p>
                   </div>
                </div>
                <div class="card rounded-10">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="tx-16 tx-semibold tx-gray-700">Produk terpilih</div>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Dalam Pengembangan">Atur Sekaligus</button>
                                <button type="button" data-toggle="modal" data-target="#addProducts" wire:click="addProducts()" class="btn btn-sm btn-outline-primary">Tambah Produk</button>
                            </div>
                        </div>
                        <div class="row row-sm">
                            <div class="col-sm-3">
                                <div class="search-form wd-100p mg-b-15">
                                    <input wire:model="search" type="search" class="form-control" placeholder="Cari produk">
                                    <button wire:ignore class="btn" type="button" class="bg-grey-600"><i data-feather="search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-category">
                                <thead>
                                    @if($products)
                                    <tr>
                                        <th scope="col" class="tx-bold">
                                            Kategori
                                        </th>
                                        <th scope="col" class="tx-bold">Harga</th>
                                        <th scope="col" class="tx-bold">Penjualan</th>
                                        <th scope="col" class="tx-bold"></th>
                                    </tr>
                                    @endif
                                </thead>
                                <tbody wire:sortable="updateOrder">
                                    @if($products)
                                        @foreach($products as $key => $product)
                                        <tr wire:sortable.item="{{ $product->id }}" wire:key="task-{{ $product->id }}">
                                            <td>
                                                <div class="media d-block d-sm-flex mn-wd-100">
                                                    <img src="{{ asset('storage/files/store/products/'.$product->images[0]->image) }}" class="wd-50 ht-50 mg-r-15 rounded">
                                                    <div class="media-body">
                                                        <p class="mg-t-5 tx-bold tx-gray-800" href="{{ url('#') }}">{{ $product->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ number_format(round($product->price),0, ",", ".") }}
                                            </td>
                                            <td>
                                                <span data-toggle="tooltip" data-placement="top" title="Dalam Pengembangan"> penjualan </span>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Dalam Pengembangan"> Hapus</a>
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
                            @livewire('store::store-front.add-products', [
                                'storeFrontId' => $storeFrontId,
                                'selected' => \Arr::pluck($products,'id')
                            ], key('storeFrontId'))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('modules/store/css/store-bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/store/css/store.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('modules/store/js/store-bundle.js') }}"></script>
        <script src="{{ asset('modules/store/js/store.js') }}"></script>
    @endpush
</div>
</div>
