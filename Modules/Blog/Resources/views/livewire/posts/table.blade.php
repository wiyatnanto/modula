<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Posts' => '/blog/posts']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">Posts</h5>
                </div>
                <div class="me-3">
                    <x-crud::atoms.input size="sm" wire:model="search" placeholder="Search Page" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createPost">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" /> New Post
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
                            <th scope="col" class="align-middle text-bold p-0" wire:click.prevent="sortBy('title')">
                                Title
                                <x-crud::molecules.sorticon name="title" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle text-bold p-0"
                                wire:click.prevent="sortBy('published_at')">
                                Publish At
                                <x-crud::molecules.sorticon name="published_at" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle text-bold p-0">Action</th>
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
                    @foreach ($pages as $key => $page)
                        <tr>
                            <td class="align-middle">
                                <x-crud::atoms.checkbox wire:model="selected.{{ $page->id }}" />
                            </td>
                            <td class="align-middle">{{ $page->title }}</td>
                            <td class="align-middle">{{ $page->published_at }}</td>
                            <td class="align-middle">
                                <x-crud::molecules.dropdown label="Action">
                                    <a class="dropdown-item" href="">Show</a>
                                    @can('roles.update')
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updatePost"
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
                                                            Penghapusan item tidak dapat dibatalkan, anda yakin menghapus item ini??
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
    </x-crud::molecules.card>
    @include('blog::livewire.posts.create')
    @include('blog::livewire.posts.update')
</div>
