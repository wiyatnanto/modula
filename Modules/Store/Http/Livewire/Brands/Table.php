<?php

namespace Modules\Store\Http\Livewire\Brands;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Store\Entities\Brand;

class Table extends Component
{
    use WithFileUploads, WithPagination, WithSorting;

    protected $paginationTheme = "bootstrap";

    public $search;

    public $brandId;
    public $name;
    public $image;

    public $updateMode = false;
    public $minimize = false;

    public $listeners = ["clear", "delete"];
    public $currentUrl;

    protected $queryString = ["page"];

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function toggleActive($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->status = $brand->status ? 0 : 1;
        $brand->update();
        $this->emit("toast", [
            "success",
            __("crud::messages.message_updated", [
                "item" => __("store::messages.brand"),
            ]),
        ]);
    }

    public function store()
    {
        $this->resetValidation();
        $validatedData = $this->validate([
            "name" => "required",
            "image" => "required",
        ]);
        if ($validatedData) {
            $brand = new brand();
            $brand->name = $this->name;
            if (is_object($this->image)) {
                $imageName = $this->image->hashName();
                $this->image->store("public/store/brands", "local");
                $brand->image = "store/brands/" . $imageName;
            }
            if ($brand->save()) {
                $this->dispatchBrowserEvent("closeModal");
                $this->clear();
                $this->emit("toast", [
                    "success",
                    __("crud::messages.message_created", [
                        "item" => __("store::messages.brand"),
                    ]),
                ]);
            }
        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        $this->brandId = $brand->id;
        $this->name = $brand->name;
        $this->image = $brand->image;
        $this->updateMode = true;
    }

    public function update()
    {
        $brand = Brand::find($this->brandId);
        $brand->name = $this->name;
        if (is_object($this->image)) {
            $imageName = $this->image->hashName();
            $this->image->store("public/store/brands", "local");
            $brand->image = "store/brands/" . $imageName;
        }
        if ($brand->update()) {
            $this->dispatchBrowserEvent("closeModal");
            $this->clear();
            $this->emit("toast", [
                "success",
                __("crud::messages.message_updated", [
                    "item" => __("store::messages.brand"),
                ]),
            ]);
        }
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->delete()) {
            $this->dispatchBrowserEvent("closeModal");
            $this->clear();
            $this->emit("toast", [
                "success",
                __("crud::messages.message_deleted", [
                    "item" => __("store::messages.brand"),
                ]),
            ]);
        }
    }

    public function render()
    {
        $brands = Brand::withCount("products");
        if ($this->search !== null) {
            $brands->where("name", "ILIKE", "%" . $this->search . "%");
        }
        return view("store::livewire.brands.table", [
            "brands" => $brands
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->fastPaginate(10),
        ])->extends("theme::backend.layouts.master");
    }
}
