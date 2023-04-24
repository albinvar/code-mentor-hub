<?php

namespace App\Http\Livewire\Solutions;

use App\Models\Solution;
use App\Models\Vote;
use Livewire\Component;

class Show extends Component
{

    public $solutions = [];

    public function mount($solutions)
    {
        $this->solutions = $solutions;
    }

    public function upvote(Solution $solution)
    {
        $user = auth()->user();

        // Check if the user has already voted for this solution
        $vote = Vote::where('user_id', $user->id)
            ->where('solution_id', $solution->id)
            ->first();

        if ($vote && $vote->vote_type == -1) {
            // If the user has already voted, update the existing vote
            $vote->vote_type = 1;
            $vote->save();
        }elseif ($vote){
            $vote->delete();
        } else {
            // If the user hasn't voted, create a new vote
            Vote::create([
                'user_id' => $user->id,
                'solution_id' => $solution->id,
                'vote_type' => 1,
            ]);
        }

        $this->solution = $solution;
    }

    public function downvote(Solution $solution)
    {
        $user = auth()->user();

        // Check if the user has already voted for this solution
        $vote = Vote::where('user_id', $user->id)
            ->where('solution_id', $solution->id)
            ->first();

        if ($vote && $vote->vote_type == 1) {
            // If the user has already voted, update the existing vote
            $vote->vote_type = -1;
            $vote->save();
        }elseif ($vote){
            $vote->delete();
        } else {
            // If the user hasn't voted, create a new vote
            Vote::create([
                'user_id' => $user->id,
                'solution_id' => $solution->id,
                'vote_type' => -1,
            ]);
        }

        // Refresh the component to update the vote count
        $this->emit('solutionVoted');
    }

    public function render()
    {
        return view('livewire.solutions.show');
    }
}
