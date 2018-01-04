<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'packages_id',
        'title',
        'pack_desc',
        'price',
        'packages_types_id',
        'packages_subtypes_id',
        'favor_id',
        'user_id',
        'suggested_by',
        'status',
        'save'
    ];

    public static function packageActivate($packageId) {
        $package = self::find($packageId);

        if($package->active) {
            $package->active = 0;
        } else {
            $package->active = 1;
        }

        $package->save();

        return $package->active;
    }

    public static function packageFeatured($packageId) {
        $package = self::find($packageId);

        if($package->featured) {
            $package->featured = 0;
        } else {
            $package->featured = 1;
        }

        $package->save();

        return $package->featured;
    }

    public static function getAllFeaturedPackages() {
        return self::where(['active' => 1, 'featured' => 1, 'status' => 'enabled','vacation' => 0])->get();
    }

    public static function getCategoryPackages($gigtype) {
        return self::where(['active' => 1,'status' => 'enabled','packages_types_id'=> $gigtype ,'vacation' => 0])->orderByRaw("RAND()")->take(4)->get();
    }

}