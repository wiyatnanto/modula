<?php

namespace Modules\Theme\Http\Livewire\Sliders;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Theme\Entities\Slider;
use Modules\Theme\Entities\SliderItem;

class Table extends Component
{
    use WithFileUploads, WithPagination, WithSorting;

    public $slideItemId;
    public $title;
    public $sub_title;
    public $note;
    public $image;
    public $url;
    public $button_text;
    public $sort_order;
    public $search;

    public $selectAll = false;
    public $selected = [];

    public $updateMode = false;
    public $minimize = false;

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
            $this->selected = SliderItem::with("slider")
                ->orderBy("sort_order", "asc")
                ->fastPaginate(10)
                ->pluck("id");
        } else {
            $this->selected = [];
        }
    }

    public function toggleActive($id)
    {
        $sliderItem = SliderItem::findOrFail($id);
        $sliderItem->status = $sliderItem->status ? 0 : 1;
        $sliderItem->update();
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
            "url" => "",
        ]);
        if ($validatedData) {
            $sliderItem = new SliderItem();
            $sliderItem->slider_id = 1;
            $sliderItem->title = $this->title;
            $sliderItem->sub_title = $this->sub_title;
            $sliderItem->note = $this->note;
            $sliderItem->url = $this->url;
            $sliderItem->button_text = $this->button_text;
            if (is_object($this->image)) {
                $fileName = $this->image->store(
                    "public/theme/sliders",
                    "local"
                );
                $sliderItem->image = str_replace("public/", "", $fileName);
            }

            $sliderItem->save();
            if ($sliderItem) {
                $this->emit("toast", ["success", "Slide has been created"]);
                $this->dispatchBrowserEvent("closeModal");
                $this->clear();
            }
        }
    }

    public function edit($id)
    {
        $sliderItem = SliderItem::findOrFail($id);
        $this->slideItemId = $sliderItem->id;
        $this->title = $sliderItem->title;
        $this->sub_title = $sliderItem->sub_title;
        $this->note = $sliderItem->note;
        $this->image = $sliderItem->image;
        $this->url = $sliderItem->url;
        $this->button_text = $sliderItem->button_text;
    }

    public function update()
    {
        $sliderItem = SliderItem::find($this->slideItemId);
        $sliderItem->title = $this->title;
        $sliderItem->sub_title = $this->sub_title;
        $sliderItem->note = $this->note;
        $sliderItem->image = $this->image;
        $sliderItem->url = $this->url;
        $sliderItem->button_text = $this->button_text;
        if (is_object($this->image)) {
            $fileName = $this->image->store("public/theme/sliders", "local");
            $sliderItem->image = str_replace("public/", "", $fileName);
        }
        if ($sliderItem->update()) {
            $this->updateMode = false;
            $this->emit("toast", ["success", "Slide has been updated"]);
            $this->dispatchBrowserEvent("closeModal");
            $this->clear();
        }
    }

    public function delete($id)
    {
        $sliderItem = SliderItem::findOrFail($id);
        if ($sliderItem->delete()) {
            $this->emit("toast", ["success", "Slide has been deleted"]);
            $this->dispatchBrowserEvent("closeModal");
            $this->clear();
        }
    }

    public function bulkDelete()
    {
        SliderItem::whereIn("id", $this->selected)->delete();
        $this->emit("toast", ["success", "Slider has been deleted"]);
        $this->dispatchBrowserEvent("closeModal");
        $this->clear();
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->clear();
    }

    public function render()
    {
        return view("theme::livewire.sliders.table", [
            "sliderItems" => SliderItem::with("slider")
                ->orderBy("sort_order", "asc")
                ->fastPaginate(10),
        ])->extends("theme::backend.layouts.master");
    }
}
