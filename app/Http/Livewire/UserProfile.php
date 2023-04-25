<?php

namespace App\Http\Livewire;

use App\Models\OneToOneSession;
use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{

    public $user;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user-profile');
    }

    public function requestMentor(User $mentor)
    {
        // check if the user already has a pending request.
        if (auth()->user()->userSessions()->where('mentor_id', $mentor->id)->where('user_id', auth()->id())->where('status', 0)->count() > 0)
        {
            //the user has pending request with the mentor.
            dd("error");

        } else {
            // create new request to the mentor.
            $pr = OneToOneSession::create([
                'user_id' => auth()->id(),
                'mentor_id' => $mentor->id,
                'status' => 0,
                'url' => 'https://meet.google.com/abc-efgh-jkl'
            ]);

            $this->emit('refreshComponent');
        }
    }

    public function getStatusOfRequest($mentor)
    {
        if (auth()->user()->userSessions()->where('mentor_id', $mentor->id)->where('user_id', auth()->id())->where('status', 0)->count() > 0)
        {
            return 0;
        } else if(auth()->user()->userSessions()->select('status')->where('mentor_id', $mentor->id)->where('user_id', auth()->id())->exists()) {
            return auth()->user()->userSessions()->select('status')->where('mentor_id', $mentor->id)->where('user_id', auth()->id())->get();
        } else {
            return 9;
        }

    }
}
