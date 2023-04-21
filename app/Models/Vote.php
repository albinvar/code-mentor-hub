<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected  $fillable = [
        'vote_type',
        'user_id',
        'solution_id',
    ];
}
