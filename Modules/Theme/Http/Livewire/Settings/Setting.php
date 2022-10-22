<?php

namespace Modules\Theme\Http\Livewire\Settings;

use Livewire\Component;

class Setting extends Component
{
    public function render()
    {
        return view("theme::livewire.settings.setting")->extends(
            "theme::backend.layouts.master"
        );
    }
}
