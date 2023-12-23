<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBoxComponent extends Component
{
    public $suggestions = ['Suggestion 1', 'Suggestion 2', 'Suggestion 3'];
    public $inputText = '';

    public function render()
    {
        return view('pages.guest.dashboard.components.search-box');
    }
}
