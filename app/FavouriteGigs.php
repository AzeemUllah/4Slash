<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavouriteGigs extends Model
{
    protected $table = 'favourite_gigs';
    protected $fillable = [
        'gig_id',
        'user_id',
    ];
}
