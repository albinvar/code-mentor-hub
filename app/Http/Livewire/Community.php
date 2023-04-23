<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class Community extends Component
{
    public function render()
    {
        // user tags
        $currentUserTags = auth()->user()->profile->tags()->pluck('name');

        // get matching questions from the db with all tags matching the profile.
        $matchingQuestions = Question::withAllTags($currentUserTags)->latest()->get();

        // get partially matching results wth any tags matching the profile.
        $partiallyMatchingQuestions = Question::withAnyTags($currentUserTags)->latest()->get();

        // Problems without any matching profiles.
        $nonMatchingQuestions = Question::latest()->get();

        $mergedQuestions = $matchingQuestions->merge($partiallyMatchingQuestions);
        $mergedQuestions = $mergedQuestions->merge($nonMatchingQuestions);
        $uniqueQuestions = $mergedQuestions->unique();

        return view('livewire.community', ['questions' => $uniqueQuestions]);
    }
}
