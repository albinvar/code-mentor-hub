<?php

namespace App\Http\Livewire\Mentors;

use App\Models\OneToOneSession;
use Livewire\Component;

class RequestsList extends Component
{

    public function approve(OneToOneSession $oneSession)
    {
        $oneSession->status = 1;
        $oneSession->save();
    }

    public function reject(OneToOneSession $oneSession)
    {
        $oneSession->status = 2;
        $oneSession->save();
    }

    public function render()
    {
        $requests = auth()->user()->mentorSessions()->latest()->get();
        return view('livewire.mentors.requests-list', compact('requests'));
    }
}
