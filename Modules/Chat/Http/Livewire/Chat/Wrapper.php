<?php

namespace Modules\Chat\Http\Livewire\Chat;

use Livewire\Component;

class Wrapper extends Component
{
    public function render()
    {
        return view('chat::livewire.chat.wrapper')
        ->extends('theme::backend.layouts.master');
    }
}
