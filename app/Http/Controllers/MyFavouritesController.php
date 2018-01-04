<?php

namespace App\Http\Controllers;

use App\FavouriteGigs;
use App\FavouritePackages;
use App\Gigtype;
use App\GigImages;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Gig;
use App\Package;
use App\PackageOption;
use Illuminate\Support\Facades\Auth;

class MyFavouritesController extends Controller
{

    public function index(Request $request)
    {
        $show_rating25=0;
        $show_pack_rating = 0;
        $loggedInUser = Auth::user()->get();

        // getting favourite gigs by user id and assign to a variable
        $myFavourites = FavouriteGigs::where(['user_id' => $loggedInUser->id])->get();
        $gigs = [];

        // getting favourite gigs by user id and assign to a variable
        $myFavouritesPack = FavouritePackages::where(['user_id' => $loggedInUser->id])->get();
        $packages = [];

        if(count($myFavouritesPack) > 0){
            foreach ( $myFavouritesPack as $mypack){
                $package = Package::where('id',$mypack->package_id)->first();
                $rating = DB::table('order_feedback')->where('gig_id',$mypack->package_id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_pack_rating = $avg_rate/$count_avg_rows;
                    $package['show_pack_rating'] = round($show_pack_rating,1) ;
                }
                else{
                    $package['show_pack_rating'] = 0;
                }
                if (is_object($package)) {

                    $package['thumbnail'] = PackageOption::getPackageThumbnail($mypack->package_id);

                        array_push($packages, $package);
                        array_unique($packages);


                } else {

                    continue;

                }
            }
        }

        if (count($myFavourites) > 0) {

            foreach ($myFavourites as $myFavourite) {

                $gig = Gig::where(['id' => $myFavourite->gig_id])->first();
                $rating = DB::table('order_feedback')->where('gig_id',$myFavourite->id)->get();
                $count_avg_rows = count($rating);

                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating25 = $avg_rate/$count_avg_rows;
                    $gig['show_rating25'] = round($show_rating25,1) ;
                }
                else{
                    $gig['show_rating25'] = 0;
                }

                if (is_object($gig)) {

                    if(is_object($gigType = Gigtype::where(['id' => $gig->gigtype_id])->first())) {

                        $gig['gigType'] = $gigType;
                        $gig['thumbnail'] = GigImages::getGigThumbnail($gig->id);

                        array_push($gigs, $gig);
                        array_unique($gigs);

                    }
                    else {

                        continue;

                    }

                } else {

                    continue;

                }

            }

        }




        // assign myfavourite gigs variable to data variable to send to the view
        $data['myFavouriteGigs'] = $gigs;
        $data['show_rating25'] = $gigs;

        $data['myFavouritePackages'] = $packages;
        $data['show_pack_rating'] = $packages;


        // returning the favourite view page.
        return view('pages.favourites')->with($data);
    }

}
