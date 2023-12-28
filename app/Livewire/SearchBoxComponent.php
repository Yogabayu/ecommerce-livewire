<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBoxComponent extends Component
{
    public $inputText = '';

    public function search()
    {
        $this->redirectRoute('search', ['inputText' => $this->inputText]);
    }

    public function render()
    {
        return view('pages.guest.dashboard.components.search-box');
    }
}
