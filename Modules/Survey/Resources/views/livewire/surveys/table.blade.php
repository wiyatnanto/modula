<div>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sruvey</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <x-crud::atoms.button size="sm" color="primary" data-bs-toggle="modal"
                                data-bs-target="#createSurvey">
                                Add New Survey
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
                                <th width="80" wire:click.prevent="sortBy('id')">ID
                                    <x-crud::molecules.sorticon name="id" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th wire:click.prevent="sortBy('name')">Name
                                    <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th wire:click.prevent="sortBy('slug')">Slug
                                    <x-crud::molecules.sorticon name="slug" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surveys as $key => $survey)
                                <tr>
                                    <td>
                                        <x-crud::atoms.checkbox name="userIds[]" wire:model="selected"
                                            value="{{ $survey->id }}" />
                                    </td>
                                    <td>{{ $survey->id }}</td>
                                    <td>{{ $survey->name }}</td>
                                    <td>{{ $survey->slug }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <x-crud::atoms.button class="btn-icon me-1" size="xs"
                                                color="outline-success">
                                                <span wire:ignore>
                                                    <i data-feather="database"></i>
                                                </span>
                                            </x-crud::atoms.button>
                                            <x-crud::molecules.dropdown label="Action">
                                                <a class="dropdown-item" href="">Goto Survey</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('survey/design/' . $survey->slug) }}">Designer</a>
                                                @can('roles.update')
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#updateSurvey"
                                                        wire:click="edit({{ $survey->id }})">Edit</button>
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
                                                                            @this.emit('delete', {{ $survey->id }})              
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
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $surveys->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('survey::livewire.surveys.create')
    @include('survey::livewire.surveys.update')
</div>

@push('style')
    <style>
        .img-preview {
            width: 100px;
            border-radius: 4px;
            object-fit: fill;
            height: 70px;
        }
    </style>
@endpush
