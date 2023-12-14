<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect to your desired page after logout
    }
    public function render()
    {
        return <<<'HTML'
        <div>
            <a wire:click="logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
        HTML;
    }
}
