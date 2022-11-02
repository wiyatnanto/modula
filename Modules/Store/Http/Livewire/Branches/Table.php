<?php

namespace Modules\Store\Http\Livewire\Branches;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Store\Entities\Branch;
use Modules\Store\Entities\BranchImage;

class Table extends Component
{
    use WithFileUploads, WithPagination, WithSorting;

    public $search;
    public $branchId;
    public $name;
    public $image;
    public $address;
    public $coordinate = ["lat" => null, "lng" => null];

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

    // public function hydrate()
    // {
    //     $this->dispatchBrowserEvent("hydrateEvent");
    // }

    // public function toggleFilterActive()
    // {
    //     $this->filterActive = $this->filterActive ? 0 : 1;
    // }

    public function toggleActive($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->status = $branch->status ? 0 : 1;
        $branch->update();
    }

    private function resetInputFields()
    {
        $this->name = null;
        $this->image = null;
    }

    public function store()
    {
        $this->resetValidation();
        $validatedData = $this->validate([
            "name" => "required",
            "address" => "required",
            "coordinate.lat" => "required",
            "coordinate.lng" => "required",
            "image" => "required",
        ]);
        if ($validatedData) {
            $branch = new Branch();
            $branch->name = $this->name;
            $branch->address = $this->address;
            $branch->coordinate = json_encode($this->coordinate);

            if (is_object($this->image)) {
                $imageName = $this->image->hashName();
                $this->image->store("public/store/branches", "local");
                $images[] = new BranchImage([
                    "branch_id" => $branch->id,
                    "image" => "store/branches/" . $imageName,
                    "main_image" => 1,
                    "order_image" => 0,
                ]);
            }
            $branch->save();
            $branch->images()->saveMany($images);

            if ($branch) {
                $this->emit("toast", ["success", "Branch has been created"]);
                $this->dispatchBrowserEvent("closeModal");
                $this->clear();
            }
        }
    }

    public function edit($id)
    {
        $branch = Branch::find($id);
        $this->branchId = $branch->id;
        $this->name = $branch->name;
        $this->address = $branch->address;
        $this->coordinate = json_decode($branch->coordinate, true);
        $this->image = $branch->images[0]->image;
        $this->updateMode = true;
    }

    public function update()
    {
        $branch = Branch::find($this->branchId);
        $branch->name = $this->name;
        $branch->address = $this->address;
        $branch->coordinate = $this->coordinate;
        if (is_object($this->image)) {
            $imageName = $this->image->hashName();
            $this->image->store("public/store/branches", "local");
            $images[] = new BranchImage([
                "branch_id" => $branch->id,
                "image" => "store/branches/" . $imageName,
                "main_image" => 1,
                "order_image" => 0,
            ]);
            $branch->images()->delete();
            $branch->images()->saveMany($images);
        }
        if ($branch->update()) {
            $this->updateMode = false;
            $this->resetInputFields();
            $this->emit("toast", ["success", "Branch has been updated"]);
            $this->dispatchBrowserEvent("closeModal");
            $this->clear();
        }
    }

    public function delete($id)
    {
        $branch = Branch::findOrFail($id);
        if ($branch->delete()) {
            $this->emit("toast", ["success", "Branch has been deleted"]);
            $this->dispatchBrowserEvent("closeModal");
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function render()
    {
        $branches = Branch::with("images");

        if ($this->search !== null) {
            // $branches->where('name', 'like', '%' . $this->search . '%');
            $branches->where("name", "ILIKE", "%" . $this->search . "%");
        }
        return view("store::livewire.branches.table", [
            "branches" => $branches
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->fastPaginate(10),
        ])->extends("theme::backend.layouts.master");
    }
}
