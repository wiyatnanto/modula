<x-crud::organisms.modal preventSubmit="updateFormat()" submitLabel="Save" id="updateFormFormat" title="Form Format">
    @if ($keyField !== null)
        {{ json_encode($forms[$keyField]) }}
        <div class="mb-3">
            <label for="grids.type" class="form-label"></label>
            <div><code style="font-size: 16px;background-color:#ffe3e3;">{{ $forms[$keyField]['field'] }}</code></div>
        </div>
        <div class="mb-3" wire:key="type.{{$keyField}}">
            <label for="grids.type" class="form-label">Type {{ $keyField }}</label>
            <x-crud::atoms.select2 name="forms.{{ $keyField }}.type" dropdownParent="updateFormFormat"
                wire:model.defer="forms.{{ $keyField }}.type" defer="false">
                <option></option>
                @foreach ($formats as $key => $format)
                    <option value="{{ $key }}">{{ $format }}</option>
                @endforeach
            </x-crud::atoms.select2>
            @error('forms.type')
                <label id="forms.type-error" class="error invalid-feedback" for="forms.type">{{ $message }}</label>
            @enderror
        </div>

        @if ($forms[$keyField]['type'] === 'select' ||
            $forms[$keyField]['type'] === 'radio' ||
            $forms[$keyField]['type'] === 'checkbox')
            <div class="mb-3">
                <div class="border rounded p-3" style="background-color: #f9fcff;border-color: #cad5ea !important;">
                    <div class="mb-3">
                        <x-crud::atoms.radio type="radio" label="Custom"
                            name="forms.{{ $keyField }}.option.opt_type"
                            wire:model="forms.{{ $keyField }}.option.opt_type" value="datalist" />
                        <x-crud::atoms.radio type="radio" label="Database"
                            name="forms.{{ $keyField }}.option.opt_type"
                            wire:model="forms.{{ $keyField }}.option.opt_type" value="database" />
                        @error('forms.{{ $keyField }}.option.opt_type')
                            <label id="opt_type-error" class="error invalid-feedback"
                                for="opt_type">{{ $message }}</label>
                        @enderror
                    </div>
                    @if ($forms[$keyField]['option']['opt_type'] === 'database')
                        <div class="mb-3" wire:key="lookup_table">
                            <label for="lookup_table" class="form-label">Table</label>
                            <x-crud::atoms.select2 name="forms.{{ $keyField }}.option.lookup_table"
                                dropdownParent="updateFormFormat"
                                wire:model="forms.{{ $keyField }}.option.lookup_table" defer="false">
                                <option></option>
                                @foreach ($tableOptions as $val)
                                    <option value="{{ $val }}">{{ $val }}</option>
                                @endforeach
                            </x-crud::atoms.select2>
                            @error('lookup_table')
                                <label id="lookup_table-error" class="error invalid-feedback"
                                    for="lookup_table">{{ $message }}</label>
                            @enderror
                        </div>
                        @if (count($fieldValueOptions) > 0)
                            {{ json_encode($fieldValueOptions) }} <br>{{ json_encode($fieldValues) }}
                            <div class="mb-3" wire:key="lookup_key">
                                <label for="lookup_key" class="form-label">Primary Key/Relation Key</label>
                                <x-crud::atoms.select2 name="forms.{{ $keyField }}.option.lookup_key"
                                    dropdownParent="updateFormFormat"
                                    wire:model.defer="forms.{{ $keyField }}.option.lookup_key" defer="false">
                                    <option></option>
                                    @foreach ($fieldValueOptions as $val)
                                        <option value="{{ $val[0] }}">{{ $val[1] }}</option>
                                    @endforeach
                                </x-crud::atoms.select2>
                                @error('lookup_key')
                                    <label id="lookup_key-error" class="error invalid-feedback"
                                        for="lookup_key">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mb-3" wire:key="1">
                                <label for="lookup_value" class="form-label">Display 1</label>
                                <x-crud::atoms.select2 name="fieldValues.{{ 1 }}"
                                    dropdownParent="updateFormFormat"
                                    wire:model.defer="fieldValues.{{ 1 }}" defer="false">
                                    <option></option>
                                    @foreach ($fieldValueOptions as $val)
                                        <option value="{{ $val[0] }}">{{ $val[1] }}</option>
                                    @endforeach
                                </x-crud::atoms.select2>
                                @error('lookup_value')
                                    <label id="lookup_value-error" class="error invalid-feedback"
                                        for="lookup_value">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mb-3" wire:key="2">
                                <label for="lookup_value" class="form-label">Display 2</label>
                                <x-crud::atoms.select2 name="fieldValues.{{ 2 }}"
                                    dropdownParent="updateFormFormat"
                                    wire:model.defer="fieldValues.{{ 2 }}" defer="false">
                                    <option></option>
                                    @foreach ($fieldValueOptions as $val)
                                        <option value="{{ $val[0] }}">{{ $val[1] }}</option>
                                    @endforeach
                                </x-crud::atoms.select2>
                                @error('lookup_value')
                                    <label id="lookup_value-error" class="error invalid-feedback"
                                        for="lookup_value">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mb-3" wire:key="3">
                                <label for="lookup_value" class="form-label">Display 3</label>
                                <x-crud::atoms.select2 name="fieldValues.{{ 3 }}"
                                    dropdownParent="updateFormFormat"
                                    wire:model.defer="fieldValues.{{ 3 }}" defer="false">
                                    <option></option>
                                    @foreach ($fieldValueOptions as $val)
                                        <option value="{{ $val[0] }}">{{ $val[1] }}</option>
                                    @endforeach
                                </x-crud::atoms.select2>
                                @error('lookup_value')
                                    <label id="lookup_value-error" class="error invalid-feedback"
                                        for="lookup_value">{{ $message }}</label>
                                @enderror
                            </div>
                        @endif
                    @elseif($forms[$keyField]['option']['opt_type'] === 'datalist')
                        @foreach ($customFieldValues as $key => $customFieldValue)
                            <div class="mb-3" wire:key="{{ $key }}">
                                {{ json_encode($customFieldValues) }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <x-crud::atoms.input type="text" placeholder="Option Value"
                                            name="customFieldValues.{{ $key }}"
                                            wire:model="customFieldValues.{{ $key }}" />
                                    </div>
                                    <div class="col-md-4">
                                        <x-crud::atoms.input type="text" placeholder="Option Display"
                                            name="customFieldDisplays.{{ $key }}"
                                            wire:model="customFieldDisplays.{{ $key }}" />
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary btn-icon"
                                            wire:click="addCustomFieldValuesDisplays({{ $key }})">
                                            <i class="mdi mdi-plus"></i>
                                        </button>
                                        @if ($key !== 0)
                                            <button type="button" class="btn btn-danger btn-icon"
                                                wire:click="removeCustomFieldValuesDisplays({{ $key }})">
                                                <i class="mdi mdi-minus"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
        <div class="mb-3">
            <label for="tooltip" class="form-label">Tooltip</label>
            <x-crud::atoms.input type="text" placeholder="Tooltip"
                name="forms.{{ $keyField }}.option.tooltip"
                wire:model="forms.{{ $keyField }}.option.tooltip" />
            @error('tooltip')
                <label id="tooltip-error" class="error invalid-feedback" for="tooltip">{{ $message }}</label>
            @enderror
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="prefix" class="form-label">Prefix</label>
                <x-crud::atoms.input type="text" placeholder="Prefix"
                    name="forms.{{ $keyField }}.option.prefix"
                    wire:model="forms.{{ $keyField }}.option.prefix" />
                @error('prefix')
                    <label id="prefix-error" class="error invalid-feedback" for="prefix">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="surfix" class="form-label">Surfix</label>
                <x-crud::atoms.input type="text" placeholder="Surfix"
                    name="forms.{{ $keyField }}.option.surfix"
                    wire:model="forms.{{ $keyField }}.option.surfix" />
                @error('surfix')
                    <label id="surfix-error" class="error invalid-feedback" for="surfix">{{ $message }}</label>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="attribute" class="form-label">Html Attributes</label>
            <x-crud::atoms.textarea type="textarea" placeholder="Attributes"
                name="forms.{{ $keyField }}.option.attribute"
                wire:model="forms.{{ $keyField }}.option.attribute" />
            @error('attribute')
                <label id="attribute-error" class="error invalid-feedback" for="attribute">{{ $message }}</label>
            @enderror
        </div>
    @endif
</x-crud::organisms.modal>
