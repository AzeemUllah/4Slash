<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gig_question extends Model
{
    protected $table = 'gig_questions';

    protected $fillable = [
        'gig_id',
        'question',
        'answers',
        'type',
    ];

}
