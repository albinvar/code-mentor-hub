<?php

namespace App\Http\Livewire\Questions;

use Livewire\Component;

class Show extends Component
{
    public $question;

    public function mount($question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.questions.show');
    }
}
