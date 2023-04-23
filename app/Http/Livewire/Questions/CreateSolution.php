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

    public $solutionModal;

    public function toggleSolutionModal()
    {
        $this->solutionModal = !$this->solutionModal;
        $this->emit('solutionModalToggled', $this->solutionModal);
    }

    public function rules()
    {
        return [
            'solution' => [new QuillEditorRequired, 'required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function mount($status)
    {
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
                    'body' => $data['solution'],
                ]);

                // Success message
                session()->flash('success', 'Solution created successfully!');

                // Reset form fields
                $this->reset();
            });
        } catch (\Exception $e) {
            // handle the exception here
            // for example, you could redirect the user back to the form with an error message
            $this->addError('createSolution', $e->getMessage());
        }

    }
}
