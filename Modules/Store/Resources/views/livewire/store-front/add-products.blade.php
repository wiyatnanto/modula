<div wire:ignore.self class="modal fade" id="addProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    <div class="col-sm-4">
                        <div class="search-form wd-100p mg-b-15">
                            <input wire:model="search" type="search" class="form-control" placeholder="Cari nama produk atau SKU">
                            <button wire:ignore class="btn" type="button" class="bg-grey-600"><i data-feather="search"></i></button>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div wire:ignore class="mg-b-15">
                            <div x-data="{selected:''}" x-init="order = $($refs.order).select2({
                                placeholder: 'Pilih Urutan',
                                minimumResultsForSearch: -1,
                                dropdownParent: $('#addProducts'),
                                theme: 'default wd-100p-f'
                            });
                            order.on('select2:select', function(e) {
                                selected = event.target.value;
                                Livewire.emit('sortByFilter', e.target.value);
                            });
                            order.val('').trigger('change');
                        ">
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
                @if($sortBy !== false || count($categoriesFilter) > 0)
                <div class="mg-b-20 mg-t-10 d-flex">
                    <a href="#" wire:click="clearFilter()" class="tx-semibold pd-t-5 mg-r-15">Reset Semua Filter</a>
                    @if($sortBy !== false)
                    <button type="button" class="btn btn-xs btn-white btn-filter rounded-pill mg-r-10">
                        <?php 
                            $sortLabel = array(
                                'name' => array('label' => 'Nama:', 'asc' => 'A - Z', 'desc' => 'Z - A'),
                                'price'=> array('label' => 'Harga', 'asc' => 'Terendah', 'desc' => 'Tertinggi'), 
                                'quantity' => array('label' => 'Stok', 'asc' => 'Terbanyak', 'desc' => 'Tersedikit'));
                            ?>
                        {{ $sortLabel[$sortBy]['label'] }} {{ $sortLabel[$sortBy][$sortAsc] }}
                        <i data-feather="x"></i>
                    </button>
                    @endif
                    @if(count($categoriesFilter) > 0)
                    @foreach($categoriesFilterLabel as $key => $category)
                    <button type="button" class="btn btn-xs btn-white btn-filter rounded-pill mg-r-10" wire:click="removeCategoriesFilter({{ $category->id }})">
                        {{ $category->name }}
                        <i data-feather="x"></i>
                    </button>
                    @endforeach
                    @endif
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-product">
                        <thead>
                            <tr>
                                <th scope="col">
                                </th>
                                <th scope="col" class="tx-bold">Produk</th>
                                <th scope="col" class="tx-bold">Harga</th>
                                <th scope="col" class="tx-bold">Penjualan </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <td>
                                    <label class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" wire:model="selectedItem.{{ $product->id }}"/>
                                        <span class="custom-control-label"></span>
                                        
                                    </label>
                                </td>
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
                                    -
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="store()" class="btn btn-primary" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>