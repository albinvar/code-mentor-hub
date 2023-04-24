<?php

namespace App\Observers;

use App\Models\Question;
use Illuminate\Support\Str;

class QuestionObserver
{
    /**
     * Handle the Question "created" event.
     */
    public function created(Question $question): void
    {
        //
    }

    public function creating(Question $question): void
    {
        $slug = Str::slug($question->title, '-');
        $count = Question::where('slug', 'LIKE', $slug.'%')->count();
        if ($count > 0) {
            $slug .= '-'.($count + 1);
        }
        $question->slug = $slug;
    }

    /**
     * Handle the Question "updated" event.
     */
    public function updated(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "deleted" event.
     */
    public function deleted(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "restored" event.
     */
    public function restored(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "force deleted" event.
     */
    public function forceDeleted(Question $question): void
    {
        //
    }
}
