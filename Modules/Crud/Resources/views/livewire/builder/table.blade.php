<div>
    <div class="row mb-2">
        <div class="col-md-12">
            <table class="table mb-3">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="150">Field</th>
                        <th width="200">Title / Caption </th>
                        <th width="50">Show</th>
                        <th width="50">VD</th>
                        <th width="50">ST</th>
                        <th width="50">DW</th>
                        <th width="80">Width</th>
                        <th width="100">Align</th>
                        <th>Format As </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grids as $key => $field)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><code>{{ $field['field'] }}</code></td>
                            <td>
                                <x-crud::atoms.input type="text" placeholder="Title Caption"
                                    name="grids.{{ $key }}.label"
                                    wire:model="grids.{{ $key }}.label" />
                            </td>
                            <td>
                                <x-crud::atoms.checkbox type="checkbox" name="grids.{{ $key }}.view"
                                    wire:model="grids.{{ $key }}.view" />
                            </td>
                            <td>
                                <x-crud::atoms.checkbox type="checkbox" name="grids.{{ $key }}.detail"
                                    wire:model="grids.{{ $key }}.detail" />
                            </td>
                            <td>
                                <x-crud::atoms.checkbox type="checkbox" name="grids.{{ $key }}.sortable"
                                    wire:model="grids.{{ $key }}.sortable" />
                            </td>
                            <td>
                                <x-crud::atoms.checkbox type="checkbox" name="grids.{{ $key }}.download"
                                    wire:model="grids.{{ $key }}.download" />
                            </td>
                            <td>
                                <x-crud::atoms.input type="text" placeholder="Width"
                                    name="grids.{{ $key }}.width"
                                    wire:model="grids.{{ $key }}.width" />
                            </td>
                            <td>
                                <x-crud::atoms.select2 name="grids.{{ $key }}.align"
                                    wire:model.defer="false">
                                    <option value="left">Left</option>
                                    <option value="center">Center</option>
                                    <option value="right">Right</option>
                                </x-crud::atoms.select2>
                            </td>
                            <td>
                                <x-crud::atoms.dropdown text="{{ $grids[$key]['format_as'] === '' ? 'Format' : $grids[$key]['format_as'] }}" wire:model="grids.{{ $key }}.format_as">
                                    @foreach ($formats as $val => $format)
                                        <x-crud::atoms.dropdown-item value="{{ $val }}">
                                            {{ $val }}
                                        </x-crud::atoms.dropdown-item>
                                    @endforeach
                                </x-crud::atoms.dropdown>
                            </td>
                            <td>
                                <x-crud::atoms.input type="text" placeholder="Format Value"
                                    name="grids.{{ $key }}.format_value"
                                    wire:model="grids.{{ $key }}.format_value" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mb-2">
                <button type="button" class="btn btn-sm btn-primary" wire:click="update()">Update Table</button>
            </div>
        </div>
    </div>
</div>
