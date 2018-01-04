<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
class Gig extends Model
{

    protected $fillable = [
        'uuid',
        'gigtype_id',
        'gigtypes_subcategories_id',
        'gig_subcat_name',
        'user_id',
        'slug',
        'title',
        'suggested_by',
        'short_discription',
        'discription',
        'discription2',
        'discription3',
        'gig_videos',
        'delivery_days',
        'price',
		'auto_assign',
        'status'
    ];

    /**
     * @param array
     *      $gigDataAssocArray['gig']['id']
     *      $gigDataAssocArray['gig']['gig-category-id']
     *      $gigDataAssocArray['gig']['gig-slug']
     *      $gigDataAssocArray['gig']['gig-title']
     *      $gigDataAssocArray['gig']['gig-short-discription']
     *      $gigDataAssocArray['gig']['gig-discription']
     *      $gigDataAssocArray['gig']['gig-delivery-days']
     *      $gigDataAssocArray['gig']['gig-price']
     * @return bool
     *      true = updated successfully
     *      false = updating failed
     */
    public static function gigUpdate($gigDataAssocArray,Request $request) {


        try {

            DB::transaction(function () use ($gigDataAssocArray, $request) {



                $extraCharachters = array(' ', '/', '.');

                $gig = self::find($gigDataAssocArray['gig']['id']);
                $gig->gigtype_id = $gigDataAssocArray['gig']['gig-category-id'];
                $gig->gigtypes_subcategories_id = $gigDataAssocArray['gig']['gig-sub-category-id'];
                $gig->slug = str_replace($extraCharachters, '_', strtolower($gigDataAssocArray['gig']['gig-slug']));
                $gig->title = $gigDataAssocArray['gig']['gig-title'];
                $gig->short_discription = $gigDataAssocArray['gig']['gig-short-discription'];
                $gig->discription = $gigDataAssocArray['gig']['gig-discription'];
                $gig->discription2 = $gigDataAssocArray['gig']['gig-discription1'];
                $gig->discription3 = $gigDataAssocArray['gig']['gig-discription2'];
                $gig->gig_videos = $gigDataAssocArray['gig']['gig_videos'];
                $gig->delivery_days = $gigDataAssocArray['gig']['gig-delivery-days'];
                $gig->price = $gigDataAssocArray['gig']['gig-price'];
                if($request->input('save_only')){
                    $gig->status = "saved";
                }else {
                    $gig->status = "disabled";
                }
                $gig->created_at = date("Y-m-d H:i:s");
                $gig->updated_at = date("Y-m-d H:i:s");
                $gig->update_by = $gigDataAssocArray['gig']['update_by'];
                $gig->rejection = 0;
                $gig->save();

            });

            return true;


        } catch(\Exception $e) {
            return false;
        }

    }

    public static function admingigUpdate($gigDataAssocArray,Request $request) {


        try {

            DB::transaction(function () use ($gigDataAssocArray, $request) {



                $extraCharachters = array(' ', '/', '.');

                $gig = self::find($gigDataAssocArray['gig']['id']);
                $gig->gigtype_id = $gigDataAssocArray['gig']['gig-category-id'];
                $gig->gigtypes_subcategories_id = $gigDataAssocArray['gig']['gig-sub-category-id'];
                $gig->slug = str_replace($extraCharachters, '_', strtolower($gigDataAssocArray['gig']['gig-slug']));
                $gig->title = $gigDataAssocArray['gig']['gig-title'];
                $gig->short_discription = $gigDataAssocArray['gig']['gig-short-discription'];
                $gig->discription = $gigDataAssocArray['gig']['gig-discription'];
                $gig->discription2 = $gigDataAssocArray['gig']['gig-discription1'];
                $gig->discription3 = $gigDataAssocArray['gig']['gig-discription2'];
                $gig->gig_videos = $gigDataAssocArray['gig']['gig_videos'];
                $gig->delivery_days = $gigDataAssocArray['gig']['gig-delivery-days'];
                $gig->price = $gigDataAssocArray['gig']['gig-price'];
                if($request->input('update-accept')){
                    $gig->status = "enabled";
                }
                /*$gig->status = "disabled";*/
                $gig->created_at = date("Y-m-d H:i:s");
                $gig->updated_at = date("Y-m-d H:i:s");
                $gig->update_by = $gigDataAssocArray['gig']['update_by'];
                $gig->rejection = 0;
                $gig->save();

            });

            return true;


        } catch(\Exception $e) {
            return false;
        }

    }

    /**
     * @param int $gigId
     * @return int 0|1 notActivated|Activated
     */
    public static function gigActivate($gigId) {
        $gig = self::find($gigId);

        if($gig->active) {
            $gig->active = 0;
        } else {
            $gig->active = 1;
        }

        $gig->save();

        return $gig->active;
    }

    public static function gigAccept($gigId, $agency_id) {
        $gig = self::find($gigId);
        $gig->status = 'enabled';
        $gig->update_by = $agency_id;
        /*if($gig->status == "disabled") {
            $gig->status = "enabled";
        } else if($gig->status == 'enabled') {
            $gig->status = "disabled";
        }*/

        $gig->save();

        return $gig->status;
    }


    /**
     * @param int $gigId
     * @return int 0|1 notFeatured|Featured
     */
    public static function gigFeatured($gigId) {
        $gig = self::find($gigId);

        if($gig->featured) {
            $gig->featured = 0;
        } else {
            $gig->featured = 1;
        }

        $gig->save();

        return $gig->featured;
    }

    public static function getAllGigs() {
        return self::where(['active' => 1,'status' => 'enabled','vacation' => 0])->orderBy('featured', 'desc')->take(9)->get();
    }

    public static function getAllFeaturedGigs() {
        return self::where(['active' => 1, 'featured' => 1, 'status' => 'enabled','vacation' => 0])->get();
    }

    public static function getCategoryGigs($gigtype) {
        return self::where(['active' => 1,'status' => 'enabled','vacation' => 0,'gigtype_id'=> $gigtype])->orderByRaw("RAND()")->get();
    }
}
