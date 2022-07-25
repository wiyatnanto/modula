<?php

namespace Modules\Crud\Http\Livewire\Builder;

use Livewire\Component;

class Config extends Component
{
    public $name;
    public function mount($name){
        $this->name = $name;
    }
    
    public function render()
    {
        return view('crud::livewire.builder.config')
        ->extends('theme::backend.layouts.master');
    }
}
