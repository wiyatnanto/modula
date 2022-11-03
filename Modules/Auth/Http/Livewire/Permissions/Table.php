<?php

namespace Modules\Auth\Http\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Spatie\Permission\Models\Permission;

class Table extends Component
{
    use WithPagination, WithSorting;

    public $permissionId, $name;
    public $search = "";
    public $selectAll = false;
    public $selected = [];

    protected $paginationTheme = "bootstrap";
    protected $listeners = ["clear", "delete", "bulkDelete"];
    protected $messages = [
        "name.required" => "The Name cannot be empty.",
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
            $this->selected = User::where(
                "name",
                "LIKE",
                "%" . $this->search . "%"
            )
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->pluck("id");
        } else {
            $this->selected = [];
        }
    }

    public function store()
    {
        $this->validate([
            "name" => "required",
        ]);
        Permission::create(["name" => $this->name]);
        $this->emit("toast", ["success", "Permission has been created"]);
        $this->dispatchBrowserEvent("closeModal");
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $this->permissionId = $id;
        $this->name = $permission->name;
    }

    public function update($id)
    {
        $this->validate([
            "name" => "required",
        ]);
        $permission = Permission::find($id);
        $permission->name = $this->name;
        $permission->update();
        $this->emit("toast", ["success", "Permission has been updated"]);
        $this->dispatchBrowserEvent("closeModal");
    }

    public function delete($id)
    {
        Permission::find($id)->delete();
        $this->emit("toast", ["success", "Permission has been deleted"]);
        $this->dispatchBrowserEvent("closeModal");
    }

    public function bulkDelete()
    {
        Permission::whereIn("id", $this->selected)->delete();
        $this->emit("toast", ["success", "Permissions has been deleted"]);
        $this->dispatchBrowserEvent("closeModal");
    }

    public function render()
    {
        return view("auth::livewire.permissions.table", [
            "permissions" => Permission::where(
                "name",
                "LIKE",
                "%" . $this->search . "%"
            )
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->fastPaginate(10),
        ])->extends("theme::backend.layouts.master");
    }
}
