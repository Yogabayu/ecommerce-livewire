<?php

namespace App\Livewire\Admin;

use App\Models\Role;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class User extends Component
{
    use WithFileUploads, LivewireAlert;
    public $users, $roles;
    public $role_id, $photo, $nik, $name, $email, $password;
    public $confirmingUserDeletion = false;
    public $userToDeleteUuid;

    public function addUser()
    {
        $this->validate([
            'role_id' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png|max:2048',
            'nik' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Save the photo to the storage
        $photo = md5($this->photo . microtime()) . '.' . $this->photo->extension();
        $this->photo->storeAs('photos', $photo);

        // Create a new user
        ModelsUser::create([
            'role_id' => $this->role_id,
            'uuid' => Str::uuid(),
            'nik' => $this->nik,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'photo' => $photo,
        ]);

        $this->reset(['role_id', 'nik', 'name', 'email', 'password', 'photo']);
        session()->flash('success', 'User added successfully!');
    }

    public function confirmUserDeletion($userUuid)
    {
        $this->userToDeleteUuid = $userUuid;
        $this->confirmingUserDeletion = true;
    }

    public function deleteUser()
    {
        $user = ModelsUser::where('uuid', $this->userToDeleteUuid)->first();

        if ($user) {
            $user->delete();
            session()->flash('success', 'User deleted successfully.');
        }

        // Reset variables
        $this->confirmingUserDeletion = false;
        $this->userToDeleteUuid = null;
    }

    #[Layout('layouts.admin.app')]
    public function render()
    {
        $this->users = ModelsUser::all();
        $this->roles = Role::all();
        return view('livewire.admin.user');
    }
}
