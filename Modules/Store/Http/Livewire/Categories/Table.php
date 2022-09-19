<?php

namespace Modules\Store\Http\Livewire\Categories;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Store\Entities\Category;

class Table extends Component
{
    use WithFileUploads, WithPagination, WithSorting;

    public $search;
    public $filterActive = 0;
    public $view = 'list';

    public $categoryId;
    public $name;
    public $image;

    public $categoriesTrees = [];
    public $updateMode = false;
    public $minimize = false;

    public $listeners = [
        'updateOrderTree' => 'updateOrderTree',
        'delete' => 'delete',
    ];

    protected $queryString = ['view'];

    public function hydrate()
    {
        $this->dispatchBrowserEvent('hydrateEvent');
    }

    public function mount()
    {
        $this->categoriesTrees = collect(Category::with('children')->get());
    }

    public function toggleView($id)
    {
        $category = Category::findOrFail($id);
        $category->status = $category->status ? 0: 1;
        $category->update();
        $this->emit('toast', ['success', 'Category has been updated']);
    }

    public function toggleFilterActive()
    {
        $this->filterActive = $this->filterActive ? 0 : 1;
    }

    public function toggleActive($id)
    {
        $category = Category::findOrFail($id);
        $category->status = $category->status ? 0 : 1;
        $category->update();
    }

    public function updateOrder($list)
    {
        foreach ($list as $key => $val) {
            $category = Category::findOrFail($val['value']);
            $category->order_menu = $val['order'];
            $category->update();
        }
    }

    public function updateOrderTree($datas)
    {
        foreach ($datas as $key => $data) {
            if (isset($data['children'])) {
                foreach ($data['children'] as $key2 => $data2) {
                    if (isset($data2['children'])) {
                        foreach ($data2['children'] as $key3 => $data3) {
                            $category = Category::findOrFail($data3['id']);
                            $category->order_menu = $key3;
                            $category->parent_id = $data2['id'];
                            $category->menu_level = 3;
                            $category->update();
                        }
                    } else {
                        $category = Category::findOrFail($data2['id']);
                        $category->order_menu = $key2;
                        $category->parent_id = $data['id'];
                        $category->menu_level = 2;
                        $category->update();
                    }
                }
            } else {
                $category = Category::findOrFail($data['id']);
                $category->order_menu = $key;
                $category->parent_id = 0;
                $category->menu_level = 1;
                $category->update();
            }
        }
    }

    private function resetInputFields()
    {
        $this->name = null;
        $this->image = null;
    }

    public function store()
    {
        $category = new Category();
        $category->name = $this->name;
        $category->parent_id = 0;
        if (is_object($this->image)) {
            $fileName = $this->image->store(
                'public/files/store/categories',
                'local'
            );
            $category->image = str_replace(
                'public/files/store/categories/',
                '',
                $fileName
            );
        }
        $category->save();
        if ($category) {
            $this->emit('toast', ['success', 'Category has been created']);
            $this->dispatchBrowserEvent('closeModal');
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->image = $category->image;
        $this->updateMode = true;
    }

    public function update()
    {
        $category = Category::find($this->categoryId);
        $category->name = $this->name;
        if (is_object($this->image)) {
            $fileName = $this->image->store(
                'public/files/store/categories',
                'local'
            );
            $category->image = str_replace(
                'public/files/store/categories/',
                '',
                $fileName
            );
        }
        $category->update();
        $this->updateMode = false;
        $this->resetInputFields();
        $this->emit('notify', 'Brand berhasil diperbarui');
    }

    public function delete($id)
    {
        $brand = Category::findOrFail($id);
        $brand->delete();
        $this->emit('notify', 'Kategori ' . $brand->name . ' berhasil dihapus');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function render()
    {
        $categories = Category::with('children')->orderBy('order_menu', 'asc');
        if ($this->filterActive) {
            $categories->where('status', $this->filterActive);
        }
        if ($this->search !== null) {
            $categories->where('name', 'like', '%' . $this->search . '%');
        }

        return view('store::livewire.categories.table', [
            'categories' => $categories->fastPaginate(10)
        ])->extends('theme::backend.layouts.master');
    }
}
