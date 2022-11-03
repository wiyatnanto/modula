<div>
    <x-crud::molecules.breadcrumb :items="['Dashboard' => '/dashboard', 'Posts' => '/blog/posts']" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">{{ __('blog::messages.posts') }}</h5>
                </div>
                <div class="me-2">
                    <x-crud::atoms.input size="sm" wire:model="search"
                        placeholder="{{ __('crud::messages.search') }} {{ __('blog::messages.post') }}" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createPost">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" />
                        {{ __('crud::messages.add') }} {{ __('blog::messages.post') }}
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
                            <th scope="col" class="align-middle text-bold" wire:click.prevent="sortBy('title')">
                                Title
                                <x-crud::molecules.sorticon name="title" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle text-bold"
                                wire:click.prevent="sortBy('published_at')">
                                Publish At
                                <x-crud::molecules.sorticon name="published_at" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle text-bold" width="50">
                                {{ __('crud::messages.action') }}
                            </th>
                        @else
                            <th scope="col" class="align-middle text-bold p-0" colspan="3">
                                <x-crud::atoms.button size="xs" color="danger" class="btn-icon-text"
                                    x-on:click="() => {
                                        bootbox.dialog({
                                            closeButton: false,
                                            size: 'small',
                                            centerVertical: true,
                                            title: `{{ __('crud::messages.confirm_delete_title') }}`,
                                            message: `{{ __('crud::messages.confirm_delete_body') }}`,
                                            buttons: {
                                                no:{
                                                    label: '{{ __('crud::messages.cancel') }}',
                                                    className: 'btn-sm btn-secondary'
                                                },
                                                ok:{
                                                    label: '{{ __('crud::messages.confirm_delete_yes') }}',
                                                    className: 'btn-sm btn-danger',
                                                    callback: function(){
                                                        Livewire.emit('bulkDelete')              
                                                    }
                                                }
                                            }    
                                        });
                                    }">
                                    {{ __('crud::messages.bulk_delete') }}
                                    <x-crud::atoms.icon icon="trash-alt" class="btn-icon-append" />
                                </x-crud::atoms.button>
                            </th>
                        @endif
                    </tr>

                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td class="align-middle">
                                <x-crud::atoms.checkbox wire:model="selected.{{ $post->id }}" />
                            </td>
                            <td class="align-middle">{{ $post->title }}</td>
                            <td class="align-middle">{{ $post->published_at }}</td>
                            <td class="align-middle" width="50">
                                <x-crud::molecules.dropdown label="{{ __('crud::messages.action') }}">
                                    @can('roles.update')
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updatePost"
                                            wire:click="edit({{ $post->id }})">{{ __('crud::messages.edit') }}</button>
                                    @endcan
                                    @can('roles.delete')
                                        <div x-data>
                                            <button class="dropdown-item action-delete"
                                                x-on:click="
                                                    bootbox.dialog({
                                                        closeButton: false,
                                                        size: 'small',
                                                        centerVertical: true,
                                                        title: `{{ __('crud::messages.confirm_delete_title') }}`,
                                                        message: `{{ __('crud::messages.confirm_delete_body') }}`,
                                                        buttons: {
                                                            no:{
                                                                label: '{{ __('crud::messages.cancel') }}',
                                                                className: 'btn-sm btn-secondary'
                                                            },
                                                            ok:{
                                                                label: '{{ __('crud::messages.confirm_delete_yes') }}',
                                                                className: 'btn-sm btn-danger',
                                                                callback: function(){
                                                                    Livewire.emit('delete', {{ $post->id }})              
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
            {{ $posts->links('pagination::bootstrap-5-livewire') }}
        </div>
    </x-crud::molecules.card>
    @include('blog::livewire.posts.create')
    @include('blog::livewire.posts.update')
</div>
