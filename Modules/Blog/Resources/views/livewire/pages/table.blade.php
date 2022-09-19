<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Pages' => '/blog/pages']" />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <x-crud::atoms.button size="sm" color="primary" data-bs-toggle="modal"
                                data-bs-target="#createPage">
                                Add New Page
                            </x-crud::atoms.button>
                            @if (count($selected) > 0)
                                <span x-data
                                    x-on:click="
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
                                                    @this.emit('bulkDelete')              
                                                }
                                            },
                                            no:{
                                                label: 'Cancel',
                                                className: 'btn-sm btn-secondary',
                                                callback: function(){}
                                            }
                                        }     
                                    });
                                ">
                                    <x-crud::atoms.button size="sm" color="danger">
                                        Delete
                                    </x-crud::atoms.button>
                                </span>
                            @endif
                        </div>
                        <div class="me-2">
                            <input type="text" class="form-control form-control-sm" placeholder="Search here..."
                                wire:model.lazy="search">
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm btn-inverse-light btn-icon">
                                <span wire:ignore><i data-feather="filter"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th width="50">
                                    <x-crud::atoms.checkbox wire:model="selectAll" />
                                </th>
                                {{-- <th width="80" wire:click.prevent="sortBy('id')">ID
                                    <x-crud::molecules.sorticon name="id" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th> --}}
                                <th wire:click.prevent="sortBy('title')">Title
                                    <x-crud::molecules.sorticon name="title" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th>
                                    Url
                                </th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $key => $page)
                                <tr>
                                    <td>
                                        <x-crud::atoms.checkbox wire:model="selected" value="{{ $page->id }}" />
                                    </td>
                                    {{-- <td>{{ $page->id }}</td> --}}
                                    <td>{{ $page->title }}</td>
                                    <td>
                                        @if ($page->type === 'homepage')
                                            <a href="{{ url('') }}" target="_blank">{{ '/' }}</a>
                                            <span class="badge text-bg-light">Homepage</span>
                                        @else
                                            <a href="{{ url($page->slug) }}"
                                                target="_blank">{{ '/' . $page->slug }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        <x-crud::molecules.dropdown label="Action">
                                            <a class="dropdown-item" href="">Show</a>
                                            @can('roles.update')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#updatePage"
                                                    wire:click="edit({{ $page->id }})">Edit</button>
                                            @endcan
                                            @can('roles.delete')
                                                <div x-data>
                                                    <button class="dropdown-item action-delete"
                                                        x-on:click="
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
                                                                            @this.emit('delete', {{ $page->id }})              
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
                                                        ">Delete</button>
                                                </div>
                                            @endcan
                                        </x-crud::molecules.dropdown>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('blog::livewire.pages.create')
    @include('blog::livewire.pages.update')
</div>
