<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostQuestion extends Component
{

    public $question;

    public $title;

    public array $tags;

    public function render()
    {
        return view('livewire.post-question');
    }
}
