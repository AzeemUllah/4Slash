<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Express_addons extends Model
{
    protected $table = 'express_addon';

    protected $fillable = [

        'gig_id',
        'addon',
        'amount',
        'day'

    ];
}
