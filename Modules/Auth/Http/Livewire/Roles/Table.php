<?php

namespace Modules\Auth\Http\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class Table extends Component
{
    use WithPagination;

    public $roleId, $name;
    public $permissions = [];
    public $permissionsOptions = [];

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
        'permissions.required' => 'The Permissions cannot be empty.',
    ];

    public function mount() {
        $this->permissionsOptions = Permission::get()->pluck('name','id');
    }

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
        return view('auth::livewire.roles.table', [
            'roles' => Role::where('name','like', '%' . $this->search . '%')
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
        
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->permissions);

        session()->flash('success', 'Role created successfully.');
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
        $role = Role::find($id);
        $this->roleId = $id;
        $this->name = $role->name;
        $this->permissions = array_values(DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all());
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required'
        ]);
    
        $role = Role::find($id);
        $role->name = $this->name;
        $role->update();
        $role->syncPermissions($this->permissions);
        session()->flash('success', 'Role updated successfully.');
        $this->dispatchBrowserEvent('closeModal');
    }
     
    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('success', 'Role deleted successfully.');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function bulkDelete()
    {
        Role::whereIn('id', $this->selected)->delete();
        session()->flash('success', 'Roles deleted successfully.');
        $this->dispatchBrowserEvent('closeModal');
    }
}
