<?php

namespace App\Http\Livewire\Solutions;

use App\Models\Vote;
use Livewire\Component;

class Voting extends Component
{

    public $solution;

    public function mount($solution)
    {
        $this->solution = $solution;
    }

    public function upvote()
    {
        $user = auth()->user();

        // Check if the user has already voted for this solution
        $vote = Vote::where('user_id', $user->id)
            ->where('solution_id', $this->solution->id)
            ->first();

        if ($vote) {
            // If the user has already voted, update the existing vote
            $vote->vote_type = 1;
            $vote->save();
        } else {
            // If the user hasn't voted, create a new vote
            Vote::create([
                'user_id' => $user->id,
                'solution_id' => $this->solution->id,
                'vote_type' => 1,
            ]);
        }

        // Refresh the component to update the vote count
        $this->emit('solutionVoted');
    }

    public function render()
    {
        return view('livewire.solutions.voting');
    }
}
