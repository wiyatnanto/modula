<?php

namespace Modules\Blog\Http\Livewire\Tags;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Blog\Entities\Tag;

class Table extends Component
{
    use WithPagination, WithSorting;

    public $tagId, $name;

    public $search = '';

    public $selectAll = false;
    public $selected = [];


    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'clear',
        'delete',
        'bulkDelete'
    ];

    public function clear() {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {   
        $this->validate([
            'name'=>'required|string|max:191'
        ]);

        $tag = new Tag();
        $tag->name = $this->name;
        $tag->save();

        $this->emit('toast', ['success', 'Category has been created']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        $this->tagId = $id;
        $this->name = $tag->name;
    }

    public function update()
    {
        $tag = Tag::find($this->tagId);
        $tag->name = $this->name;
        $tag->update();
        $this->emit('toast', ['success', 'Category has been updated']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        return view('blog::livewire.tags.table',[
            'tags' => Tag::where('name','ILIKE','%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->fastPaginate(10)
        ])->extends('theme::backend.layouts.master');
    }
}
