<?php

namespace Modules\Blog\Http\Livewire\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Blog\Entities\Category;

class Table extends Component
{
    use WithPagination, WithSorting;

    public $categoryId, $name;

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

        $category = new Category();
        $category->name = $this->name;
        $category->save();

        $this->emit('toast', ['success', 'Category has been created']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $this->categoryId = $id;
        $this->name = $category->name;
    }

    public function update()
    {
        $category = Category::find($this->categoryId);
        $category->name = $this->name;
        $category->update();
        $this->emit('toast', ['success', 'Category has been updated']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        return view('blog::livewire.categories.table',[
            'categories' => Category::where('name','ILIKE','%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->fastPaginate(10)
        ])->extends('theme::backend.layouts.master');
    }
}
