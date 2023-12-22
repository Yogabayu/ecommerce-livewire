<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PrivacyPolicyComponent extends Component
{
    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.privacypolicy.index');
    }
}
