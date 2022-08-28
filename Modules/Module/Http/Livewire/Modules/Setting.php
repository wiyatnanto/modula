<?php

namespace Modules\Module\Http\Livewire\Modules;

use Livewire\Component;

class Setting extends Component
{
    public $name;
    
    public function mount($name)
    {
        dd($name);
    }

    public function render()
    {
        return view('module::livewire.modules.setting')
        ->extends('theme::backend.layouts.master');
    }
}
