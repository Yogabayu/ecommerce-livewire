<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class FaqComponent extends Component
{
    public $faqs = [];

    #[Layout('layouts.guest.main')]
    public function mount()
    {
        $this->faqs = DB::table('faqs')
            ->select('id', 'question', 'answer')
            ->get();
    }
    public function render()
    {
        return view('pages.guest.faq.index');
    }
}
