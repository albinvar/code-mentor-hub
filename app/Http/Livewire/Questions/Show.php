<?php

namespace App\Http\Livewire\Questions;

use Livewire\Component;

class Show extends Component
{
    public $question;

    public bool $solutionModal = false;

    protected $listeners = [
        'solutionModalToggled' => 'updateSolutionModalState',
        'flashMessage' => 'setFlashMessage'
    ];

    public function setFlashMessage($message)
    {
        session()->flash('success', $message);
    }

    public function updateSolutionModalState($solutionModal)
    {
        $this->solutionModal = $solutionModal;
    }

    public function mount($question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.questions.show');
    }
}
