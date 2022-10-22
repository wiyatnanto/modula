<div>
    <x-crud::molecules.breadcrumb :items="['Home' => '/', 'Users' => '/auth/users', 'Roles' => '/auth/roles']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-auto">
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createRole">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add New Role
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
                            <x-crud::atoms.button class="btn-icon-text" size="xs" color="danger">
                                <x-crud::atoms.icon class="btn-icon-prepend" icon="trash" /> Bulk Delete
                            </x-crud::atoms.button>
                        </span>
                    @endif
                </div>
                <div>
                    <x-crud::atoms.input class="form-control-sm" placeholder="Search role ..." wire:model="search" />
                </div>
            </div>
        </x-slot>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th width="50">
                            <x-crud::atoms.checkbox wire:model="selectAll" />
                        </th>
                        <th wire:click.prevent="sortBy('name')">Role Name
                            <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>
                                <x-crud::atoms.checkbox name="userIds[]" wire:model="selected"
                                    value="{{ $role->id }}" />
                            </td>
                            <td>{{ $role->name }}</td>
                            <td class="text-end">
                                <x-crud::molecules.dropdown label="Action">
                                    <a class="dropdown-item" href="">Show</a>
                                    @can('roles.update')
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateRole"
                                            wire:click="edit({{ $role->id }})">Edit</button>
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
                                                                    @this.emit('delete', {{ $role->id }})              
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
        </div>
        <div class="mt-3">
            {{ $roles->links() }}
        </div>
    </x-crud::molecules.card>
    @include('auth::livewire.roles.create')
    @include('auth::livewire.roles.update')
</div>
