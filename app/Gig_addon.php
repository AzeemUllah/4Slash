<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gig_addon extends Model
{
    protected $table = 'gig_addons';

    protected $fillable = [

        'gig_id',
        'addon',
        'day',
        'amount',

    ];
    public function addonRemove($addonId)
    {

        




    }
}
