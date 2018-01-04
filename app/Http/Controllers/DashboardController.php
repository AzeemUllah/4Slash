<?php

namespace App\Http\Controllers;
use DB;
use App\FavouriteGigs;
use App\Gigtype;
use App\GigImages;
use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Gig;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

            $user = Auth::user()->get();
            $data['user'] = $user;
            $gigs = Gig::getAllGigs();
            foreach ($gigs as $gig) {
                $gig['gigtype_slug'] = Gigtype::where(['id' => $gig->gigtype_id])->first()->slug;
                $gig['thumbnail'] = GigImages::getGigThumbnail($gig->id);
                $favouriteGig = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $gig->id])->first();


                if(is_object($favouriteGig)) {
                    $gig['favourite'] = ' collected';
                    $gig['my_fav'] = true;
                } else {
                    $gig['favourite'] = '';
                    $gig['my_fav'] = false;
                }

            }


            $data['gigs'] = $gigs;
            $userDetail = DB::table('users_info')->where('user_id',$user->id)->first();
            $data['userDetail'] = $userDetail;
            return view('pages.dashboard')->with($data);

    }

    

}
