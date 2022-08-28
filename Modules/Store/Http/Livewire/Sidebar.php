<?php

namespace Modules\Store\Http\Livewire;

use Livewire\Component;
use Cookie;

class Sidebar extends Component
{
    public $minimize;

    public $listeners = [
        'toggleSidebar' => 'toggleSidebar'
    ];

    public function mount()
    {
        $this->minimize = Cookie::get('minimize');
    }

    public function toggleSidebar(){
        $minimize = Cookie::get('minimize');
        Cookie::make('minimize', $minimize ? false : true);
        $this->minimize = $minimize ? false : true;
    }

    public function render()
    {
        return view('store::livewire.sidebar');
    }
}
