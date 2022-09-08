<div>
    <x-crud::molecules.breadcrumb :items="['Home' => '/', 'Builder' => '/crud/build']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-auto">
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createCrud">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add New
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
                    <x-crud::atoms.input class="form-control-sm" placeholder="Search ..." wire:model.lazy="search" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon" color="secondary" size="xs">
                        <x-crud::atoms.icon icon="filter" />
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
                        <th width="80" wire:click.prevent="sortBy('id')">ID
                            <x-crud::molecules.sorticon name="id" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th wire:click.prevent="sortBy('title')">Module
                            <x-crud::molecules.sorticon name="title" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th wire:click.prevent="sortBy('crudType')">Type
                            <x-crud::molecules.sorticon name="crudType" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th wire:click.prevent="sortBy('name')">Class
                            <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th wire:click.prevent="sortBy('db')">Datasource
                            <x-crud::molecules.sorticon name="db" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th wire:click.prevent="sortBy('db_key')">Pk
                            <x-crud::molecules.sorticon name="db_key" sortField="{{ $sortField }}"
                                sortAsc="{{ $sortAsc }}" />
                        </th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cruds as $key => $crud)
                        <tr>
                            <td>
                                <x-crud::atoms.checkbox name="userIds[]" wire:model="selected"
                                    value="{{ $crud->id }}" />
                            </td>
                            <td>{{ $crud->id }}</td>
                            <td>{{ $crud->title }}</td>
                            <td>{{ $crud->type }}</td>
                            <td>{{ $crud->name }}</td>
                            <td>{{ $crud->db }}</td>
                            <td>{{ $crud->db_key }}</td>
                            <td>
                                <x-crud::molecules.dropdown label="Action">
                                    <a class="dropdown-item" href="">Show</a>
                                    @can('users.update')
                                        <a class="dropdown-item"
                                            href="{{ url('/crud/build/config/' . $crud->name) }}">Edit</a>
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
                                                                @this.emit('delete', {{ $crud->id }})              
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
            {{ $cruds->links() }}
        </div>
    </x-crud::molecules.card>
    @include('crud::livewire.cruds.create')
</div>
