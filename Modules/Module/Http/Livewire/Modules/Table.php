<?php

namespace Modules\Module\Http\Livewire\Modules;

use Livewire\Component;
use Livewire\WithPagination;

use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Artisan;

class Table extends Component
{
    use WithPagination;

    public $moduleName, $name;
    public $modules = [];

    public $sortField ='id';
    public $sortAsc = true;
    public $search = '';

    public $selectAll = false;
    public $selected = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'clear',
        'delete',
        'bulkDelete'
    ];
    
    protected $messages = [
        'name.required' => 'The Name cannot be empty.',
    ];

    public function clear() {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value) {
        if($value){
            $this->selected = collect($this->modules)->pluck('lower_name');
        }else{
            $this->selected = [];
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);
        Artisan::call("module:make {$this->name}");
        Artisan::call("cache:clear");
        $this->emit('toast', ['success', 'Module has been created']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($name)
    {
        $module = Module::find($name);
        if($module)
        {
            dd($module);
        }
    }

    public function delete($name)
    {
        $module = Module::find($name);
        if($module)
        {
            Artisan::call("module:delete {$name}");
            Artisan::call("cache:clear");
            $this->emit('toast', ['success', 'Module has been deleted']);
            $this->dispatchBrowserEvent('closeModal');
        }
    }
    
    public function render()
    {
        $this->modules = [];
        foreach(Module::all() as $module)
        {
            $this->modules[] = array(
                'name' => $module->getName(),
                'lower_name' => $module->getLowerName(),
                'studly_name' => $module->getStudlyName(),
                'extra_path' => $module->getExtraPath('Assets'),
                'path' => $module->getPath(),
            );
        }
        return view('module::livewire.modules.table',[
            'modules' => $this->modules
        ])
        ->extends('theme::backend.layouts.master');
    }
}
