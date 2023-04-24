<?php

namespace App\Http\Livewire\Solutions;

use App\Models\Vote;
use Livewire\Component;

class Show extends Component
{

    public $solutions = [];

    public function mount($solutions)
    {
        $this->solutions = $solutions;
    }

    public function render()
    {
        return view('livewire.solutions.show');
    }
}
