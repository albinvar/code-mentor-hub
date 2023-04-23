<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Community extends Component
{
    public function render()
    {
        $currentUserTags = auth()->user()->profile->tags()->pluck('id');

        $questions = Question::whereHas('tags', function($query) use ($currentUserTags) {
            $query->whereIn('tags.id', $currentUserTags);
        })
            ->withCount(['tags' => function ($query) use ($currentUserTags) {
                $query->whereIn('tags.id', $currentUserTags);
            }])
            ->orderByDesc('tags_count')
            ->get();

        $unmatchedQuestions = Question::whereDoesntHave('tags')
            ->orderBy('created_at', 'desc')
            ->get();

        $questions = $questions->merge($unmatchedQuestions);


        return view('livewire.community', ['questions' => $questions]);
    }
}
