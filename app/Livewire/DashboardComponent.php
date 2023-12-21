<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $categories = [];
    public $heroProd;
    public function mount()
    {
        $this->getHeroSection();
    }

    public function getHeroSection()
    {
        $this->categories = DB::table('categories')->select('id', 'name', 'slug', 'image')->get();
    }

    #[Layout('layouts.guest.main')]
    public function render()
    {
        return view('pages.guest.dashboard');
    }
}
