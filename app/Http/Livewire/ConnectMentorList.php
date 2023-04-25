<?php

namespace App\Http\Livewire;

use App\Models\OneToOneSession;
use App\Models\Profile;
use App\Models\Question;
use App\Models\User;
use Livewire\Component;

class ConnectMentorList extends Component
{
    public function render()
    {
        // user tags
        $currentUserTags = auth()->user()->profile->tags()->pluck('name');

        // get matching questions from the db with all tags matching the profile.
        $matchingMentors = Profile::whereHas('user', function ($query) {
            $query->role('Mentor');
        })->withAllTags($currentUserTags)->latest()->get();

        // get partially matching results wth any tags matching the profile.
        $partiallyMatchingMentors = Profile::whereHas('user', function ($query) {
            $query->role('Mentor');
        })->withAnyTags($currentUserTags)->latest()->get();

        // Problems without any matching profiles.
        $nonMatchingMentors = Profile::whereHas('user', function ($query) {
            $query->role('Mentor');
        })->latest()->get();

        $mergedMentors = $matchingMentors->merge($partiallyMatchingMentors);
        $mergedMentors = $mergedMentors->merge($nonMatchingMentors);
        $uniqueMentors = $mergedMentors->unique();

        return view('livewire.connect-mentor-list', ['mentors' => $uniqueMentors]);
    }


    public function connectMentor(User $user)
    {
       return redirect()->route('profile', ['user' => $user->username]);
    }
}
