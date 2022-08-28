<div>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/core/setting') }}">Setting</a></li>
            <li class="breadcrumb-item active" aria-current="page">Menu</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body p-2 ps-3 pe-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">Select menu</div>
                                        <div style="min-width: 200px;" class="me-2">
                                            <x-crud::atoms.select2 name="name" closeOnSelect="false"
                                                wire:model.defer="name">
                                                @foreach ($names as $key => $name)
                                                    <option value="{{ $name }}">{{ $name }}</option>
                                                @endforeach
                                            </x-crud::atoms.select2>
                                        </div>
                                        <div>
                                            or
                                            <span x-data
                                                x-on:click="
                                                    bootbox.prompt({
                                                        title: 'Enter new Menu', 
                                                        closeButton: false,
                                                        size: 'small',
                                                        centerVertical: true,
                                                        callback: function(result){ 
                                                            console.log(result); 
                                                        }  
                                                    });
                                                ">
                                                <a href="#" wire:click="">Create New Menu</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- {{ json_encode($addPages) }} --}}
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingCategories">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseCategories" aria-expanded="true"
                                            aria-controls="collapseCategories" wire:ignore.self>
                                            Categories
                                        </button>
                                    </h2>
                                    <div id="collapseCategories" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample"
                                        wire:ignore.self>
                                        <div class="accordion-body p-0">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($categories as $key => $category)
                                                    <li class="list-group-item">
                                                        <x-crud::atoms.checkbox
                                                            wire:model="addCategories.{{ $category->id }}"
                                                            label="{{ $category->name }}" />
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="p-3">
                                                <div class="d-flex justify-content-between">
                                                    <div class="p-2">
                                                        <button class="btn btn-xs btn-light">Select All</button>
                                                    </div>
                                                    <div class="p-2">
                                                        <button class="btn btn-xs btn-primary"
                                                            wire:click="addToMenu('category')">Add To
                                                            Menu</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPages">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsePages"
                                            aria-expanded="false" aria-controls="collapsePages" wire:ignore.self>
                                            Pages
                                        </button>
                                    </h2>
                                    <div id="collapsePages" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample"
                                        wire:ignore.self>
                                        <div class="accordion-body p-0">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($pages as $key => $page)
                                                    <li class="list-group-item">
                                                        <x-crud::atoms.checkbox
                                                            wire:model="addPages.{{ $page->id }}"
                                                            label="{{ $page->title }}" />
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="p-3">
                                                <div class="d-flex justify-content-between">
                                                    <div class="p-2">
                                                        <button class="btn btn-xs btn-light">Select All</button>
                                                    </div>
                                                    <div class="p-2">
                                                        <button class="btn btn-xs btn-primary"
                                                            wire:click="addToMenu('page')">Add To Menu</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingCustom">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseCustom"
                                            aria-expanded="false" aria-controls="collapseCustom" wire:ignore.self>
                                            Custom Link
                                        </button>
                                    </h2>
                                    <div id="collapseCustom" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample"
                                        wire:ignore.self>
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <label for="menu_title" class="form-label">Custom Title </label>
                                                <x-crud::atoms.input type="text" placeholder="Title"
                                                    name="menu_title" wire:model="menu_title" />
                                                @error('menu_title')
                                                    <label id="menu_title-error" class="error invalid-feedback"
                                                        for="menu_title">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="url" class="form-label">Custom Url </label>
                                                <x-crud::atoms.input type="text" placeholder="Url" name="url"
                                                    wire:model="url" />
                                                @error('url')
                                                    <label id="url-error" class="error invalid-feedback"
                                                        for="url">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="url" class="form-label">Open New Tab </label>
                                                <x-crud::atoms.switch type="checkbox" name="target" id="target"
                                                    wire:model="target" />
                                                @error('url')
                                                    <label id="url-error" class="error invalid-feedback"
                                                        for="url">{{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <div>
                                                    <button class="btn btn-xs btn-primary"
                                                        wire:click="addToMenu('custom')">Add To Menu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            {{-- {{ json_encode($menus) }} --}}
                            <?php $i = 0; ?>
                            <div x-data x-init="() => {
                                $($refs.tree).nestable({
                                    maxDepth: 3,
                                    callback: function(l, e) {
                                        console.log($($refs.tree).nestable('serialize'))
                                        @this.emit('updateOrderTree', $($refs.tree).nestable('serialize'))
                                    }
                                });
                            }">
                                <div class="dd" x-ref="tree">
                                    <ol class="dd-list">
                                        @foreach ($menus as $key => $menu)
                                            @if ($menu['parent_id'] == 0 || $menu['parent_id'] == '0')
                                                <li class="dd-item" data-id="{{ $menu['id'] }}"
                                                    wire:key="{{ $menu['id'] . $key }}">
                                                    <div x-data="{ open: false }" x-init="() => {}"
                                                        class="mb-2">
                                                        <div class="d-flex mb-2 border rounded bg-white"
                                                            x-on:click="open = ! open">
                                                            <div class="p-2 dd-handle">
                                                                <i class="mdi mdi-menu"></i>
                                                            </div>
                                                            <div class="p-2 me-auto">{{ $menu['menu_title'] }}
                                                            </div>
                                                            <div class="p-2">
                                                                <x-crud::atoms.switch type="checkbox"
                                                                    name="toggleView" id="toggleView"
                                                                    wire:model="toggleView({{ $menu['id'] }})" />
                                                            </div>
                                                            <div class="p-2">Edit</div>
                                                        </div>
                                                        <div x-show="open" class="dd-edit" style="display: none">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Label</label>
                                                                <x-crud::atoms.input type="text"
                                                                    placeholder="Label" name="label"
                                                                    wire:model="menus.{{ $i }}.menu_title" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (isset($menu['children']))
                                                        @if (count($menu['children']) > 0)
                                                            <ol class="dd-list">
                                                                @foreach ($menu['children'] as $key2 => $menu2)
                                                                    <li class="dd-item" data-id="{{ $menu2['id'] }}"
                                                                        wire:key="{{ $menu2['id'] . $key2 }}">
                                                                        <div x-data="{ open: false }"
                                                                            x-init="() => {}" class="mb-2">
                                                                            <div class="d-flex border rounded bg-white"
                                                                                x-on:click="open = ! open">
                                                                                <div class="p-2 dd-handle"><i
                                                                                        class="mdi mdi-menu"></i>
                                                                                </div>
                                                                                <div class="p-2 me-auto">
                                                                                    {{ $menu2['menu_title'] }}
                                                                                </div>
                                                                                <div class="p-2">
                                                                                    <x-crud::atoms.switch
                                                                                        type="checkbox"
                                                                                        name="toggleView"
                                                                                        id="toggleView"
                                                                                        wire:model="toggleView({{ $menu2['id'] }})" />
                                                                                </div>
                                                                                <div class="p-2">Edit</div>
                                                                            </div>
                                                                            <div x-show="open" class="dd-edit"
                                                                                style="display: none">
                                                                                <div class="mb-3">
                                                                                    <label for="name"
                                                                                        class="form-label">Label</label>
                                                                                    <x-crud::atoms.input type="text"
                                                                                        placeholder="Label"
                                                                                        name="label"
                                                                                        wire:model="menus.{{ $i }}.menu_title" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @if (isset($menu2['children']))
                                                                            @if (count($menu2['children']) > 0)
                                                                                <ol class="dd-list">
                                                                                    @foreach ($menu2['children'] as $key3 => $menu3)
                                                                                        <li class="dd-item"
                                                                                            data-id="{{ $menu3['id'] }}"
                                                                                            wire:key="{{ $menu3['id'] . $key3 }}">
                                                                                            <div
                                                                                                class="d-flex mb-2 border rounded bg-white">
                                                                                                <div
                                                                                                    class="p-2 dd-handle">
                                                                                                    <i
                                                                                                        class="mdi mdi-menu"></i>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="p-2 me-auto">
                                                                                                    {{ $menu3['menu_title'] }}
                                                                                                </div>
                                                                                                <div class="p-2">
                                                                                                    <x-crud::atoms.switch
                                                                                                        type="checkbox"
                                                                                                        name="toggleView"
                                                                                                        id="toggleView"
                                                                                                        wire:model="toggleView({{ $menu3['id'] }})" />
                                                                                                </div>
                                                                                                <div class="p-2">
                                                                                                    Flex
                                                                                                    item
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('modules/core/vendor/nestable2/jquery.nestable.min.css') }}">
    <style type="text/css">
        .dd {
            max-width: 700px !important;
        }

        .dd-handle {
            height: auto;
            margin: 0px;
            border: none;
            box-shadow: none !important;
            background-color: #ffffff !important;
        }

        .dd-collapse,
        .dd-expand {
            display: none !important;
        }

        .dd-edit {
            padding: 10px;
            background-color: #fff;
            border: 1px solid #e9ecef;
            margin-top: -3px;
            z-index: 1;
            position: relative;
            border-radius: 0px 0px 4px 4px;
        }
    </style>
@endpush
@push('script')
    <script src="{{ asset('modules/core/vendor/nestable2/jquery.nestable.min.js') }}"></script>
@endpush
