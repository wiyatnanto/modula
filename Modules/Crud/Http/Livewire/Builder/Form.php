<?php

namespace Modules\Crud\Http\Livewire\Builder;

use Livewire\Component;
use Modules\Crud\Entities\Crud;

class Form extends Component
{
    public $name, $db, $keyField;
    public $config;
    public $forms= [];
    public $lookup_value = [];
    public $fieldValueOptions = [];
    public $fieldValues = [];
    public $customFieldValues = [''];
    public $customFieldDisplays = [''];
    public $formats = [
        'hidden' => 'Hidden',
        'text' => 'Text',
        'date' => 'Date',
        'time' => 'Time',
        'year' => 'Year',
        'datetime' => 'Date & Time',
        'textarea' => 'Textarea',
        'editor' => 'Editor ',
        'select' => 'Select',
        'radio' => 'Radio',
        'checkbox' => 'Checkbox',
        'file' => 'Upload File',
        'dropfile' => 'Dropfile'
    ];

    public $tableOptions = [];

    protected $listeners = ['refreshForm' => 'refreshForm'];

    public function mount($name){
        $driver = config('database.default');
        $database = config('database.connections');
        $this->db = $database[$driver]['database'];

        $crud = Crud::where('name', $name)->first();
        $this->config = \CrudHelpers::CF_decode_json($crud->config, true);
        $this->forms = $this->config['forms'];
    }

    public function clear() {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedForms($value, $key)
    {
        if($key === $this->keyField.'.option.lookup_table'){
            $table = $value;
            if ($table != '') {
                $rows = Crud::getTableField($table);
                foreach ($rows as $row) {
                    $items[] = [$row, $row];
                }
                $this->fieldValueOptions = $items;
            }
        }
    }

    public function updatedFieldValues()
    {
        $this->forms[$this->keyField]['option']['lookup_value'] = is_array($this->fieldValues) ? array_values($this->fieldValues) : '';
    }

    public function addCustomFieldValuesDisplays()
    {
        $this->customFieldValues[] = null;
        $this->customFieldDisplays[] = null;
    }

    public function removeCustomFieldValuesDisplays($i)
    {
        unset($this->customFieldValues[$i]);
        unset($this->customFieldDisplays[$i]);
    }

    public function editFormFormat($key)
    {
        $this->keyField = $key;
        $this->tableOptions = Crud::getTableList($this->db);
    }

    public function updateFormat()
    {
        $crud = Crud::where('name', $this->name)->first();
        $crud->config = \CrudHelpers::CF_encode_json(array_merge($this->config, ['forms' => $this->forms]));
        $crud->update();
        $this->emit('toast', ['success', 'Field formats has been updated']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        return view('crud::livewire.builder.form');
    }

    public function refreshForm()
    {
        $this->mount($this->name);
    }

    public function update()
    {
        $crud = Crud::where('name', $this->name)->first();
        $crud->config = \CrudHelpers::CF_encode_json(array_merge($this->config, ['forms' => $this->forms]));
        $crud->update();
        $this->emit('toast', ['success', 'Table forms has been updated']);
    }
}
