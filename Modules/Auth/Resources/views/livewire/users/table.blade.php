<div>
    <x-crud::molecules.breadcrumb :items="['Home' => '/', 'Users' => '/auth/users']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">User List</h5>
                </div>
                <div class="me-2">
                    <x-crud::atoms.input class="form-control-sm" placeholder="Search user ..." wire:model="search" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createUser">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add New User
                    </x-crud::atoms.button>
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
                        @if (!count($selected))
                            <th wire:click.prevent="sortBy('name')">Name
                                <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th wire:click.prevent="sortBy('email')">Email
                                <x-crud::molecules.sorticon name="email" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th wire:click.prevent="sortBy('role')" width="200">Role</th>
                            <th>Last Login</th>
                            <th class="text-end">Action</th>
                        @else
                            <th colspan="5">
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
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>
                                <x-crud::atoms.checkbox name="userIds[]" wire:model="selected"
                                    value="{{ $user->id }}" />
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach (collect($user->getRoleNames())->sort() as $val)
                                        @if ($val === 'superadmin')
                                            <x-crud::atoms.badge type="danger" text="{{ $val }}" />
                                        @else
                                            <x-crud::atoms.badge type="primary" text="{{ $val }}" />
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $user->updated_at }}</td>
                            <td class="text-end">
                                <x-crud::molecules.dropdown label="Action">
                                    @can('users.update')
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateUser"
                                            wire:click="edit({{ $user->id }})">Edit</button>
                                    @endcan
                                    @can('users.delete')
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
                                                                    @this.emit('delete', {{ $user->id }})              
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
            {{ $users->links() }}
        </div>
    </x-crud::molecules.card>
    @include('auth::livewire.users.create')
    @include('auth::livewire.users.update')
</div>
