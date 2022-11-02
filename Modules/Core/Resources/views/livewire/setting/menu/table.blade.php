<div>
    <x-crud::molecules.breadcrumb :items="['Home' => '/', 'Builder' => '/crud/build']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex align-items-center">
                <div class="me-2">Select menu</div>
                <div style="min-width: 200px;" class="me-2">
                    <x-crud::atoms.select2 name="menu" closeOnSelect="false" wire:model="menu">
                        @foreach ($menus as $menuSlug => $menuName)
                            <option value="{{ $menuSlug }}">{{ $menuName }}</option>
                        @endforeach
                    </x-crud::atoms.select2>
                </div>
                <div style="min-width: 200px;" class="me-2">
                    <x-crud::atoms.select2 name="lang" closeOnSelect="false" wire:model="lang">
                        @foreach ($languages as $code => $languageName)
                            <option value="{{ $code }}">{{ $languageName }}</option>
                        @endforeach
                    </x-crud::atoms.select2>
                </div>
                <div class="me-2">
                    or
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" x-data="{}"
                        x-on:click="() => {
                            bootbox.prompt({
                                title: 'Enter new Menu', 
                                closeButton: false,
                                size: 'small',
                                centerVertical: true,
                                callback: function(result){
                                    if(result){
                                        Livewire.emit('storeMenu', result)  
                                    }
                                }  
                            });
                        }">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add New
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-none">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="menu_title" class="form-label">Custom Title </label>
                            <x-crud::atoms.input type="text" placeholder="Title" wire:model="menu_title" />
                            @error('menu_title')
                                <label id="menu_title-error" class="error invalid-feedback"
                                    for="menu_title">{{ $message }}</label>
                            @enderror
                        </div>
                        @if (!$isSeparator)
                            <div class="mb-3">
                                <label for="url" class="form-label">Custom Url </label>
                                <x-crud::atoms.input type="text" placeholder="Url" wire:model="url" />
                            </div>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon </label>
                                    <x-crud::atoms.input type="text" placeholder="far fa-icons" wire:model="icon" />
                                </div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <x-crud::atoms.checkbox wire:model="isSeparator" label="Separator" />
                        </div>
                        <div class="mb-3">
                            <x-crud::atoms.checkbox wire:model="target" label="Open New Tab" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <div>
                                @if ($updateMode)
                                    <button class="btn btn-xs btn-primary" wire:click="updateMenu">
                                        Update Menu
                                    </button>
                                @else
                                    <button class="btn btn-xs btn-primary" wire:click="addItemToMenu('custom')">
                                        Add To Menu
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="accordion" id="addMenuItem">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingCategories">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseproductCategories" aria-expanded="true"
                                aria-controls="collapseproductCategories" wire:ignore.self>
                                Product Categories
                            </button>
                        </h2>
                        <div id="collapseproductCategories" class="accordion-collapse collapse"
                            aria-labelledby="headingOne" data-bs-parent="#addMenuItem" wire:ignore.self>
                            <div class="accordion-body p-3">
                                <div class="border rounded">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($productCategories as $key => $category)
                                            <li class="list-group-item">
                                                <x-crud::atoms.checkbox wire:model="addCategories.{{ $category->id }}"
                                                    label="{{ $category->name }}" />
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <button class="btn btn-xs btn-light">Select All</button>
                                        </div>
                                        <div>
                                            <button class="btn btn-xs btn-primary"
                                                wire:click="addItemToMenu('category')">Add
                                                To
                                                Menu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingCategories">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseCategories" aria-expanded="true"
                                aria-controls="collapseCategories" wire:ignore.self>
                                Categories
                            </button>
                        </h2>
                        <div id="collapseCategories" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#addMenuItem" wire:ignore.self>
                            <div class="accordion-body p-3">
                                <div class="border rounded">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($categories as $key => $category)
                                            <li class="list-group-item">
                                                <x-crud::atoms.checkbox wire:model="addCategories.{{ $category->id }}"
                                                    label="{{ $category->name }}" />
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <button class="btn btn-xs btn-light">Select All</button>
                                        </div>
                                        <div>
                                            <button class="btn btn-xs btn-primary"
                                                wire:click="addItemToMenu('category')">Add
                                                To
                                                Menu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPages">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"
                                wire:ignore.self>
                                Pages
                            </button>
                        </h2>
                        <div id="collapsePages" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#addMenuItem" wire:ignore.self>
                            <div class="accordion-body p-3">
                                <div class="border rounded">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($pages as $key => $page)
                                            <li class="list-group-item">
                                                <x-crud::atoms.checkbox wire:model="addPages.{{ $page->id }}"
                                                    label="{{ $page->title }}" />
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="mt-2">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <button class="btn btn-xs btn-light">Select All</button>
                                        </div>
                                        <div>
                                            <button class="btn btn-xs btn-primary"
                                                wire:click="addItemToMenu('page')">Add To
                                                Menu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingCustom">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseCustom" aria-expanded="false" aria-controls="collapseCustom"
                                wire:ignore.self>
                                Add Menu Item
                            </button>
                        </h2>
                        <div id="collapseCustom" class="accordion-collapse" aria-labelledby="headingThree"
                            data-bs-parent="#addMenuItem" wire:ignore.self>
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="menu_title" class="form-label">Custom Title </label>
                                    <x-crud::atoms.input type="text" placeholder="Title"
                                        wire:model="menu_title" />
                                    @error('menu_title')
                                        <label id="menu_title-error" class="error invalid-feedback"
                                            for="menu_title">{{ $message }}</label>
                                    @enderror
                                </div>
                                @if (!$isSeparator)
                                    <div class="mb-3">
                                        <label for="url" class="form-label">Custom Url </label>
                                        <x-crud::atoms.input type="text" placeholder="Url" wire:model="url" />
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="icon" class="form-label">Icon </label>
                                            <x-crud::atoms.input type="text" placeholder="far fa-icons"
                                                wire:model="icon" />
                                        </div>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <x-crud::atoms.checkbox wire:model="isSeparator" label="Separator" />
                                </div>
                                <div class="mb-3">
                                    <x-crud::atoms.checkbox wire:model="target" label="Open New Tab" />
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <button class="btn btn-xs btn-primary" wire:click="addItemToMenu('custom')">
                                            Add To Menu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 --}}
            </div>
            <div class="col-md-8">
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
                            @foreach ($menuItems->sortBy('sort_order') as $key => $menu)
                                @if ($menu['parent_id'] == 0)
                                    <li class="dd-item" data-id="{{ $menu['id'] }}"
                                        wire:key="{{ $menu['id'] . $key }}">
                                        <div class="mb-2">
                                            <div class="d-flex align-items-center border rounded bg-white p-1">
                                                <div class="dd-handle">
                                                    <x-crud::atoms.icon icon="bars" />
                                                </div>
                                                <div class="me-auto">
                                                    <span
                                                        class="{{ $menu['type'] === 'separator' ? 'separator-title' : '' }}">
                                                        {{ $menu['menu_title'] }}
                                                    </span>
                                                </div>
                                                <div class="me-2">{{ $menu['type'] }} </div>
                                                <div>
                                                    <x-crud::atoms.switch
                                                        wire:model="menuItems.{{ $key }}.status"
                                                        wire:click="toggleView({{ $menu['id'] }})" />
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <a type="button" class="mx-2 text-secondary"
                                                            wire:click="editMenuItem({{ $menu['id'] }})">
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
                                                                Penghapusan item tidak dapat dibatalkan, anda yakin menghapus item ini??
                                                            `,
                                                            buttons: {
                                                                ok:{
                                                                    label: 'Yes',
                                                                    className: 'btn-sm btn-danger',
                                                                    callback: function(){
                                                                        @this.emit('deleteMenuItem', {{ $menu['id'] }})              
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
                                        @if (isset($menu['children']))
                                            @if (count($menu['children']) > 0)
                                                <ol class="dd-list">
                                                    @foreach ($menu['children'] as $key2 => $menu2)
                                                        <li class="dd-item" data-id="{{ $menu2['id'] }}"
                                                            wire:key="{{ $menu2['id'] . $key2 }}">
                                                            <div class="mb-2">
                                                                <div
                                                                    class="d-flex align-items-center border rounded bg-white p-1">
                                                                    <div class="dd-handle">
                                                                        <x-crud::atoms.icon icon="bars" />
                                                                    </div>
                                                                    <div class="me-auto">
                                                                        {{ $menu2['menu_title'] }}
                                                                    </div>
                                                                    <div class="me-2">
                                                                        {{ $menu2['type'] }} </div>
                                                                    <div>
                                                                        <x-crud::atoms.switch
                                                                            wire:model="menuItems.{{ $key }}.children.{{ $key2 }}.status"
                                                                            wire:click="toggleView({{ $menu2['id'] }})" />
                                                                    </div>
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <a type="button"
                                                                                class="mx-2 text-secondary">
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
                                                                                    Penghapusan item tidak dapat dibatalkan, anda yakin menghapus item ini??
                                                                                `,
                                                                                buttons: {
                                                                                    ok:{
                                                                                        label: 'Yes',
                                                                                        className: 'btn-sm btn-danger',
                                                                                        callback: function(){
                                                                                            @this.emit('deleteMenuItem', {{ $menu2['id'] }})              
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
                                                            {{-- {{ dd($menu) }} --}}
                                                            @if (isset($menu2['children']))
                                                                @if (count($menu2['children']) > 0)
                                                                    <ol class="dd-list">
                                                                        @foreach ($menu2['children'] as $key3 => $menu3)
                                                                            <li class="dd-item"
                                                                                data-id="{{ $menu3['id'] }}"
                                                                                wire:key="{{ $menu3['id'] . $key3 }}">
                                                                                <div class="mb-2">
                                                                                    <div
                                                                                        class="d-flex align-items-center border rounded bg-white p-1">
                                                                                        <div class="dd-handle">
                                                                                            <x-crud::atoms.icon
                                                                                                icon="bars" />
                                                                                        </div>
                                                                                        <div class="me-auto">
                                                                                            {{ $menu3['menu_title'] }}
                                                                                        </div>
                                                                                        <div class="me-2">
                                                                                            {{ $menu3['type'] }}
                                                                                        </div>
                                                                                        <div>
                                                                                            <x-crud::atoms.switch
                                                                                                wire:model="menuItems.{{ $key }}.children.{{ $key2 }}.children.{{ $key3 }}.status"
                                                                                                wire:click="toggleView({{ $menu3['id'] }})" />
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
                                                                                                        Penghapusan item tidak dapat dibatalkan, anda yakin menghapus item ini??
                                                                                                    `,
                                                                                                    buttons: {
                                                                                                        ok:{
                                                                                                            label: 'Yes',
                                                                                                            className: 'btn-sm btn-danger',
                                                                                                            callback: function(){
                                                                                                                @this.emit('deleteMenuItem', {{ $menu3['id'] }})              
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
            </div>
            <div class="col-md-12">
                <p class="text-muted tx-13 my-3">* Maksimum menu 3 level</p>
            </div>
        </div>
    </x-crud::molecules.card>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('css/core.css') }}">
@endpush
@push('script')
    <script src="{{ asset('js/core.js') }}"></script>
@endpush
