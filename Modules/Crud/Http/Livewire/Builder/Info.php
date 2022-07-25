<?php

namespace Modules\Crud\Http\Livewire\Builder;

use Livewire\Component;
use Modules\Crud\Entities\Crud;

class Info extends Component
{
    public $title, $name, $note, $desc, $db, $db_key, $author, $type, $lang;
    public $config, $setting;

    public function mount($name){
        $crud = Crud::where('name', $name)->first();
        $this->title = $crud->title;
        $this->name = $crud->name;
        $this->note = $crud->note;
        $this->desc = $crud->desc;
        $this->db = $crud->db;
        $this->db_key = $crud->db_key;
        $this->author = $crud->author;
        $this->type = $crud->type;
        $this->config = \CrudHelpers::CF_decode_json($crud->config,true); 
        $this->setting = [
                'gridtype'        => (isset($this->config['setting']) ? $this->config['setting']['gridtype'] : 'native'  ),
                'orderby'        => (isset($this->config['setting']) ? $this->config['setting']['orderby'] : $this->db_key  ),
                'ordertype'        => (isset($this->config['setting']) ? $this->config['setting']['ordertype'] : 'asc'  ),
                'perpage'        => (isset($this->config['setting']) ? $this->config['setting']['perpage'] : '10'  ),
                'frozen'        => (isset($this->config['setting']['frozen'])  ? $this->config['setting']['frozen'] : 'false'  ),
                'form-method'        => (isset($this->config['setting']['form-method'])  ? $this->config['setting']['form-method'] : 'native'  ),
                'view-method'        => (isset($this->config['setting']['view-method'])  ? $this->config['setting']['view-method'] : 'native'  ),
                'inline'        => (isset($this->config['setting']['inline'])  ? $this->config['setting']['inline'] : 'false'  )
        ];
    }

    public function render()
    {
        return view('crud::livewire.builder.info',[
            'orderbyOptions' => $this->config['grid']
        ])
        ->extends('theme::backend.layouts.master');
    }

    public function update()
    {
        $setting = [
            'gridtype'        => '' ,
            'orderby'        => $this->setting['orderby'],
            'ordertype'        => $this->setting['ordertype'],
            'perpage'        => $this->setting['perpage'],
            'frozen'        => (!is_null($this->setting['frozen'])  ? 'true' : 'false' ) ,
            'form-method'   => (!is_null($this->setting['form-method'])  ? $this->setting['form-method'] : 'native' ) ,
            'view-method'        => (!is_null($this->setting['view-method'])  ? $this->setting['view-method'] : 'native' ) ,
            'inline'        => (!is_null($this->setting['inline'])  ? 'true' : 'false' ) ,
        ];
        if(isset($this->config['setting'])){
            unset($this->config['setting']);
        }

        $crud = Crud::where('name', $this->name)->first();
        $crud->title = $this->title;
        $crud->note = $this->note;
        $crud->desc = $this->desc;
        $crud->author = $this->author;
        $crud->type = $this->type;
        $crud->config = \CrudHelpers::CF_encode_json(array_merge($this->config,["setting" => $setting]));
        $crud->update();
        $this->emit('toast', ['success', 'Crud has been updated']);
    }
}
