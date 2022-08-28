<?php

namespace Modules\Store\Http\Livewire;

use Livewire\Component;

class UnderConstruction extends Component
{
    public $minimize = false;
    
    public function toggleSidebar(){
        $this->minimize = $this->minimize ? false : true;
        $this->mount();
    }

    public function render()
    {
        return view('store::livewire.under-construction')
        ->extends('core::layouts.default.master')
        ->section('content');
    }
}
