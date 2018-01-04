<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GigImages extends Model
{
    protected $table = 'gig_images';

    protected $fillable = [
        'image',
        'gig_id'
    ];

    /**
     * @param $gigId
     * @return gig thumbnail url
     */
   public static function getGigThumbnail($gigId) {

  
        $gig = Gig::where(['id' => $gigId])->first();
        $gigThumbnail = self::where(['gig_id' => $gig->id])->value('image');
       if(file_exists(public_path('/files/gigs/images') . '/' . $gigThumbnail)){
           return url() . "/files/gigs/images/" . $gigThumbnail;
       }else{
           return '';
       }
    }

    public static function removeGigImage($gigImageId) {

        $gigImage = self::find($gigImageId);


        try {
            if(file_exists(public_path('/files/gigs/images') . '/' . $gigImage->image)){
                unlink(public_path('/files/gigs/images') . '/' . $gigImage->image);
            }
            self::destroy($gigImageId);
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
