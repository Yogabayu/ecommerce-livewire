<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class AboutUsComponent extends Component
{
    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.aboutus.index');
    }
}
