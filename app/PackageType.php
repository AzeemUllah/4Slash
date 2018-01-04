<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
    protected $table = 'packages_types';

    protected $fillable = [
        'name',
        'active'
    ];


    public static function packageTypeActivate($packageTypeId) {
        $packageType = self::find($packageTypeId);

        if($packageType->active) {
            $packageType->active = 0;
        } else {
            $packageType->active = 1;
        }

        $packageType->save();

        return $packageType->active;
    }
}