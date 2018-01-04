<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavouritePackages extends Model
{
    protected $table = 'favourite_packages';
    protected $fillable = [
        'pacakge_id',
        'user_id',
    ];
}
