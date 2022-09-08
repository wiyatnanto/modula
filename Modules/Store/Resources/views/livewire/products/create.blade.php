<div>
    <x-crud::molecules.card>
        <h5 class="mb-4">Upload Produk</h5>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-2"><strong>Foto Produk</strong> <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Format gambar .jpg .jpeg .png dan ukuran minimum 300 x 300px (Untuk gambar
                    optimal
                    gunakan ukuran minimum 700 x 700 px).</p>
                <p>Cantumkan min. 3 foto yang menarik agar produk semakin menarik pembeli.</p>
            </div>
            <div class="col-md-8">
                <div class="row row-sm mt-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-6 col-sm">
                            <div class="mg-b-30">
                                <div wire:ignore x-data="{ images: '' }" x-init="() => {
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
                                        styleButtonRemoveItemPosition: 'left',
                                        labelFileProcessingComplete: 'Uploaded',
                                        allowProcess: true,
                                        instantUpload: true,
                                        server: {
                                            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
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
                                            }
                                        },
                                    });
                                
                                
                                }">
                                    <input type="file" x-ref="input" />
                                </div>
                                @error('images' . $i)
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Virtual Try On Produk</h5>
        <div class="row">
            {{-- <div class="col-md-3">
                <p class="mb-2"><strong>Editor Produk</strong> <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Format gambar .jpg .jpeg .png dan ukuran minimum 300 x 300px (Untuk gambar
                    optimal
                    gunakan ukuran minimum 700 x 700 px).</p>
                <p>Cantumkan min. 3 foto yang menarik agar produk semakin menarik pembeli.</p>
            </div> --}}
            <div class="col-md-12">
                <div class="row row-sm mt-2">
                    <div class="col-6 col-sm">
                        <div class="mg-b-30">
                            <div wire:ignore x-data="{ images: '' }" x-init="() => {
                                FilePond.registerPlugin(
                                    FilePondPluginImagePreview,
                                );
                                const file = FilePond.create($refs.input);
                                file.setOptions({
                                    labelIdle: `<span>Left Temple</span>`,
                                    labelFileProcessingComplete: 'Uploaded',
                                    allowProcess: true,
                                    instantUpload: true,
                                    server: {
                                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                            @this.upload('tryon.images.left', file, load, error, progress)
                                        },
                                        revert: (filename, load) => {
                                            @this.removeUpload('tryon.images.left', filename, load)
                                        },
                                        load: (source, load, error, progress, abort, headers) => {
                                            var myRequest = new Request(source);
                                            fetch(myRequest).then(function(response) {
                                                response.blob().then(function(myBlob) {
                                                    load(myBlob)
                                                });
                                            });
                                        }
                                    },
                                });
                            }">
                                <input type="file" x-ref="input" />
                            </div>
                            @error('images' . $i)
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm">
                        <div class="mg-b-30">
                            <div wire:ignore x-data="{ images: '' }" x-init="() => {
                                FilePond.registerPlugin(
                                    FilePondPluginImagePreview,
                                );
                                const file = FilePond.create($refs.input);
                                file.setOptions({
                                    labelIdle: `<span>Frame Front</span>`,
                                    labelFileProcessingComplete: 'Uploaded',
                                    allowProcess: true,
                                    instantUpload: true,
                                    server: {
                                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                            @this.upload('tryon.images.left', file, load, error, progress)
                                        },
                                        revert: (filename, load) => {
                                            @this.removeUpload('tryon.images.left', filename, load)
                                        },
                                        load: (source, load, error, progress, abort, headers) => {
                                            var myRequest = new Request(source);
                                            fetch(myRequest).then(function(response) {
                                                response.blob().then(function(myBlob) {
                                                    load(myBlob)
                                                });
                                            });
                                        }
                                    },
                                });
                            }">
                                <input type="file" x-ref="input" />
                            </div>
                            @error('images' . $i)
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm">
                        <div class="mg-b-30">
                            <div wire:ignore x-data="{ images: '' }" x-init="() => {
                                FilePond.registerPlugin(
                                    FilePondPluginImagePreview,
                                );
                                const file = FilePond.create($refs.input);
                                file.setOptions({
                                    labelIdle: `<span>Right Temple</span>`,
                                    labelFileProcessingComplete: 'Uploaded',
                                    allowProcess: true,
                                    instantUpload: true,
                                    server: {
                                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                            @this.upload('tryon.images.left', file, load, error, progress)
                                        },
                                        revert: (filename, load) => {
                                            @this.removeUpload('tryon.images.left', filename, load)
                                        },
                                        load: (source, load, error, progress, abort, headers) => {
                                            var myRequest = new Request(source);
                                            fetch(myRequest).then(function(response) {
                                                response.blob().then(function(myBlob) {
                                                    load(myBlob)
                                                });
                                            });
                                        }
                                    },
                                });
                            }">
                                <input type="file" x-ref="input" />
                            </div>
                            @error('images' . $i)
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Informasi Produk</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2">
                    <strong>Nama Produk</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>
                    Cantumkan min. 40 karakter agar semakin menarik dan mudah ditemukan
                    oleh pembeli, terdiri dari jenis produk, merek, dan keterangan seperti warna, bahan, atau
                    tipe.
                </p>
            </div>
            <div class="col-md-8">
                <input wire:model="name" type="text" id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama produk (maksimum 70 karakter)">
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>Brand</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Kamu dapat menambah brand baru atau memilih dari daftar brand yang ada
                </p>
            </div>
            <div class="col-md-8">
                <div wire:ignore>
                    <div x-data="{ selected: '' }" x-init="select = $($refs.select).select2({
                        placeholder: 'Pilih Brand'
                    });
                    select.on('select2:select', function(e) {
                        selected = event.target.value;
                        @this.set('brand', e.target.value);
                    });
                    select.val('').trigger('change');">
                        <select x-ref="select" class="wd-100p" data-placeholder="Pilih Brand">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('brand')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p><strong>Kategori</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
            </div>
            <div class="col-md-8">
                <div wire:ignore>
                    <div x-data="{ selected: '' }" x-init="select = $($refs.select).select2({
                        placeholder: 'Pilih Kategori'
                    });
                    select.on('select2:select', function(e) {
                        selected = event.target.value;
                        @this.set('category', e.target.value);
                    });
                    select.val('').trigger('change');">
                        <select x-ref="select" class="wd-100p" data-placeholder="Pilih Kategori">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('category')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-2"><strong>Etalase</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Kamu dapat menambah etalase baru atau memilih dari daftar etalase yang ada
                </p>
            </div>
            <div class="col-md-8">
                <div wire:ignore>
                    <div x-data="{ selected: @entangle('storefront') }" x-init="select = $($refs.select).select2({
                        tags: true,
                        placeholder: 'Pilih Etalase'
                    });
                    select.on('change', function(e) {
                        @this.set('storefront', $($refs.select).select2('data'));
                    });
                    select.val(selected).trigger('change');">
                        <select x-ref="select" class="wd-100p" multiple="multiple" data-placeholder="Pilih Etalase">
                            @foreach ($storefronts as $storefront)
                                <option value="{{ $storefront->id }}">{{ $storefront->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('storefront')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Detail Produk</h5>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-2">Deskripsi Produk <span class="badge bg-light text-dark">wajib</span>
                </p>
                <p>Pastikan deskripsi produk memuat spesifikasi,
                    ukuran, bahan, masa berlaku, dan lainnya. Semakin detail, semakin
                    berguna bagi pembeli, cantumkan min. 260 karakter agar pembeli
                    semakin mudah mengerti dan menemukan produk anda</p>
            </div>
            <div class="col-md-8">
                <div class="mt-2">
                    <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="2"
                        placeholder="Deskripsi produk" rows="7" style="min-height: 150px;"></textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <div class="row">
            <h5 class="mb-4">Varian Produk</h5>
            <div class="d-flex justify-content-between align-self-center mb-3">
                <div>
                    <p>Tambahkan varian seperti warna, ukuran, atau lainnya.</p>
                </div>
                <div>
                    @if ($hasVarian)
                        <button wire:click="$set('hasVarian', false)" class="btn btn-xs btn-danger btn-icon-text">
                            <i class="far fa-times btn-icon-prepend"></i> Remove Varian</button>
                    @else
                        <button wire:click="$set('hasVarian', true)" class="btn btn-xs btn-primary btn-icon-text">
                            <i class="far fa-plus btn-icon-prepend"></i> Varian</button>
                    @endif
                </div>
            </div>
            @if ($hasVarian)
                <div class="col-md-12">
                    <p class="mb-2"><strong>Panduan Varian</strong></p>
                    <div wire:ignore x-data="{ file: @entangle('varianFile') }" x-init="() => {
                        const file = FilePond.create($refs.input);
                        file.setOptions({
                            allowProcess: true,
                            server: {
                                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
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
                                }
                            },
                        });
                        $watch('varianFile', function(value) {
                            if (value !== null) {
                                if (!value.includes('livewire-file:') && value !== null) {
                                    file.files = [{
                                        source: '/storage/files/store/brands/' + value,
                                        options: {
                                            type: 'local'
                                        }
                                    }];
                                }
                            } else {
                                file.removeFile()
                            }
                        })
                    }">
                        <input type="file" x-ref="input" />
                    </div>
                </div>
                <div class="col-md-12">
                    <table>
                        @if (count($productAttributes) > 0)
                            @foreach ($productAttributes as $key => $attribute)
                                <tr>
                                    <td width="300" class="pe-3">
                                        <label>Tipe Varian {{ $key + 1 }}</label>
                                        <div wire:ignore class="mb-3" wire:key="type.{{ $key }}">
                                            <div x-data="{ selected: @entangle('attributes') }" x-init="select = $($refs.select).select2({
                                                tags: true
                                            });
                                            select.on('select2:select', function(e) {
                                                Livewire.emit('selectAttributes', {{ $key }}, e.target.value)
                                            });
                                            select.val('').trigger('change');">
                                                <select x-ref="select" class="wd-100p"
                                                    data-placeholder="Tipe Varian">
                                                    @foreach ($attributeoptions as $attribute)
                                                        <option value="{{ $attribute->name }}">
                                                            {{ $attribute->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="600">
                                        <label>Pilihan Varian {{ $key + 1 }}</label>
                                        <div wire:ignore class="mb-3" wire:key="value.{{ $key }}">
                                            <div x-data="{ selected: '' }" x-init="select = $($refs.select).select2({
                                                tags: true,
                                                placeholder: 'Value'
                                            });
                                            select.on('change', function(e) {
                                                selected = event.target.value;
                                                Livewire.emit('selectAttributeValues', {{ $key }}, $($refs.select).select2('data'))
                                            });
                                            select.val('').trigger('change');">
                                                <select x-ref="select" class="wd-100p" multiple="multiple"
                                                    data-placeholder="Varian">
                                                    @foreach ($attribute['values'] as $value)
                                                        <option value="">
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="10%">
                                        <label class="d-none">Remove</label>
                                        <div class="mt-3 mb-3">
                                            <x-crud::atoms.button size="md" color="link" class="btn-icon">
                                                <x-crud::atoms.icon icon="trash-alt" class="text-danger"
                                                    wire:click="removeVarian({{ $key }})" />
                                            </x-crud::atoms.button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    {{-- {{ json_encode($productAttributes) }} --}}
                    @if (count($productAttributes) < 2)
                        @if ($productAttributes[count($productAttributes) - 1]['name'] !== null &&
                            count($productAttributes[count($productAttributes) - 1]['values']) > 0)
                            <button wire:key="addVarian" wire:click="addVarian()"
                                class="btn btn-xs btn-primary btn-icon-text">
                                <i class="far fa-plus btn-icon-prepend"></i> Tambah Varian
                            </button>
                        @else
                            <button wire:key="disableAddVarian" class="btn btn-xs btn-primary btn-icon-text" disabled>
                                <i class="far fa-plus btn-icon-prepend"></i> Tambah Varian
                            </button>
                        @endif
                    @endif
                </div>
                @if (count($productAttributes) > 0)
                    <div class="col-md-12">
                        <div class="mt-3">
                            <?php
                            foreach ($productAttributes as $attribute) {
                                if (count($attribute['values']) > 0) {
                                    if (isset($attributesCount)) {
                                        $attributesCount *= count($attribute['values']);
                                    } else {
                                        $attributesCount = count($attribute['values']);
                                    }
                                }
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            @foreach ($productAttributes as $attribute)
                                                @if (count($attribute['values']) > 0)
                                                    <th>{{ $attribute['name'] }}</th>
                                                @endif
                                            @endforeach
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>SKU</th>
                                            <th>Berat</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $valuesKeys = [];
                                        foreach ($productAttributes as $key => $value) {
                                            $valuesCount[$value['name']] = 0;
                                        }
                                        if (isset($attributesCount)) {
                                            for ($i = 0; $i < $attributesCount; $i++) {
                                                foreach ($productAttributes as $key => $value) {
                                                    if ($valuesCount[$value['name']] === count($value['values'])) {
                                                        $valuesCount[$value['name']] = 0;
                                                    }
                                                    $valuesKeys[$value['name']][] = $valuesCount[$value['name']];
                                                    $valuesCount[$value['name']]++;
                                                }
                                            }
                                        }
                                        // echo json_encode($valuesKeys);
                                        ?>
                                        @if (isset($attributesCount))
                                            @if ($attributesCount > 0)
                                                @for ($i = 0; $i < $attributesCount; $i++)
                                                    <tr>
                                                        @foreach ($productAttributes as $key => $attribute)
                                                            @if (count($attribute['values']) > 0)
                                                                @if (count($attribute['values']) > 1 && $key > 0)
                                                                    <?php
                                                                    $collection = collect($valuesKeys[$attribute['name']]);
                                                                    $sorted = $collection->sort();
                                                                    $sorted->values()->all();
                                                                    $keys = $sorted->values()->all();
                                                                    ?>
                                                                    <td>{{ $attribute['values'][$keys[$i]] }}

                                                                    </td>
                                                                @else
                                                                    <td>{{ $attribute['values'][$valuesKeys[$attribute['name']][$i]] }}
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <td>- {{ $i }}</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                @endfor
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Harga</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <p>Minimum Pemesanan</p>
                <p>Atur jumlah minimum yang harus dibeli untuk
                    produk ini.</p>
            </div>
            <div class="col-md-8">
                <input wire:model="minOrder" type="number" class="form-control" placeholder="Masukkan Minimum" />
                @error('minOrder')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>Harga Satuan</strong>
                    <span class="badge bg-light text-dark">wajib</span>
                </p>
            </div>
            <div class="col-md-8">
                <div x-data="{ selected: '' }" x-init="price = $($refs.price).maskMoney({ thousands: '.', precision: 0 });
                $($refs.price).on('change.maskMoney', function() {
                    @this.set('price', $($refs.price).val());
                });">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" x-ref="price"
                            class="form-control @error('price') is-invalid @enderror" placeholder="Harga">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Potongan Harga (Diskon)</strong></p>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control" placeholder="0" aria-label="Rp">
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Pengeloaan Produk</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>Status Produk</strong></p>
                <p>Masukkan berat dengan menimbang produk
                    <strong>setelah dikemas</strong>
                </p>
            </div>
            <div class="col-md-8">
                <x-crud::atoms.switch type="checkbox" checked disabled />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p><strong>Stok Produk </strong><span class="badge bg-light text-dark">wajib</span></p>
            </div>
            <div class="col-md-8">
                <input wire:model="quantity" type="number"
                    class="form-control @error('quantity') is-invalid @endif"
                    placeholder="Masukkan Jumlah Stok">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>SKU (Stock Keeping Unit)</strong></p>
                <p>Gunakan kode unik SKU jika kamu ingin menandai produkmu.</strong>
                </p>
            </div>
            <div class="col-md-8">
                <input wire:model="sku" type="text" class="mg-t-20 form-control @error('sku') is-invalid @endif"
                    placeholder="Masukkan SKU">
            </div>
        </div>
    </x-crud::molecules.card>
    <x-crud::molecules.card class="mt-3">
        <h5 class="mb-4">Berat dan Pengiriman Produk</h5>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-2"><strong>Berat Produk</strong></p>
                <p>Masukkan berat dengan menimbang produk
                    <strong>setelah dikemas</strong>
                </p>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <div wire:ignore>
                            <div x-data="{ selected: '' }" x-init="select = $($refs.select).select2({
                                placeholder: 'Berat Produk'
                            });
                            select.on('select2:select', function(e) {
                                selected = event.target.value;
                                @this.set('weightType', e.target.value);
                            });
                            select.val('gr').trigger('change');
                            @this.set('weightType', 'gr');">
                                <select x-ref="select" class="wd-100p" data-placeholder="Berat Produk">
                                    <option value="gr">Gram (gr)</option>
                                    <option value="kg">Kilogram (kg)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <input wire:model="weight" type="text" class="form-control"
                            placeholder="Masukkan Berat" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <p><strong>Ukuran Produk </strong><span class="badge bg-light text-dark">wajib</span></p>
                <p>Masukkan ukuran produk setelah dikemas untuk menghitung berat volume</p>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group mg-b-10">
                            <input wire:model="length" type="text" class="form-control @error('length') is-invalid @endif"
                    placeholder="Panjang" aria-describedby="aria-panjang">
                <div class="input-group-append">
                    <span class="input-group-text" id="aria-panjang">cm</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="input-group mg-b-10">
                <input wire:model="width" type="text" class="form-control" placeholder="Lebar"
                    aria-describedby="aria-lebar" />
                <div class="input-group-append">
                    <span class="input-group-text" id="aria-lebar">cm</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="input-group mg-b-10">
                <input wire:model="height" type="text" class="form-control" placeholder="Tinggi"
                    aria-describedby="aria-tinggi">
                <div class="input-group-append">
                    <span class="input-group-text" id="aria-tinggi">cm</span>
                </div>
            </div>
        </div>
    </x-crud::molecules.card>
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ url('store/products') }}" type="button" class="btn btn-sm btn-light me-2">Batal</a>
        <button wire:click.prevent="storeAndNew()" type="button" class="btn btn-sm btn-secondary me-2">Simpan &
            Tambah Baru</button>
        <button wire:click.prevent="store()" type="button" class="btn btn-sm btn-primary">Simpan</button>
    </div>
</div>

@push('style')
    <link rel="stylesheet" href="{{ asset('modules/crud/vendor/filepond/filepond.min.css') }}" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet" />
    <style>
        .card {
            border-radius: 8px;
        }

        .card-body {
            padding-left: 2rem;
            padding-right: 2rem;
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .card-body strong {
            font-weight: 500 !important;
        }

        .card-body p {
            color: #31353b;
        }

        .filepond--root .filepond--credits {
            display: none !important
        }

        .filepond--root[data-style-panel-layout~=integrated] .filepond--image-preview-wrapper {
            border-radius: 5px
        }

        .filepond--image-existed {
            width: 123px;
            height: 123px;
            border: 1px solid #e1e5ed;
            border-radius: 5px
        }

        .filepond--image-existed img {
            border-radius: 5px
        }

        .filepond--root[data-style-panel-layout~=integrated] {
            background-color: #eaecf026;
            border-radius: 5px;
            height: 122px !important;
            width: 122px;
            border: 2px dashed #e1e5ed
        }

        .is-invalid .filepond--root[data-style-panel-layout~=integrated] {
            border: 2px dashed #ee828c;
            background-color: #fff0f2;
            opacity: 1
        }
    </style>
@endpush
@push('script')
    <script src="{{ asset('modules/crud/vendor/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('modules/crud/vendor/maskMoney/jquery.maskMoney.min.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
@endpush
