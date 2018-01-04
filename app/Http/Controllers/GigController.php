<?php

namespace App\Http\Controllers;

use App\Gig_addon;
use App\Express_addons;
use App\GigImages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Gigtype;
use App\Gigtype_Subcategory;
use App\Gig;
use App\Order;
use App\FavouriteGigs;
use App\Gig_question;
use DB;

use Illuminate\Support\Facades\Auth;
use Session;

class GigController extends Controller
{
    private function getQuestions($questions)
    {
        foreach($questions as $question)
        {
            if($question->type == 'check')
                $question->answers = explode(',', $question->answers);
            else if($question->type = 'range')
                $question->answers = explode(' ', $question->answers);
        }

        return $questions;
    }

    public function index(Request $request, $gigType, $gig)
    {
        $user = Auth::user()->get();

        $data['user'] = $user;
        $show_rating=0;
        if(isset($_POST['Favorite']))
        {


            $gig = Gig::where(['uuid' => $_REQUEST['funnel']])->first();




            if($_POST['Favorite'] == 'addToFavorite') {

                $fg = new FavouriteGigs;
                $fg->gig_id = $gig->id;
                $fg->user_id = $user->id;
                $fg->save();
            }
            else if($_POST['Favorite'] == 'DeleteFavorite'){

                $fg = FavouriteGigs::where('user_id', $user->id)->delete();
            }
            
            $totalFavourite = FavouriteGigs::where(['gig_id' => $gig->id])->count();
            
            return $totalFavourite;
        }

        $gigTypee = Gigtype::where('slug', $gigType)->first();
        $gig = Gig::where(['gigtype_id' => $gigTypee->id, 'slug' => $gig, 'uuid' => $request->input('funnel')])->first();
        $rating = DB::table('order_feedback')->where('gig_id',$gig->id)->get();
        $count_avg_rows = count($rating);
        $avg_rate = 0;


        foreach($rating as $rate){
            $avg_rate += $rate->order_feedback;
        }
        if($avg_rate>0)
        {
            $show_rating = $avg_rate/$count_avg_rows;
        }
        else{
            $show_rating=0;
            }

        $categorygigs = Gig::getCategoryGigs($gig->gigtype_id);
        foreach ($categorygigs as $featuredGig) {

            $featuredGig['gigtype_slug'] = Gigtype::where(['id' => $featuredGig->gigtype_id])->first()->slug;
            $featuredGig['thumbnail'] = GigImages::getGigThumbnail($featuredGig->id);
            $featuredGig['sale_count'] = Order::where(['gig_id'=>$featuredGig->id])->count();

            if($user){
                $favouriteGig = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $featuredGig->id])->first();

                if(is_object($favouriteGig)) {
                    $featuredGig['favourite'] = ' collected';
                    $featuredGig['my_fav'] = true;
                } else {
                    $featuredGig['favourite'] = '';
                    $featuredGig['my_fav'] = false;
                }
            }

        }


        Session::put('order_gig', $gig);

        if(Auth::user()->check()) {
            $favourite = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $gig->id])->first();
            if (is_object($favourite)) {

                $gig['favourite'] = ' collected';
                $gig['my_fav'] = true;
            } else {
                $gig['favourite'] = '';
                $gig['my_fav'] = false;
            }
        }


        $totalFavourite = FavouriteGigs::where(['gig_id' => $gig->id])->count();
        $gig->totalFavourite = $totalFavourite;


        $questions =  Gig_question::where('gig_id', $gig->id)->get();
        $gig_addons = Gig_addon::where(['gig_id' => $gig->id])->get();
        $express_addons = Express_addons::where(['gig_id' => $gig->id])->get();
        $gig_images = GigImages::where(['gig_id' => $gig->id])->get();
        if(Auth::user()->check())
        {
        $my_fav     = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $gig->id])->first();


        if($my_fav)
            $data['my_fav'] = true;
        else
            $data['my_fav'] = false;
        }

        $sales = Order::where(['gig_id' => $gig->id])->count();
        $data['sales'] = $sales;
        $data['questions'] = $this->getQuestions($questions);
        $data['gigType'] = $gigTypee;
        $data['gig'] = $gig;
        $data['gig_addons'] = $gig_addons;
        $data['express_addons'] = $express_addons;
        $data['gig_images'] = $gig_images;
        $data['categorygigs'] = $categorygigs;
        $data['rating_gig_show'] = round($show_rating,1) ;

        return view('pages.gig')->with($data);
    }

    public function favourite(Request $request) {

         $user = Auth::user()->get();

       
        if($request->input('action') == 'addToFavorite') {
            FavouriteGigs::insert(['user_id' => $user->id, 'gig_id' => $request->input('gig-id'), 'created_at' => date('Y-m-d H:m:i'), 'updated_at' => date('Y-m-d H:m:i')]);
            $data = 1;
        }
        else {
            FavouriteGigs::where(['gig_id' => $request->input('gig-id'), 'user_id' => $user->id])->delete();
            $data = 0;
        }

        return $data;
    }


    public function UnFavourite(Request $request)
    {
        $user = Auth::user()->get();

        return  FavouriteGigs::where(['gig_id' => $request->input('gig-id'), 'user_id' => $user->id])->delete();

    }

}
