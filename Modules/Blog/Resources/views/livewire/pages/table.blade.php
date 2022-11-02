<div>
    <x-crud::molecules.breadcrumb :items="[
        __('store::messages.dashboard') => '/dashboard',
        __('blog::messages.pages') => '/blog/pages',
    ]" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">{{ __('blog::messages.pages') }}</h5>
                </div>
                <div class="me-3">
                    <x-crud::atoms.input size="sm" wire:model="search"
                        placeholder="{{ __('crud::messages.search') }} {{ __('blog::messages.page') }}" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createPage">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" />{{ __('crud::messages.add') }}
                        {{ __('blog::messages.page') }}
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th width="50" class="align-middle text-bold">
                            <x-crud::atoms.checkbox wire:model="selectAll" />
                        </th>
                        @if (!count($selected))
                            <th scope="col" class="align-middle text-bold" wire:click.prevent="sortBy('title')"
                                width="60%">
                                {{ __('blog::messages.page_title') }}
                                <x-crud::molecules.sorticon name="title" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle text-bold">
                                {{ __('blog::messages.page_url') }}
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
                    @foreach ($pages as $key => $page)
                        <tr>
                            <td class="align-middle">
                                <x-crud::atoms.checkbox wire:model="selected.{{ $page->id }}" />
                            </td>
                            <td class="align-middle" width="60%">{{ $page->title }}</td>
                            <td class="align-middle">
                                @if ($page->type === 'homepage')
                                    <a href="{{ url('') }}" target="_blank">{{ '/' }}</a>
                                    <span class="badge text-bg-light">Homepage</span>
                                @else
                                    <a href="{{ url($page->slug) }}" target="_blank">{{ '/' . $page->slug }}</a>
                                @endif
                            </td>
                            <td class="align-middle text-end">
                                <x-crud::molecules.dropdown label="{{ __('crud::messages.action') }}">
                                    @can('roles.update')
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updatePage"
                                            wire:click="edit({{ $page->id }})">{{ __('crud::messages.edit') }}</button>
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
            {{ $pages->links() }}
        </div>
    </x-crud::molecules.card>
    @include('blog::livewire.pages.create')
    @include('blog::livewire.pages.update')
</div>
