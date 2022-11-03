<?php

namespace Modules\Store\Http\Livewire\PromoBanners;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Store\Entities\PromoBanner;

class Table extends Component
{
    use WithFileUploads, WithPagination, WithSorting;

    public $search;
    public $filterActive = 1;

    public $promobannerId;
    public $title;
    public $sub_title;
    public $note;
    public $image;
    public $url;
    public $button_text;
    public $discount_text;
    public $sort_order;
    public $layout = 0;

    public $updateMode = false;
    public $minimize = false;

    public $listeners = [
        "delete" => "delete",
    ];

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = PromoBanner::with("slider")
                ->orderBy("sort_order", "asc")
                ->fastPaginate(10)
                ->pluck("id");
        } else {
            $this->selected = [];
        }
    }

    public function toggleActive($id)
    {
        $promobanner = PromoBanner::findOrFail($id);
        $promobanner->status = $promobanner->status ? 0 : 1;
        $promobanner->update();
    }

    public function store()
    {
        $this->resetValidation();
        $validatedData = $this->validate([
            "title" => "required",
            "sub_title" => "required",
            "note" => "",
            "image" => "required",
            "button_text" => "",
            "discount_text" => "",
            "url" => "",
        ]);
        if ($validatedData) {
            $promobanner = new PromoBanner();
            $promobanner->title = $this->title;
            $promobanner->sub_title = $this->sub_title;
            $promobanner->note = $this->note;
            $promobanner->url = $this->url;
            $promobanner->button_text = $this->button_text;
            $promobanner->discount_text = $this->discount_text;
            if (is_object($this->image)) {
                $imageName = $this->image->hashName();
                $this->image->store("public/store/promobanners", "local");
                $promobanner->image = "store/promobanners/" . $imageName;
            }

            $promobanner->save();
            if ($promobanner) {
                $this->emit("toast", ["success", "Product has been created"]);
                $this->dispatchBrowserEvent("closeModal");
            }
        }
    }

    public function edit($id)
    {
        $this->clear();
        $promobanner = PromoBanner::find($id);
        $this->promobannerId = $promobanner->id;
        $this->title = $promobanner->title;
        $this->sub_title = $promobanner->sub_title;
        $this->note = $promobanner->note;
        $this->image = $promobanner->image;
        $this->url = $promobanner->url;
        $this->button_text = $promobanner->button_text;
        $this->discount_text = $promobanner->discount_text;
    }

    public function update()
    {
        $promobanner = PromoBanner::find($this->promobannerId);
        $promobanner->title = $this->title;
        $promobanner->sub_title = $this->sub_title;
        $promobanner->note = $this->note;
        $promobanner->url = $this->url;
        $promobanner->button_text = $this->button_text;
        $promobanner->discount_text = $this->discount_text;
        if (is_object($this->image)) {
            $imageName = $this->image->hashName();
            $this->image->store("public/store/promobanners", "local");
            $promobanner->image = "store/promobanners/" . $imageName;
        }
        if ($promobanner->update()) {
            $this->updateMode = false;
            $this->emit("toast", ["success", "Brand has been updated"]);
            $this->dispatchBrowserEvent("closeModal");
            $this->clear();
        }
    }

    public function delete($id)
    {
        $promobanner = PromoBanner::findOrFail($id);
        if ($promobanner->delete()) {
            $this->emit("toast", ["success", "Brand has been deleted"]);
            $this->dispatchBrowserEvent("closeModal");
            $this->clear();
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function render()
    {
        $promobanners = PromoBanner::where("status", $this->filterActive);
        if ($this->search !== null) {
            $promobanners->where("name", "LIKE", "%" . $this->search . "%");
        }
        return view("store::livewire.promobanners.table", [
            "promobanners" => $promobanners
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->fastPaginate(10),
        ])->extends("theme::backend.layouts.master");
    }
}
