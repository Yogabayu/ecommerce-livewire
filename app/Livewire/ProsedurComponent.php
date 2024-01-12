<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ProsedurComponent extends Component
{

    public function mount()
    {
        // dd('masuk');
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.procedure.index');
    }
}
