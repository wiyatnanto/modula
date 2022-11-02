<?php

namespace Modules\Core\Http\Livewire\Setting;

use Livewire\Component;
use Modules\Core\Entities\Setting;

class Config extends Component
{
    public function render()
    {
        return view("core::livewire.setting.config", [
            "settings" => Setting::get(),
        ])->extends("theme::backend.layouts.master");
    }
}
