<?php

namespace Modules\Auth\Http\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;

class Table extends Component
{
    use WithPagination;

    public $userId, $userRole, $name, $email, $password, $password_confirmation;
    public $roles = [];
    public $rolesOptions = [];

    public $sortField ='id';
    public $sortAsc = true;
    public $search = '';

    public $createMode = false;
    public $updateMode = false;

    protected $listeners = ['resetInputFields' => 'resetInputFields', 'delete' => 'delete'];
    protected $paginationTheme = 'bootstrap';

    protected $messages = [
        'name.required' => 'The Name cannot be empty.',
        'email.required' => 'The Email Address cannot be empty.',
        'password.required' => 'The Password cannot be empty.',
        'password_confirmation.required' => 'The Confirm Password cannot be empty.',
        'roles.required' => 'The Role cannot be empty.',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->rolesOptions = Role::pluck('name','name')->all();
        return view('auth::livewire.users.table', [
            'users' => User::where('name','like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(10)
        ])
        ->extends('theme::backend.layouts.master');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function resetInputFields() {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->roles = [];

        $this->createMode = false;
        $this->updateMode = false;
        $this->resetErrorBag();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'roles' => 'required'
        ]);
        
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'avatar' => '-'
        ]);
        $user->assignRole($this->roles);
        $this->dispatchBrowserEvent('closeModalCreate');
        $this->resetInputFields();
        return redirect('auth/users')
            ->with('success', 'User updated successfully.');
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->createMode = true;
        $this->dispatchBrowserEvent('openModalCreate');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $this->updateMode = true;
        $user = User::find($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->rolesOptions = Role::pluck('name','name')->all();
        $this->roles = $user->roles->pluck('name')->all();
        $this->dispatchBrowserEvent('openModalUpdate');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update($id)
    {
        // Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,'.$id,
        //     'password' => 'confirmed',
        //     'roles' => 'required'
        // ]);
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
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

        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();
    
        $user->assignRole($this->roles);
    
        return redirect('auth/users')
            ->with('success', 'User updated successfully.');
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        User::find($id)->delete();
        // session()->flash('message', 'User has been deleted');
        return redirect()->to('/auth/users')->with('success','User has been deleted!');
    }
}
