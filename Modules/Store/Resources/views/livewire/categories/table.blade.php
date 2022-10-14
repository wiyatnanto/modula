<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Store' => '/store/products', 'Categories' => '/store/categories']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">Categories</h5>
                </div>
                <div class="me-2">
                    @if ($view === 'list')
                        <button class="btn btn-xs btn-light btn-icon" wire:click="$set('view','tree')">
                            <x-crud::atoms.icon icon="stream" />
                        </button>
                    @elseif($view === 'tree')
                        <button class="btn btn-xs btn-light btn-icon" wire:click="$set('view','list')">
                            <x-crud::atoms.icon icon="bars" />
                        </button>
                    @endif
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createCategory">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add Category
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        @if ($view === 'list')
            <div class="table-responsive">
                <table class="table table-category">
                    <thead>
                        @if ($categories)
                            <tr>
                                <th scope="col" class="tx-bold" wire:click.prevent="sortBy('name')">
                                    Category
                                    <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th scope="col" class="tx-bold" width="30">Aktif</th>
                                <th scope="col" class="tx-bold" width="50"></th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @if ($categories)
                            @foreach ($categories as $key => $category)
                                <tr wire:sortable.item="{{ $category->id }}" wire:key="task-{{ $category->id }}">
                                    <td class="align-middle">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body">
                                                <p class="product-title">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#updateBrand"
                                                        wire:click="edit({{ $category->id }})">
                                                        {{ $category->name }}
                                                    </a>
                                                </p>
                                                <p>{{ count($category->products) }} Produk</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <x-crud::atoms.switch wire:click="toggleActive({{ $category->id }})"
                                            checked="{{ $category->status }}" />
                                    </td>
                                    <td class="align-middle">
                                        <x-crud::molecules.dropdown label="Action">
                                            @can('brands.update')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#updateBrand"
                                                    wire:click="edit({{ $category->id }})">Edit</button>
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
                                                                            @this.emit('delete', {{ $category->id }})              
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
                {{ $categories->links('pagination::bootstrap-5-livewire') }}
            </div>
        @elseif($view === 'tree')
            <div x-data="{}" x-init="() => {
                function initMenu() {
                    $($refs.tree).nestable({
                        maxDepth: 3,
                        callback: function(l, e) {
                            @this.emit('updateOrderTree', $($refs.tree).nestable('serialize'))
                        }
                    });
                }
                initMenu();
            }">
                <div class="dd" x-ref="tree">
                    <ol class="dd-list">
                        @foreach ($categoriesTrees->sortBy('order_menu') as $key => $category)
                            @if ($category['parent_id'] == 0)
                                <li class="dd-item" data-id="{{ $category['id'] }}"
                                    wire:key="{{ $category['id'] . $key }}">
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center border rounded bg-white p-1">
                                            <div class="dd-handle">
                                                <x-crud::atoms.icon icon="bars" />
                                            </div>
                                            <div class="me-auto">
                                                <span>
                                                    {{ $category['name'] }}
                                                </span>
                                            </div>
                                            <div class="me-2">
                                                <x-crud::atoms.switch
                                                    wire:model="categoriesTrees.{{ $key }}.status"
                                                    wire:click="toggleView({{ $category['id'] }})" />
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <a type="button" class="mx-2 text-secondary">
                                                        <x-crud::atoms.icon icon="edit" />
                                                    </a>
                                                </div>
                                                <div>
                                                    <a type="button" class="mx-2 text-danger"
                                                        x-on:click="bootbox.dialog({
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
                                                                @this.emit('delete', {{ $category['id'] }})              
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
                                            ">
                                                        <x-crud::atoms.icon icon="trash-alt" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($category['children']))
                                        @if (count($category['children']) > 0)
                                            <ol class="dd-list">
                                                @foreach ($category['children'] as $key2 => $category2)
                                                    <li class="dd-item" data-id="{{ $category2['id'] }}"
                                                        wire:key="{{ $category2['id'] . $key2 }}">
                                                        <div class="mb-2">
                                                            <div
                                                                class="d-flex align-items-center border rounded bg-white p-1">
                                                                <div class="dd-handle">
                                                                    <x-crud::atoms.icon icon="bars" />
                                                                </div>
                                                                <div class="me-auto">
                                                                    {{ $category2['name'] }}
                                                                </div>
                                                                <div class="me-2">
                                                                    <x-crud::atoms.switch
                                                                        wire:model="categoriesTrees.{{ $key }}.children.{{ $key2 }}.status"
                                                                        wire:click="toggleView({{ $category2['id'] }})" />
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <a type="button" class="mx-2 text-secondary">
                                                                            <x-crud::atoms.icon icon="edit" />
                                                                        </a>
                                                                    </div>
                                                                    <div>
                                                                        <a type="button" class="mx-2 text-danger"
                                                                            x-on:click="bootbox.dialog({
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
                                                                                    @this.emit('deleteMenu', {{ $category2['id'] }})              
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
                                                                ">
                                                                            <x-crud::atoms.icon icon="trash-alt" />
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- {{ dd($category) }} --}}
                                                        @if (isset($category2['children']))
                                                            @if (count($category2['children']) > 0)
                                                                <ol class="dd-list">
                                                                    @foreach ($category2['children'] as $key3 => $category3)
                                                                        <li class="dd-item"
                                                                            data-id="{{ $category3['id'] }}"
                                                                            wire:key="{{ $category3['id'] . $key3 }}">
                                                                            <div class="mb-2">
                                                                                <div
                                                                                    class="d-flex align-items-center border rounded bg-white p-1">
                                                                                    <div class="dd-handle">
                                                                                        <x-crud::atoms.icon
                                                                                            icon="bars" />
                                                                                    </div>
                                                                                    <div class="me-auto">
                                                                                        {{ $category3['name'] }}
                                                                                    </div>
                                                                                    <div class="me-2">
                                                                                        <x-crud::atoms.switch
                                                                                            wire:model="categoriesTrees.{{ $key }}.children.{{ $key2 }}.children.{{ $key3 }}.status"
                                                                                            wire:click="toggleView({{ $category3['id'] }})" />
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <div>
                                                                                            <a type="button"
                                                                                                class="mx-2 text-secondary">
                                                                                                <x-crud::atoms.icon
                                                                                                    icon="edit" />
                                                                                            </a>
                                                                                        </div>
                                                                                        <div>
                                                                                            <a type="button"
                                                                                                class="mx-2 text-danger"
                                                                                                x-on:click="bootbox.dialog({
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
                                                                                                        @this.emit('deleteMenu', {{ $category3['id'] }})              
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
                                                                                    ">
                                                                                                <x-crud::atoms.icon
                                                                                                    icon="trash-alt" />
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                        </li>
                                                                    @endforeach
                                                                </ol>
                                                            @endif
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        @endif
        @include('store::livewire.categories.create')
        @include('store::livewire.categories.update')
    </x-crud::molecules.card>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush
@push('script')
    <script src="{{ asset('js/store.js') }}"></script>
@endpush
