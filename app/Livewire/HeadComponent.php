<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HeadComponent extends Component
{
    public $categories = [];

    public function mount()
    {
        $this->categories = DB::table('categories')
            ->select('id', 'name', 'slug', 'image')
            ->groupBy('id', 'name', 'slug', 'image')
            ->where('status', '!=', 0)
            ->havingRaw('COUNT(id) <= 11')
            ->get();
    }

    public function render()
    {
        return view('pages.guest.components.hero');
    }
}
