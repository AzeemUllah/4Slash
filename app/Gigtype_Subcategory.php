<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gigtype_Subcategory extends Model
{
    protected $table = 'gigtypes_subcategories';

    protected $fillable = [
        'slug',
        'name',
        'gigtypes_id'
    ];


}