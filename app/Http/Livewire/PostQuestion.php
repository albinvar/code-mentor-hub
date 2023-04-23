<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostQuestion extends Component
{

    public $question;

    public $title;

    public array $tags;

    public function rules()
    {
        return [
            'title' => 'required|string|max:50|min:5',
            'question' => 'required|string|min:10|max:5000',
            'tags' => 'required|array|min:1',
            'tags.*' => 'required|string|max:255',
        ];
    }

    public function render()
    {
        return view('livewire.post-question');
    }

    public function submit()
    {
        $this->validate();
    }
}
