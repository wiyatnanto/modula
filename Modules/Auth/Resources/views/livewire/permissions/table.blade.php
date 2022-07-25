<div>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <x-crud::atoms.button size="sm" color="primary" text="Add New Permission"
                                data-bs-toggle="modal" data-bs-target="#createPermission" />
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
                                    <x-crud::atoms.button size="sm" color="danger" text="Delete" />
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
                                <th width="80" wire:click.prevent="sortBy('id')">ID
                                    <x-crud::molecules.sorticon name="id" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th wire:click.prevent="sortBy('name')">Name
                                    <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $key => $permission)
                                <tr>
                                    <td>
                                        <x-crud::atoms.checkbox name="userIds[]" wire:model="selected"
                                            value="{{ $permission->id }}" />
                                    </td>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button"
                                                class="btn btn-xs btn-outline-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="">Show</a>
                                                @can('edit.permissions')
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#updatePermission"
                                                        wire:click="edit({{ $permission->id }})">Edit</button>
                                                @endcan
                                                @can('delete.permissions')
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
                                                                            @this.emit('delete', {{ $permission->id }})              
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
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('auth::livewire.permissions.create')
    @include('auth::livewire.permissions.update')
    <x-theme::molecules.toast />
</div>
