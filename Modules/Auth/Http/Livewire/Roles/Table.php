<?php

namespace Modules\Auth\Http\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class Table extends Component
{
    use WithPagination, WithSorting;

    public $roleId, $name;
    public $permissions = [];
    public $permissionsOptions = [];

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

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);
        
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->permissions);

        $this->emit('toast', ['success', 'Role has been created']);

        $this->dispatchBrowserEvent('closeModal');
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
        $this->emit('toast', ['success', 'Role has been updated']);
        $this->dispatchBrowserEvent('closeModal');
    }
     
    public function delete($id)
    {
        Role::find($id)->delete();
        $this->emit('toast', ['success', 'Role has been deleted']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function bulkDelete()
    {
        Role::whereIn('id', $this->selected)->delete();
        $this->emit('toast', ['success', 'Roles has been deleted']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        return view('auth::livewire.roles.table', [
            'roles' => Role::where('name','ILIKE', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(10)
        ])
        ->extends('theme::backend.layouts.master');
    }
}
