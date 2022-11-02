<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Posts' => '/blog/posts', 'Categories' => '/blog/categories']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">{{ __('blog::messages.categories') }}</h5>
                </div>
                <div class="me-3">
                    <x-crud::atoms.input size="sm" wire:model="search"
                        placeholder="{{ __('crud::messages.search') }} {{ __('blog::messages.category') }}" />
                </div>
                <div>
                    <x-crud::atoms.button size="sm" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createCategory">
                        {{ __('crud::messages.add') }} {{ __('blog::messages.category') }}
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
                            <th scope="col" class="align-middle text-bold" wire:click.prevent="sortBy('name')">
                                {{ __('blog::messages.category_name') }}
                                <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle text-bold" width="50">
                                {{ __('crud::messages.action') }}</th>
                        @else
                            <th scope="col" class="align-middle text-bold p-0" colspan="3">
                                <x-crud::atoms.button size="xs" color="danger" class="btn-icon-text"
                                    x-on:click="() => {
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
                                                   window.livewire.emit('bulkDelete')         
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
                                }">
                                    Hapus Sekaligus
                                    <x-crud::atoms.icon icon="trash-alt" class="btn-icon-append" />
                                </x-crud::atoms.button>
                            </th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td class="align-middle">
                                <x-crud::atoms.checkbox wire:model="selected.{{ $category->id }}" />
                            </td>
                            <td class="align-middle">{{ $category->name }}</td>
                            <td class="align-middle" width="50">
                                <x-crud::molecules.dropdown label="{{ __('crud::messages.action') }}">
                                    @can('roles.update')
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#updateCategory"
                                            wire:click="edit({{ $category->id }})">{{ __('crud::messages.edit') }}</button>
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
                                                                    @this.emit('delete', {{ $category->id }})              
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
                                                ">{{ __('crud::messages.delete') }}</button>
                                        </div>
                                    @endcan
                                </x-crud::molecules.dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $categories->links('pagination::bootstrap-5-livewire') }}
        </div>
    </x-crud::molecules.card>
    @include('blog::livewire.categories.create')
    @include('blog::livewire.categories.update')
</div>
