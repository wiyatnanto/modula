<?php

namespace Modules\Auth\Http\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;

    public $userRole, $name, $email, $password, $password_confirmation;
    public $roles = [];
    public $rolesOptions = [];

    protected $listeners = ['resetInputFields' => 'resetInputFields'];
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
        return view('auth::livewire.users.users', [
            'users' => User::orderBy('id', 'desc')->paginate(10)
        ])
        ->extends('theme::backend.layouts.master');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = [];
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
        $this->dispatchBrowserEvent('closeCreateModal');
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update()
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'roles' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('auth/users/create')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
  
        session()->flash('message', 
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
  
        $this->resetInputFields();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
