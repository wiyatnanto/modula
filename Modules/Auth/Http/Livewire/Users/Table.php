<?php

namespace Modules\Auth\Http\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;

class Table extends Component
{
    use WithPagination, WithSorting;

    public $userId, $userRole, $name, $email, $password, $password_confirmation;
    public $roles = [];
    public $rolesOptions = [];

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
        'email.required' => 'The Email Address cannot be empty.',
        'password.required' => 'The Password cannot be empty.',
        'password_confirmation.required' => 'The Confirm Password cannot be empty.',
        'roles.required' => 'The Role cannot be empty.',
    ];

    public function mount() {
        $this->rolesOptions = Role::pluck('name','name')->all();
    }

    public function clear() {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value) {
        if($value){
            $this->selected = User::where('name','ILIKE', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->pluck('id');
        }else{
            $this->selected = [];
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:auth_users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'roles' => 'required'
        ]);
        
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'avatar' => 'noimage.webp'
        ]);
        $user->assignRole($this->roles);
        $this->emit('toast', ['success', 'User has been created']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->rolesOptions = Role::pluck('name','name')->all();
        $this->roles = $user->roles->pluck('name')->all();
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:auth_users,email,'.$id,
            'password' => 'confirmed',
            'roles' => 'required'
        ]);
    
        $user = User::find($id);
        $user->name = $this->name;
        $user->email = $this->email;
        if(!empty($this->password)) { 
            $user->password = Hash::make($this->password);
        }
        $user->update();

        DB::table('auth_model_has_roles')
            ->where('model_id', $id)
            ->delete();
        $user->assignRole($this->roles);
        $this->emit('toast', ['success', 'User has been updated']);
        $this->dispatchBrowserEvent('closeModal');
    }
     
    public function delete($id)
    {
        User::find($id)->delete();
        $this->emit('toast', ['success', 'User has been deleted']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function bulkDelete()
    {
        User::whereIn('id', $this->selected)->delete();
        $this->emit('toast', ['success', 'Users has been deleted']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
       $user =  User::find(1);
    //    dd($user->tokens()->first()->token);
        // $user->createToken('auth_token')->plainTextToken;
        // dd($user->createToken('auth_token')->plainTextToken);

        return view('auth::livewire.users.table', [
            'users' => User::where('name','ILIKE', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->fastPaginate(10)
        ])
        ->extends('theme::backend.layouts.master');
    }
}
