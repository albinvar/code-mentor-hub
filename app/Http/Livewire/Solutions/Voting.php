<?php

namespace App\Http\Livewire\Solutions;

use App\Models\Vote;
use Livewire\Component;

class Voting extends Component
{

    public $solution;

    public function mount($solution)
    {
        $this->solution = $solution;
    }



    public function render()
    {
        return view('livewire.solutions.voting');
    }
}
