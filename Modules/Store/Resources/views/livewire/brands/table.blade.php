<div>
    <x-crud::molecules.breadcrumb :items="['Home' => '/', 'Store' => '/store/products', 'Brands' => '/store/brands']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-3">
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createBrand">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add Brand
                    </x-crud::atoms.button>
                </div>
                <div class="me-auto">
                    {{-- <x-crud::atoms.switch type="checkbox" name="target" id="target" wire:model="filterActive"
                        label="{{ $filterActive ? 'Tampil Hanya Aktif' : 'Tampil Semua' }}" /> --}}
                </div>
                <div>
                    <x-crud::atoms.input size="sm" wire:model="search" placeholder="Search Brand" />
                </div>
            </div>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-category">
                <thead>
                    @if ($brands)
                        <tr>
                            <th scope="col" class="tx-bold" wire:click.prevent="sortBy('name')">
                                Brand {{ $sortField }}
                                <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="tx-bold" width="30">Aktif</th>
                            <th scope="col" class="tx-bold" width="50"></th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @if ($brands)
                        @foreach ($brands as $key => $brand)
                            <tr wire:sortable.item="{{ $brand->id }}" wire:key="task-{{ $brand->id }}">
                                <td class="align-middle">
                                    <div class="media d-flex align-items-center">
                                        <img src="{{ asset('storage/files/store/brands/' . $brand->image) }}"
                                            class="rounded me-2" alt="">
                                        <div class="media-body">
                                            <p class="product-title">
                                                <a href="#">
                                                    {{ $brand->name }}
                                                </a>
                                            </p>
                                            <p>{{ count($brand->products) }} Produk</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <x-crud::atoms.switch wire:click="toggleActive({{ $brand->id }})"
                                        checked="{{ $brand->status }}" />
                                </td>
                                <td class="align-middle">
                                    <x-crud::molecules.dropdown label="Action">
                                        @can('brands.update')
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#updateBrand"
                                                wire:click="edit({{ $brand->id }})">Edit</button>
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
                                                                            @this.emit('delete', {{ $brand->id }})              
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
            @include('store::livewire.brands.create')
            @include('store::livewire.brands.update')
        </div>
    </x-crud::molecules.card>
</div>
@push('style')
    <style>
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
@push('style')
    <link rel="stylesheet" href="{{ asset('modules/crud/vendor/filepond/filepond.min.css') }}" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
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
