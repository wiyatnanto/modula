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

    public $search = "";

    public $selectAll = false;
    public $selected = [];

    protected $paginationTheme = "bootstrap";

    protected $listeners = ["clear", "delete", "bulkDelete"];

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $categories = Category::where(
                "name",
                "ILIKE",
                "%" . $this->search . "%"
            )
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->fastPaginate(10);
            foreach ($categories as $item) {
                $this->selected[$item->id] = true;
            }
        } else {
            $this->selected = [];
        }
    }

    public function store()
    {
        $this->validate([
            "name" => "required|string|max:191",
        ]);

        $category = new Category();
        $category->name = $this->name;
        $category->save();

        $this->emit("toast", ["success", "Category has been created"]);
        $this->dispatchBrowserEvent("closeModal");
        $this->clear();
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
        $this->emit("toast", ["success", "Category has been updated"]);
        $this->dispatchBrowserEvent("closeModal");
        $this->clear();
    }

    public function delete($id)
    {
        $category = Category::find($id)->first();
        if ($category->delete()) {
            $this->emit("toast", ["success", "Category has been deleted"]);
            $this->dispatchBrowserEvent("closeModal");
            $this->clear();
        }
    }

    public function bulkDelete()
    {
        $selected = \Arr::where($this->selected, function ($value, $key) {
            return $value == true;
        });
        $categories = Category::whereIn("id", array_keys($selected))->get();
        if ($categories) {
            $categories->each->delete();
            $this->emit("toast", ["success", "Category has been deleted"]);
            $this->clear();
        }
    }

    public function render()
    {
        return view("blog::livewire.categories.table", [
            "categories" => Category::where(
                "name",
                "ILIKE",
                "%" . $this->search . "%"
            )
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->fastPaginate(10),
        ])->extends("theme::backend.layouts.master");
    }
}
