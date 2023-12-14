<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Auth extends Component
{     
    public $count = 1;
 
    public function increment()
    {
        $this->count++;
    }
 
    public function decrement()
    {
        $this->count--;
    }

    #[Layout('components.admin.layouts.auth')] 
    public function render()
    {
        return view('pages.admin.login');
    }
}
