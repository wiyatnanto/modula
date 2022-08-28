<div>
    <div class="row mb-2">
        <div class="col-md-12">
            <table class="table mb-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Field</th>
                        <th>Show</th>
                        <th>Searchable</th>
                        <th>Type </th>
                        <th>Validation</th>
                        <th>Format</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $key => $field)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><code>{{ $field['field'] }}</code></td>
                            <td>
                                <x-crud::atoms.checkbox type="checkbox" name="forms.{{ $key }}.view"
                                    wire:model="forms.{{ $key }}.view" />
                            </td>
                            <td>
                                <x-crud::atoms.checkbox type="checkbox" name="forms.{{ $key }}.search"
                                    wire:model="forms.{{ $key }}.search" />
                            </td>
                            <td>
                                Type: {{ $field['type'] }}
                            </td>
                            <td>
                                <x-crud::atoms.input type="text" placeholder="Validation"
                                    name="forms.{{ $key }}.required"
                                    wire:model="forms.{{ $key }}.required" />
                            </td>
                            <td>
                                <x-crud::atoms.button size="sm" color="primary" data-bs-toggle="modal"
                                    data-bs-target="#updateFormFormat" wire:click="editFormFormat({{ $key }})">
                                    Format
                                </x-crud::atoms.button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mb-2">
                <button type="button" class="btn btn-sm btn-primary" wire:click="update()">Update Forms</button>
            </div>
        </div>
    </div>
    @include('crud::livewire.builder.formformat')
</div>
