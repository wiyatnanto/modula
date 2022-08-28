<?php

namespace Modules\Survey\Http\Livewire\Editor;

use Livewire\Component;
use Modules\Survey\Entities\Survey;

class Json extends Component
{
    public $slug;
    public $config = [];

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public function mount(){
        $survey = Survey::where('slug', $this->slug)->firstOrFail();
        $this->config = $survey->json;
    }

    public function update()
    {
        $survey = Survey::where('slug', $this->slug)->firstOrFail();
        $survey->json = $this->config;
        $survey->update();
        $this->emit('toast', ['success', 'Survey has been updated']);
    }

    public function render()
    {
        return view('survey::livewire.editor.json');
    }
}
