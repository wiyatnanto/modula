<?php

namespace Modules\Crud\Http\Livewire\Builder;

use Livewire\Component;
use Modules\Crud\Entities\Crud;
use Spatie\Permission\Models\Permission as PermissionAccess;
use Spatie\Permission\Models\Role;

class Permission extends Component
{
    public $name, $db;
    public $roles, $permissions = [];
    public $rolesOptions = [];
    public $filters = [];
    public $permissionKeys = ['view','create','update','delete','export','import'];

    public function mount()
    {
        foreach($this->permissionKeys as $key){
            $this->filters[] = $this->name.'.'.$key;
        }
        $this->getRoles = Role::whereHas('permissions', function($permissions){
            $permissions->whereIn('name', $this->filters);
        })->get();

        foreach ($this->getRoles as $role)
        {
            $permissions = [];
            foreach($this->permissionKeys as $key){
                $permissions[$key] = in_array($this->name . '.' . $key, $role->permissions->pluck('name')->toArray()) ? true : false;
            }
            $this->permissions[$role->name] = $permissions;
            $this->roles[] = $role->name;
        }
        $this->rolesOptions = Role::pluck('name','name')->all();
    }

    public function update()
    {
        foreach($this->permissions as $key => $permission)
        {
            if(in_array($key, $this->roles)){
                $this->permissions[$key] = $permission;
            }else{
                $this->permissions[$key] = collect($permission)->map(function ($value, $key){
                    return false;
                });
            }
        }
        foreach($this->permissions as $role => $permissions){
            $getRole = Role::where('name', $role)->first();
            $checked =[];
            foreach($permissions as $key => $is_checked)
            {
                if($is_checked){
                    $getRole->givePermissionTo(['name' => $this->name.'.'.$key]);
                }else{
                    $getRole->revokePermissionTo(['name' => $this->name.'.'.$key]);
                }
            }
        }
        $this->emit('toast', ['success', 'Permissions has been updated']);
    }

    public function removePermissions()
    {
        foreach($this->permissionKeys as $key){
            $this->filters[] = $this->name.'.'.$key;
        }
    }

    public function render()
    {
        return view('crud::livewire.builder.permission');
    }
}
