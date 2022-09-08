<?php

namespace Modules\Survey\Http\Livewire\Surveys;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Modules\Survey\Entities\Survey;

class Table extends Component
{
    use WithPagination, WithFileUploads;

    public $surveyId, $name, $bg_header, $bg_header_load;

    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';

    public $selectAll = false;
    public $selected = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['clear', 'delete', 'bulkDelete'];

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = User::where(
                'name',
                'ILIKE',
                '%' . $this->search . '%'
            )
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->pluck('id');
        } else {
            $this->selected = [];
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $survey = new Survey;
        $survey->name = $this->name;
        if (gettype($this->bg_header) === 'object') {
            $this->bg_header->store('public/survey/bg_headers');
            $survey->bg_header = 'survey/bg_headers/' . $this->bg_header->hashName();
        }else{
            $survey->bg_header = $this->bg_header;
        }
        $survey->json = [];
        $survey->save();
        $this->emit('toast', ['success', 'Survey has been created']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id)
    {
        $survey = Survey::find($id);
        $this->surveyId = $id;
        $this->name = $survey->name;
        $this->bg_header = $survey->bg_header;
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required',
        ]);
        $survey = Survey::find($id);
        $survey->name = $this->name;
        if (gettype($this->bg_header) === 'object') {
            $this->bg_header->store('public/survey/bg_headers');
            $survey->bg_header =
                'survey/bg_headers/' . $this->bg_header->hashName();
        }else{
            $survey->bg_header = $this->bg_header;
        }
        $survey->update();

        $this->emit('toast', ['success', 'Survey has been updated']);
        $this->emitTo('survey::survey', 'refreshComponent');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function delete($id)
    {
        Survey::find($id)->delete();
        $this->emit('toast', ['success', 'Survey has been deleted']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function bulkDelete()
    {
        Survey::whereIn('id', $this->selected)->delete();
        $this->emit('toast', ['success', 'Survey has been deleted']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        return view('survey::livewire.surveys.table', [
            'surveys' => Survey::where('name','ILIKE', '%' . $this->search . '%')->withCount('results')->orderBy('created_at','desc')->fastPaginate(10),
        ])->extends('theme::backend.layouts.master');
    }
}
