<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ContactUsComponent extends Component
{

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.contactus.index');
    }
}
