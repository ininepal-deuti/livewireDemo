<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public $allUsers, $name, $email,$password, $user_id;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
    ];

    public function index()
    {
        return view('livewire.users.index');
    }

    public function render()
    {
        $this->allUsers = User::latest()->get();
        return view('livewire.users.list');
    }

    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function submitUser()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'User Created Successfully.');
        $this->resetInputFields();
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->updateMode = true;
    }

    public function cancelUser()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function updateUser()
    {
        $this->validate();
        $user = User::find($this->user_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->updateMode = false;
        session()->flash('message', 'User Updated Successfully.');
        $this->resetInputFields();
    }

    public function destroyUser($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }
}
