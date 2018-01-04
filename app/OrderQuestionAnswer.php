<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderQuestionAnswer extends Model
{
    protected $table = 'order_questions_answers';

    protected $fillable = [
        'gig_question_id',
        'order_id',
        'answers',
    ];
}
