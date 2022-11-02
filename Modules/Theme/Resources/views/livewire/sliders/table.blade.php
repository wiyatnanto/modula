<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Pages' => '/blog/pages']" />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary"
                                data-bs-toggle="modal" data-bs-target="#createSlide">
                                <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> Add New Slide
                            </x-crud::atoms.button>
                            @if (count($selected) > 0)
                                <span x-data
                                    x-on:click="
                                    bootbox.dialog({
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
                                    <x-crud::atoms.checkbox class="mt-1" wire:model="selectAll" />
                                </th>
                                <th class="align-middle tx-bold">Slider</th>
                                <th class="align-middle tx-bold" wire:click.prevent="sortBy('title')">Slide
                                    <x-crud::molecules.sorticon name="title" sortField="{{ $sortField }}"
                                        sortAsc="{{ $sortAsc }}" />
                                </th>
                                <th class="align-middle tx-bold">
                                    Image
                                </th>
                                <th class="text-end" width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliderItems as $key => $slide)
                                <tr>
                                    <td class="align-middle">
                                        <x-crud::atoms.checkbox wire:model="selected" value="{{ $slide->id }}" />
                                    </td>
                                    <td class="align-middle">
                                        <p class="slider-title">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#updateSlide"
                                                wire:click="edit({{ $slide->id }})">{{ $slide->title }}</a>
                                        </p>
                                    </td>
                                    <td class="align-middle">
                                        {{ $slide->slider->name }}
                                    </td>
                                    <td>
                                        <div class="media d-flex">
                                            <img src="{{ asset('storage/' . $slide->image) }}" class="rounded me-2"
                                                alt="Gambar Slider">
                                        </div>
                                    </td>
                                    <td class="align-middle text-end">
                                        <x-crud::molecules.dropdown label="Action">
                                            @can('roles.update')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#updateSlide"
                                                    wire:click="edit({{ $slide->id }})">Edit</button>
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
                                                                    Penghapusan item tidak dapat dibatalkan, anda yakin menghapus item ini??
                                                                `,
                                                                buttons: {
                                                                    ok:{
                                                                        label: 'Yes',
                                                                        className: 'btn-sm btn-danger',
                                                                        callback: function(){
                                                                            @this.emit('delete', {{ $slide->id }})              
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
                        {{ $sliderItems->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('theme::livewire.sliders.create')
    @include('theme::livewire.sliders.update')
</div>
