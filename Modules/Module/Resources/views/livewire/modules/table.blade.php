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
                            <x-crud::atoms.button size="sm" color="primary" data-bs-toggle="modal"
                                data-bs-target="#createModule">
                                Add New Permission
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="50">
                                        <x-crud::atoms.checkbox wire:model="selectAll" />
                                    </th>
                                    <th width="80" wire:click.prevent="sortBy('name')">Name
                                        <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                            sortAsc="{{ $sortAsc }}" />
                                    </th>
                                    <th width="80" wire:click.prevent="sortBy('lower_name')">App Name
                                        <x-crud::molecules.sorticon name="lower_name" sortField="{{ $sortField }}"
                                            sortAsc="{{ $sortAsc }}" />
                                    </th>
                                    <th wire:click.prevent="sortBy('path')">Path
                                        <x-crud::molecules.sorticon name="path" sortField="{{ $sortField }}"
                                            sortAsc="{{ $sortAsc }}" />
                                    </th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $key => $module)
                                    <tr>
                                        <td>
                                            <x-crud::atoms.checkbox name="selected[]" wire:model="selected"
                                                value="{{ $module['lower_name'] }}" />
                                        </td>
                                        <td>{{ $module['name'] }}</td>
                                        <td>{{ $module['lower_name'] }}</td>
                                        <td>{{ $module['path'] }}</td>
                                        <td>
                                            <x-crud::molecules.dropdown label="Action">
                                                <a href="{{ url('/' . $module['lower_name']) }}" class="dropdown-item"
                                                    target="_blank">Show</a>
                                                @can('modules.update')
                                                    <a href="{{ url('module/setting/' . $module['lower_name']) }}"
                                                        class="dropdown-item">Setting</a>
                                                @endcan
                                                @can('modules.delete')
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
                                                                            @this.emit('delete', '{{ $module['lower_name'] }}')              
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
                </div>
            </div>
        </div>
    </div>
    @include('module::livewire.modules.create')
    @include('module::livewire.modules.update')
</div>
