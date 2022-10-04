<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Store' => '/store/products', 'Store Fronts' => '/store/storefronts']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">Store Fronts</h5>
                </div>
                <div class="me-3">
                    <x-crud::atoms.input size="sm" wire:model="search" placeholder="Search Brand" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createStoreFront">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add Store Front
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-category">
                <thead>
                    @if ($storeFronts)
                        <tr>
                            <th scope="col" class="align-middle tx-bold" wire:click.prevent="sortBy('name')">
                                Produk
                                <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle tx-bold" width="30">Aktif</th>
                            <th scope="col" class="align-middle tx-bold" width="50"></th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @if ($storeFronts)
                        @foreach ($storeFronts as $key => $storeFront)
                            <tr wire:sortable.item="{{ $storeFront->id }}" wire:key="task-{{ $storeFront->id }}">
                                <td class="align-middle">
                                    <div class="media d-flex align-items-center">
                                        <img src="{{ count($storeFront->products) > 0 ? asset('storage/files/store/products/' . $storeFront->products->first()->images->first()->image) : asset('modules/core/images/placeholder.png') }}"
                                            class="rounded me-2" alt="">
                                        <div class="media-body">
                                            <p class="product-title">
                                                {{ $storeFront->name }}
                                            </p>
                                            <p>{{ count($storeFront->products) }} Produk</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <x-crud::atoms.switch wire:click="toggleActive({{ $storeFront->id }})"
                                        checked="{{ $storeFront->status }}" />
                                </td>
                                <td class="align-middle">
                                    <x-crud::molecules.dropdown label="Action">
                                        @can('brands.update')
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#updateBrand"
                                                wire:click="edit({{ $storeFront->id }})">Edit</button>
                                            <a class="dropdown-item" type="button"
                                                href="{{ asset('store/storefronts/' . $storeFront->id . '/' . $storeFront->slug) }}">Atur</a>
                                        @endcan
                                        @can('brands.delete')
                                            <div x-data>
                                                <button class="dropdown-item action-delete"
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
                                                                            @this.emit('delete', {{ $storeFront->id }})              
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
                                                        }">Delete</button>
                                            </div>
                                        @endcan
                                    </x-crud::molecules.dropdown>
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
                                        <h5 class="text-center tx-16 tx-medium">Oops, produk yang kamu
                                            cari tidak ditemukan</h5>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $storeFronts->links('pagination::bootstrap-5-livewire') }}
        </div>
        @include('store::livewire.storefronts.create')
    </x-crud::molecules.card>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush
@push('script')
    <script src="{{ asset('js/store.js') }}"></script>
@endpush