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

        $gigThumbnail = self::where(['gig_id' => $gig->id])->first()->image;

       if(!empty($gigThumbnail) AND $gigThumbnail != '')
            return url() . "/files/gigs/images/" . $gigThumbnail;
        else
            return $gigThumbnail;
    }

    public static function removeGigImage($gigImageId) {

        $gigImage = self::find($gigImageId);

        try {
            unlink(public_path('/files/gigs/images') . '/' . $gigImage->image);
			
			
        } catch(\Exception $e) {

        }
		
	self::where(['id' => $gigImageId])->delete();
    }


}
