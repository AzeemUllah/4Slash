<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PackageOption extends Model
{
    protected $table = 'package_images';

    protected $fillable = [
        'image',
        'package_id'
    ];

    /**
     * @param $packageId
     * @return package thumbnail url
     */
    public static function getPackageThumbnail($packageId) {


        $package = Package::where(['id' => $packageId])->first();
        $packageThumbnail = self::where(['package_id' => $package->id])->value('image');
        if(file_exists(public_path('/files/gigs/images') . '/' . $packageThumbnail)){
            return url() . "/files/gigs/images/" . $packageThumbnail;
        }else{
            return '';
        }
    }

    public static function removePackageImage($packageId) {

        $packageImage = self::find($packageId);


        try {
            if(file_exists(public_path('/files/gigs/images') . '/' . $packageImage->image)){
                unlink(public_path('/files/gigs/images') . '/' . $packageImage->image);
            }
            self::destroy($packageId);
            return true;
        } catch(\Exception $e) {
            return false;
        }

    }

    public static function removeImage($gigImageId) {
        self::find($gigImageId);
        self::destroy($gigImageId);
    }
}