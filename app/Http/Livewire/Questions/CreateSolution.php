<?php

namespace App\Http\Livewire\Questions;

use App\Models\Question;
use App\Models\Solution;
use App\Rules\QuillEditorRequired;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateSolution extends Component
{

    public $solution;

    public $question;

    public $solutionModal;

    public $message;

    public function openSolutionModal()
    {
        $this->solutionModal = true;
        $this->emit('solutionModalToggled', $this->solutionModal);
    }

    public function closeSolutionModal()
    {
        $this->solutionModal = false;
        $this->emit('solutionModalToggled', $this->solutionModal);
    }

    public function rules()
    {
        return [
            'solution' => [new QuillEditorRequired, 'required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function mount($question, $status)
    {
        $this->question = $question;
        $this->solutionModal = $status;
    }

    public function render()
    {
        return view('livewire.questions.create-solution');
    }

    public function submit()
    {
        $data = $this->validate();

        try {
            DB::transaction(function () use ($data) {
                $question = Solution::create([
                    'user_id' => auth()->id(),
                    'question_id' => $this->question->id,
                    'body' => $data['solution'],
                ]);

                // Success message
                $this->message = 'Solution created successfully!';
                $this->emitUp('flashMessage', $this->message);
                // Reset form fields
                $this->solution = false;
                $this->closeSolutionModal();
            });
        } catch (\Exception $e) {
            // handle the exception here
            // for example, you could redirect the user back to the form with an error message
            $this->addError('createSolution', $e->getMessage());
        }

    }
}
