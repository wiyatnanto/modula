<?php

namespace Modules\Blog\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Blog\Entities\Page;

class Table extends Component
{
    use WithPagination, WithSorting;

    public $pageId, $title, $content, $slug, $status, $user_id;

    public $search = '';

    public $selectAll = false;
    public $selected = [];

    public $model;

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
            'title'=>'required|string|max:191',
            'content'=>'required'
        ]);

        $post = new Page();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->status = $this->status || 'Draft';
        $post->user_id = \Auth::user()->id;
        $post->save();

        $this->emit('toast', ['success', 'Page has been created']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id)
    {
        $page = Page::find($id);
        $this->pageId = $id;
        $this->title = $page->title;
        $this->content = $page->content;
        $this->status = $page->status;
    }

    public function update()
    {
        $page = Page::find($this->pageId);
        $page->title = $this->title;
        $page->content = $this->content;
        $page->update();
        $this->emit('toast', ['success', 'Page has been updated']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        return view('blog::livewire.pages.table',[
            'pages' => Page::where('title','ILIKE','%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->fastPaginate(10)
        ])->extends('theme::backend.layouts.master');
    }
}
