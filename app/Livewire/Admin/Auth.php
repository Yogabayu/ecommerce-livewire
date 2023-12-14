<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth as facecadeAuth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Auth extends Component
{
    public $email, $password;
    public $registerForm = false;

    private function resetInputFields()
    {
        $this->email = '';
        $this->password = '';
    }
    public function login()
    {
        $this->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if (facecadeAuth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('dashboard')->with('success', 'success login');
        } else {
            session()->flash('error', 'email and password are wrong.');
        }
    }

    #[Layout('layouts.admin.auth')]
    public function render()
    {
        return view('livewire.admin.auth');
    }
}
