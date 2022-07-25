<?php

namespace Modules\Auth\Http\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;

use Spatie\Permission\Models\Permission;

class Table extends Component
{
    use WithPagination;

    public $permissionId, $name;

    public $sortField ='id';
    public $sortAsc = true;
    public $search = '';

    public $selectAll = false;
    public $selected = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'clear',
        'delete',
        'bulkDelete'
    ];

    protected $messages = [
        'name.required' => 'The Name cannot be empty.',
    ];

    public function mount() {}

    public function clear() {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value) {
        if($value){
            $this->selected = User::where('name','like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->pluck('id');
        }else{
            $this->selected = [];
        }
    }

    public function render()
    {
        return view('auth::livewire.permissions.table', [
            'permissions' => Permission::where('name','like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(10)
        ])
        ->extends('theme::backend.layouts.master');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);
        
        Permission::create(['name' => $this->name]);
        session()->flash('success', 'Permission created successfully.');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function sortBy($field)
    {
        if($this->sortField === $field)
        {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
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
            'name' => 'required'
        ]);
    
        $permission = Permission::find($id);
        $permission->name = $this->name;
        $permission->update();
        session()->flash('success', 'Permission updated successfully.');
        $this->dispatchBrowserEvent('closeModal');
    }
     
    public function delete($id)
    {
        Permission::find($id)->delete();
        session()->flash('success', 'Permission deleted successfully.');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function bulkDelete()
    {
        Permission::whereIn('id', $this->selected)->delete();
        session()->flash('success', 'Permissions deleted successfully.');
        $this->dispatchBrowserEvent('closeModal');
    }
}
