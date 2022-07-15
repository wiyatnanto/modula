<?php

namespace Modules\Crud\Http\Livewire\Atom;

use Livewire\Component;

class Select extends Component
{
    public $model;
    public $options = [];

    public function render()
    {
        return view('crud::livewire.atom.select');
    }
}
