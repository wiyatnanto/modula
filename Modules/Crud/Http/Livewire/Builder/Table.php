<?php

namespace Modules\Crud\Http\Livewire\Builder;

use Livewire\Component;
use Modules\Crud\Entities\Crud;

class Table extends Component
{
    public $name;
    public $config;
    public $grids= [];
    protected $listeners = ['refreshTable' => 'refreshTable'];

    public $formats = [
        'date' => ['name' => 'Date', 'placeholder' => 'ex : dd-mm-yy'],
        'image' => ['name' => 'Image', 'placeholder' => 'ex : /uploads/foldername/'],
        'link' => ['name' => 'Link', 'placeholder' => 'ex : http://link.com/{id}'],
        'radio' => ['name' => 'Checkbox/Radio', 'placeholder' => 'ex : value:display,value1,display1'],
        'number' => ['name' => 'number', 'placeholder' => ''],
        'file' => ['name' => 'Files', 'placeholder' => 'ex : /uploads/foldername/'],
        'function' => ['name' => 'Function', 'placeholder' => 'ex : Class:method:{id}-{id2}'],
        'database' => ['name' => 'Lookup / Database', 'placeholder' => 'ex : tb_name:id:display_field'],
        'component' => ['name' => 'Component', 'placeholder' => 'ex : custom.status'],
    ];

    public function refreshTable()
    {
        $this->mount($this->name);
    }

    public function mount($name){
        $driver = config('database.default');
        $database = config('database.connections');
        $this->db = $database[$driver]['database'];

        $crud = Crud::where('name', $name)->first();
        $this->config = \CrudHelpers::CF_decode_json($crud->config, true);

        $this->grids = $this->config['grid'];
    }

    public function render()
    {
        return view('crud::livewire.builder.table');
    }

    public function update()
    {
        $crud = Crud::where('name', $this->name)->first();
        $crud->config = \CrudHelpers::CF_encode_json(array_merge($this->config, ['grid' => $this->grids]));
        $crud->update();
        $this->emit('toast', ['success', 'Table crud has been updated']);
    }
}
