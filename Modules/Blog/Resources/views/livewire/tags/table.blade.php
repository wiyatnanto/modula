<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Posts' => '/blog/posts', 'Tags' => '/blog/tags']" />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <x-crud::atoms.button size="sm" color="primary" data-bs-toggle="modal"
                                data-bs-target="#createTag">
                                Add New Tag
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
                                <th wire:click.prevent="sortBy('name')">Name
                                    <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $key => $tag)
                                <tr>
                                    <td>
                                        <x-crud::atoms.checkbox wire:model="selected" value="{{ $tag->id }}" />
                                    </td>
                                    {{-- <td>{{ $tag->id }}</td> --}}
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        <x-crud::molecules.dropdown label="Action">
                                            <a class="dropdown-item" href="">Show</a>
                                            @can('roles.update')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#updateTag"
                                                    wire:click="edit({{ $tag->id }})">Edit</button>
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
                                                                            @this.emit('delete', {{ $tag->id }})              
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
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('blog::livewire.tags.create')
    @include('blog::livewire.tags.update')
</div>
