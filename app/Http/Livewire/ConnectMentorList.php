<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\Question;
use Livewire\Component;

class ConnectMentorList extends Component
{
    public function render()
    {
        // user tags
        $currentUserTags = auth()->user()->profile->tags()->pluck('name');

        // get matching questions from the db with all tags matching the profile.
        $matchingMentors = Profile::withAllTags($currentUserTags)->latest()->get();

        // get partially matching results wth any tags matching the profile.
        $partiallyMatchingMentors = Profile::withAnyTags($currentUserTags)->latest()->get();

        // Problems without any matching profiles.
        $nonMatchingMentors = Profile::latest()->get();

        $mergedMentors = $matchingMentors->merge($partiallyMatchingMentors);
        $mergedMentors = $mergedMentors->merge($nonMatchingMentors);
        $uniqueMentors = $mergedMentors->unique();

        return view('livewire.connect-mentor-list', ['mentors' => $uniqueMentors]);
    }
}
