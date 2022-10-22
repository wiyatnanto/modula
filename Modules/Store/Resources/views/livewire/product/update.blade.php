<div class="content content-fixed">
    <div class="container pd-0">
        <h5>Tambah Produk</h5>
        <div class="card mt-2">
            <div class="card-body pd-30">
                <h5>Upload Produk</h5>
                <p><span wire:ignore><i data-feather="coffee" class="wd-20 ht-20 mg-r-10 tx-warning"></i></span> Hindari berjualan produk palsu/melanggar Hak Kekayaan Intelektual, supaya produkmu tidak dihapus. Pelajari Selengkapnya</p>
                <div class="row mg-t-40">
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mg-lg-t-20">Foto Produk <span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                        <p class="tx-gray-700">Format gambar .jpg .jpeg .png dan ukuran minimum 300 x 300px (Untuk gambar optimal gunakan ukuran minimum 700 x 700 px).</p>
                        <p class="tx-gray-700">Cantumkan min. 3 foto yang menarik agar produk semakin menarik pembeli. {{ isset($images[1]) }}</p>
                    </div>
                    <div class="col-md-8">
                        <div class="row row-sm mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                            <div class="col-6 col-sm">
                                <div class="mg-b-30 @error('images.'.$i) is-invalid @enderror">
                                    <div wire:ignore 
                                        x-data="{ images: @entangle('images.'.$i) }"
                                        x-init="() => {
                                            FilePond.registerPlugin(
                                              FilePondPluginImagePreview,
                                              FilePondPluginImageCrop,
                                              FilePondPluginImageResize,
                                              FilePondPluginImageTransform,
                                              FilePondPluginImageEdit
                                            );
                                                const file = FilePond.create($refs.input);
                                                file.setOptions({
                                                    labelIdle: `<img src='/modules/store/img/image-upload.svg'><br/><span class='tx-14-f'>Foto Utama</span>`,
                                                    imageCropAspectRatio: '1:1',
                                                    stylePanelLayout: 'integrated',
                                                    labelFileProcessingComplete: 'Uploaded',
                                                    server: {
                                                        process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                                            @this.upload('images.{{ $i }}', file, load, error, progress)
                                                        },
                                                        revert: (filename, load) => {
                                                            @this.removeUpload('images.{{ $i }}', filename, load)
                                                        },
                                                        load: (source, load, error, progress, abort, headers) => {
                                                            var myRequest = new Request(source);
                                                            fetch(myRequest).then(function(response) {
                                                                response.blob().then(function(myBlob) {
                                                                load(myBlob)
                                                                });
                                                            });         
                                                        },
                                                        remove: (source, load, error) => {
                                                            Livewire.emit('removeImage', '{{ $i }}');
                                                            load()
                                                        }
                                                    },
                                                });

                                                if(images !== null){
                                                    file.server.load = (source, load, error, progress, abort, headers) => {
                                                        var myRequest = new Request(source);
                                                        fetch(myRequest).then(function(response) {
                                                            response.blob().then(function(myBlob) {
                                                            load(myBlob)
                                                            });
                                                        });         
                                                    }
                                                    file.files = [{
                                                        source: '/storage/store/products/' + images,
                                                        options:{
                                                            type: 'local'
                                                        }
                                                    }];
                                                }

                                                $watch('images', function(value){
                                                    if(value !== null){
                                                        if(!value.includes('livewire-file:') && value !== null){
                                                            file.files = [{
                                                                source: '/storage/store/products/' + value,
                                                                options:{
                                                                    type: 'local'
                                                                }
                                                            }];
                                                        }
                                                    }else{
                                                        file.removeFile()
                                                    }
                                                })
                                            }">
                                        <input type="file" x-ref="input" />
                                    </div>
                                    @error('images'.$i) <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body pd-30">
                <h5>Informasi Produk</h5>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Nama Produk <span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                        <p class="tx-gray-700">Cantumkan min. 40 karakter agar semakin menarik dan mudah ditemukan oleh pembeli, terdiri dari jenis produk, merek, dan keterangan seperti warna, bahan, atau tipe.</p>
                    </div>
                    <div class="col-md-8">
                        <div class="mt-2">
                            <input wire:model="name" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama produk (maksimum 70 karakter)">
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Brand <span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                        <p class="tx-gray-700">Kamu dapat menambah brand baru atau memilih dari daftar brand yang ada</p>
                    </div>
                    <div class="col-md-8">
                        <div class="@error('brand') is-invalid @endif mt-2" style="min-height: 38px;">
                            <div wire:ignore>
                                <div x-data="{selected:''}" 
                                    x-init="select = $($refs.select).select2({
                                            placeholder: 'Pilih Brand'
                                        });
                                        select.on('select2:select', function(e) {
                                            selected = event.target.value;
                                            @this.set('brand', e.target.value);
                                        });
                                        select.val('{{ $brand }}').trigger('change');
                                    ">
                                    <select x-ref="select" class="wd-100p" data-placeholder="Pilih Kategori">
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('brand') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Kategori<span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                    </div>
                    <div class="col-md-8">
                        <div class="@error('category') is-invalid @endif mt-2" style="min-height: 38px;">
                            <div wire:ignore>
                                <div x-data="{selected:''}" 
                                    x-init="select = $($refs.select).select2({
                                            placeholder: 'Pilih Kategori'
                                        });
                                        select.on('select2:select', function(e) {
                                            selected = event.target.value;
                                            @this.set('category', e.target.value);
                                        });
                                        select.val('{{ $category }}').trigger('change');
                                    ">
                                    <select x-ref="select" class="wd-100p" data-placeholder="Pilih Kategori">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('category') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Etalase<span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                        <p class="tx-gray-700">Kamu dapat menambah etalase baru atau memilih dari daftar etalase yang ada</p>
                    </div>
                    <div class="col-md-8">
                        <div class="@error('storefront') is-invalid @endif mt-2" style="min-height: 38px;">
                            <div wire:ignore>
                                <div x-data="{selected: @entangle('storefront')}" 
                                    x-init="select = $($refs.select).select2({
                                            tags: true,
                                            placeholder: 'Pilih Etalase'
                                        });
                                        select.on('change', function(e) {
                                            console.log($($refs.select).select2('data'))
                                            @this.set('storefront', $($refs.select).select2('data'));
                                        });
                                        select.val(selected).trigger('change');
                                    ">
                                    <select x-ref="select" class="wd-100p" multiple="multiple" data-placeholder="Pilih Etalase">
                                        @foreach($storefronts as $storefront)
                                            <option value="{{ $storefront->id }}">{{ $storefront->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('storefront') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body pd-30">
                <h5>Detail Produk</h5>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Deskripsi Produk <span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                        <p class="tx-gray-700">Pastikan deskripsi produk memuat spesifikasi, ukuran, bahan, masa berlaku, dan lainnya. Semakin detail, semakin berguna bagi pembeli, cantumkan min. 260 karakter agar pembeli semakin mudah mengerti dan menemukan produk anda</p>
                    </div>
                    <div class="col-md-8">
                        <div class="mt-2">
                            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="2" placeholder="Deskripsi produk" rows="7" style="min-height: 150px;"></textarea>
                            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header @if(!$hasVarian) bd-0 @endif">
                <h5>Varian Produk</h5>
                <div class="d-flex justify-content-between">
                    <p class="tx-gray-700">Tambahkan varian seperti warna, ukuran, atau lainnya.</p>
                    @if($hasVarian)
                    <button wire:click="$set('hasVarian', false)" class="btn btn-xs btn-primary mg-b-5"><i class="fas fa-trash"></i> Hapus</button>
                    @else
                    <button wire:click="$set('hasVarian', true)" class="btn btn-xs btn-primary mg-b-5"><i class="fas fa-plus"></i> Varian</button>
                    @endif
                </div>
            </div>
            @if($hasVarian)
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Detail Varian</p>
                        <p class="tx-gray-700">Unggah berkas detail varian ext .pdf max 5MB</p>
                    </div>
                    <div class="col-md-8">
                             <div wire:ignore x-data="{ varianFile: @entangle('varianFile') }"
                                x-init="() => {
                                    const file = FilePond.create($refs.input);
                                        file.setOptions({
                                            allowProcess: true,
                                            server: {
                                                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                                    @this.upload('varianFile', file, load, error, progress)
                                                },
                                                revert: (filename, load) => {
                                                    @this.removeUpload('varianFile', filename, load)
                                                },
                                                load: (source, load, error, progress, abort, headers) => {
                                                    var myRequest = new Request(source);
                                                    fetch(myRequest).then(function(response) {
                                                        response.blob().then(function(myBlob) {
                                                        load(myBlob)
                                                        });
                                                    });         
                                                },
                                                remove: (source, load, error) => {
                                                    @this.set('varianFile', null)
                                                    load()
                                                }
                                            },
                                        });
                                        if(varianFile !== null){
                                            file.server.load = (source, load, error, progress, abort, headers) => {
                                                var myRequest = new Request(source);
                                                fetch(myRequest).then(function(response) {
                                                    response.blob().then(function(myBlob) {
                                                    load(myBlob)
                                                    });
                                                });         
                                            }
                                            file.files = [{
                                                source: '/storage/store/files/' + varianFile,
                                                options:{
                                                    type: 'local'
                                                }
                                            }];
                                        }
                                        $watch('varianFile', function(value){
                                            if(value !== null){
                                                if(!value.includes('livewire-file:') && value !== null){
                                                    alert('a')
                                                    file.files = [{
                                                        source: 'http://localhost/storage/store/files/' + value,
                                                        options:{
                                                            type: 'local'
                                                        }
                                                    }];
                                                }
                                            }else{
                                                file.removeFile()
                                            }
                                        })
                                    }">
                                    <input type="file" x-ref="input" />
                            </div>
                    </div>
                    <div class="col-md-4">
                    @foreach($attributes as $key => $attribute) 
                        <div style="min-height: 38px;" class="mg-b-10">
                            <div wire:ignore>
                                <div x-data="{selected: @entangle('attributes')}" x-init="select = $($refs.select).select2({
                                    tags : true,
                                        maximumSelectionLength: 2,
                                        placeholder: 'Pilih Varian'
                                    });
                                    select.on('select2:select', function(e) {
                                        Livewire.emit('selectAttributes', {{ $key }}, e.target.value)
                                    });
                                    select.val('').trigger('change');
                                    ">   
                                    <select x-ref="select" class="wd-100p" data-placeholder="Berat Produk">
                                        @foreach($attributeoptions as $attribute)
                                        <option value="{{ $attribute->name }}">{{ $attribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button wire:click="addVarian()" class="btn btn-xs btn-primary mg-t-10"><i class="fas fa-plus"></i> Tambah Varian</button>
                    </div>
                    <div class="col-md-8">
                        @foreach($attributes as $key => $attribute) 
                        <div style="min-height: 38px;" class="mg-b-10">
                            <div wire:ignore>
                                <div x-data="{selected:''}" x-init="
                                    select = $($refs.select).select2({
                                        tags: true,
                                        placeholder: 'Value'
                                    });
                                    select.on('change', function(e) {
                                        selected = event.target.value;
                                        Livewire.emit('selectAttributeValues', {{ $key }}, $($refs.select).select2('data'))
                                    });
                                    select.val('').trigger('change');
                                    ">
                                    <select x-ref="select" class="wd-100p" multiple="multiple" data-placeholder="Berat Produk">
                                        @foreach($attribute['values'] as $value)
                                            <option value="">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="card mt-2">
            <div class="card-body pd-30">
                <h5>Harga</h5>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Minimum Pemesanan</p>
                        <p class="tx-gray-700">Atur jumlah minimum yang harus dibeli untuk produk ini.</p>
                    </div>
                    <div class="col-md-8">
                        <input wire:model="minOrder" type="number" class="mt-2 form-control @error('minOrder') is-invalid @endif" placeholder="Masukkan Minimum">
                        @error('minOrder') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2 mg-b-10">Harga Satuan <span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                    </div>
                    <div class="col-md-8">
                        <div wire:ignore x-data="{pricex: @entangle('price')}" x-init="price = $($refs.money).maskMoney({thousands: '.',precision: 0});
                                    $($refs.money).on('change.maskMoney', function () {
                                        @this.set('price', $($refs.money).val());
                                    });
                                ">
                            <div class="input-group mg-b-10 mt-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" x-ref="money" class="form-control @error('price') is-invalid @enderror" wire:model="price" placeholder="Harga">
                                @error('price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2 mg-b-10">Potongan Harga (Diskon)</p>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group mg-b-10 mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control" placeholder="0" aria-label="Rp" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body pd-30">
                <h5>Pengeloaan Produk</h5>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Status Produk</p>
                        <p class="tx-gray-700">Jika status aktif, produkmu dapat dicari oleh calon pembeli.</p>
                    </div>
                    <div class="col-md-8">
                        <div class="custom-control custom-switch mg-t-30">
                            <input type="checkbox" class="custom-control-input" id="switch-status" checked disabled>
                            <label class="custom-control-label" for="switch-status"> Aktif</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2 mg-b-10">Stok Produk <span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                    </div>
                    <div class="col-md-8">
                        <input wire:model="quantity" type="number" class="form-control @error('quantity') is-invalid @endif" placeholder="Masukkan Jumlah Stok">
                        @error('quantity') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2 mg-b-10">SKU (Stock Keeping Unit)</p>
                        <p class="tx-gray-700">Gunakan kode unik SKU jika kamu ingin menandai produkmu.</p>
                    </div>
                    <div class="col-md-8">
                        <input wire:model="sku" type="text" class="mt-2 form-control @error('sku') is-invalid @endif" placeholder="Masukkan SKU">
                        @error('sku') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body pd-30">
                <h5>Berat dan Pengiriman</h5>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Berat Produk <span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                        <p class="tx-gray-700">Masukkan berat dengan menimbang produk <br/><b>setelah dikemas</b></p>
                    </div>
                    <div class="col-md-8">
                        <div class="row row-sm mt-2">
                            <div class="col-sm-4">
                                <div style="min-height: 38px;">
                                    <div wire:ignore>
                                        <div x-data="{selected:''}" 
                                            x-init="select = $($refs.select).select2({
                                                    placeholder: 'Berat Produk'
                                                });
                                                select.on('select2:select', function(e) {
                                                    selected = event.target.value;
                                                    @this.set('weightType', e.target.value);
                                                });
                                                select.val('gr').trigger('change');
                                                @this.set('weightType', 'gr');
                                            ">
                                            <select x-ref="select" class="wd-100p" data-placeholder="Berat Produk">
                                                <option value="gr">Gram (gr)</option>
                                                <option value="kg">Kilogram (kg)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <input wire:model="weight" type="text" class="form-control @error('weight') is-invalid @endif" placeholder="Masukkan Berat">
                                @error('weight') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="tx-bold tx-gray-700 mg-b-10 mt-2">Ukuran Produk <span class="badge badge-secondary bg-gray-200 tx-gray-700">wajib</span></p>
                        <p class="tx-gray-700">Masukkan ukuran produk setelah dikemas untuk menghitung berat volume</p>
                    </div>
                    <div class="col-md-8">
                        <div class="row row-sm mt-2">
                            <div class="col-sm-4">
                                <div class="input-group mg-b-10">
                                    <input wire:model="length" type="text" class="form-control @error('length') is-invalid @endif" placeholder="Panjang" aria-describedby="aria-panjang">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="aria-panjang">cm</span>
                                    </div>
                                </div>
                                @error('length') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mg-b-10">
                                    <input wire:model="width" type="text" class="form-control @error('width') is-invalid @endif" placeholder="Lebar" aria-describedby="aria-lebar">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="aria-lebar">cm</span>
                                    </div>
                                </div>
                                @error('width') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group mg-b-10">
                                    <input wire:model="height" type="text" class="form-control @error('height') is-invalid @endif" placeholder="Tinggi" aria-describedby="aria-tinggi">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="aria-tinggi">cm</span>
                                    </div>
                                </div>
                                @error('height') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-2">
            <a href="{{ url('store/product') }}" type="button" class="btn btn-sm btn-white mg-r-10">Batal</a>
            <button wire:click.prevent="store('stay')" type="button" class="btn btn-sm btn-white mg-r-10">Simpan & Tambah Baru</button>
            <button wire:click.prevent="store('stay')" type="button" class="btn btn-sm btn-primary active">Simpan</button>
        </div>
    </div>
</div>
@push('styles')
    <link rel="stylesheet" href="{{ asset('modules/store/css/store-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/store/css/store.css') }}">
    <style type="text/css">
        .card {
            border: none !important;
            box-shadow: 0 1px 6px 0 var(--color-shadow,rgba(49,53,59,0.12));
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('modules/store/js/store-bundle.js') }}"></script>
@endpush