<div>
    <x-crud::molecules.breadcrumb :items="[
        __('store::messages.dashboard') => '/dashboard',
        __('store::messages.branches') => '/store/branches',
    ]" />
    <x-crud::molecules.card>
        <x-slot name="header">
            <div class="d-flex justify-content-end align-items-center">
                <div class="me-auto">
                    <h5 class="card-title mb-0">{{ __('store::messages.branches') }}</h5>
                </div>
                <div class="me-3">
                    <x-crud::atoms.input size="sm" wire:model="search"
                        placeholder="{{ __('crud::messages.search') }} {{ __('store::messages.branch') }}" />
                </div>
                <div>
                    <x-crud::atoms.button class="btn-icon-text" size="xs" color="primary" data-bs-toggle="modal"
                        data-bs-target="#createBranch">
                        <x-crud::atoms.icon class="btn-icon-prepend" icon="plus" />{{ __('crud::messages.add') }}
                        {{ __('store::messages.branch') }}
                    </x-crud::atoms.button>
                </div>
            </div>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-category">
                <thead>
                    @if ($branches)
                        <tr>
                            <th scope="col" class="align-middle tx-bold" wire:click.prevent="sortBy('name')">
                                {{ __('store::messages.branch') }}
                                <x-crud::molecules.sorticon name="name" sortField="{{ $sortField }}"
                                    sortAsc="{{ $sortAsc }}" />
                            </th>
                            <th scope="col" class="align-middle tx-bold text-center" width="70">
                                {{ __('store::messages.branch_location') }}
                            </th>
                            <th scope="col" class="align-middle tx-bold" width="40">{{ __('crud::messages.active') }}</th>
                            <th scope="col" class="align-middle tx-bold" width="50">{{ __('crud::messages.action') }}</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @if ($branches)
                        @foreach ($branches as $key => $branch)
                            <tr wire:sortable.item="{{ $branch->id }}" wire:key="task-{{ $branch->id }}">
                                <td class="align-middle">
                                    <div class="media d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $branch->images[0]->image) }}"
                                            class="rounded img-cover me-2" alt="Gambar {{ $branch->name }}">
                                        <div class="media-body">
                                            <p class="product-title">
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#updateBranch"
                                                    wire:click="edit({{ $branch->id }})">
                                                    {{ $branch->name }}
                                                </a>
                                            </p>
                                            <p>{{ __('store::messages.product') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ 'https://google.com/maps/' . json_decode($branch->coordinate, true)['lat'] . '/' . json_decode($branch->coordinate, true)['lng'] }}"
                                        target="_blank" class="btn btn-xs btn-link btn-icon text-dark">
                                        <x-crud::atoms.icon icon="map-marker-alt btn-icon-prepend" />
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <x-crud::atoms.switch wire:click="toggleActive({{ $branch->id }})"
                                        checked="{{ $branch->status }}" />
                                </td>
                                <td class="align-middle">
                                    <x-crud::molecules.dropdown label="{{ __('crud::messages.action') }}">
                                        @can('brands.update')
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#updateBrand"
                                                wire:click="edit({{ $branch->id }})">{{ __('crud::messages.edit') }}</button>
                                        @endcan
                                        @can('brands.delete')
                                            <div x-data>
                                                <button class="dropdown-item action-delete"
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
                                                                            @this.emit('delete', {{ $branch->id }})              
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
                                                        }">{{ __('crud::messages.delete') }}</button>
                                            </div>
                                        @endcan
                                    </x-crud::molecules.dropdown>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $branches->links('pagination::bootstrap-5-livewire') }}
        </div>
        @include('store::livewire.branches.create')
        @include('store::livewire.branches.update')
    </x-crud::molecules.card>
</div>
@push('style')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush
@push('script')
    <script src="{{ asset('js/store.js') }}"></script>
@endpush
