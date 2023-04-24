<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Rules\QuillEditorRequired;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PostQuestion extends Component
{
    public $question;

    public $title;

    public array $tags = [];

    public function rules()
    {
        return [
            'title' => 'required|string|max:50|min:5',
            'question' => [new QuillEditorRequired, 'required', 'string', 'min:10', 'max:5000'],
            'tags' => 'required|array|min:1',
            'tags.*' => 'required|string|max:255',
        ];
    }

    public function addTag($tags)
    {
        $this->tags = $tags;
        $this->emit('tagsUpdated', $this->tags);
    }

    public function removeTag($tag)
    {
        $this->tags = array_values(array_filter($this->tags, function ($t) use ($tag) {
            return $t != $tag;
        }));
        $this->emit('tagsUpdated', $this->tags);
    }

    public function render()
    {
        return view('livewire.post-question');
    }

    public function submit()
    {
        $data = $this->validate();
        try {
            DB::transaction(function () use ($data) {
                $question = Question::create([
                    'user_id' => auth()->id(),
                    'title' => $data['title'],
                    'body' => $data['question'],
                ]);

                $question->attachTags($data['tags']);

                // Success message
                session()->flash('success', 'Question created successfully!');

                // Reset form fields
                $this->reset();
            });
        } catch (\Exception $e) {
            // handle the exception here
            // for example, you could redirect the user back to the form with an error message
            $this->addError('createQuestion', $e->getMessage());
        }

    }
}
