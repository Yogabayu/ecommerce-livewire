<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

class DetailProductComponent extends Component
{
    #[Url]
    public $slug;

    public function mount()
    {
        dd($this->slug);
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.detailproduct.index');
    }
}
