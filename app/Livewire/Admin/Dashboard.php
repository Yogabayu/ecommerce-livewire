<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.admin.layouts.app')] 
    public function render()
    {
        return view('pages.admin.dashboard');
    }
}
