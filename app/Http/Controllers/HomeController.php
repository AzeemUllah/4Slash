<?php

namespace App\Http\Controllers;
error_reporting(E_ALL);
ini_set("display_errors",1);
use App\Gig;
use App\Order;
use App\Package;
use App\PackageOption;
use App\OrderAddon;
use App\User;
use Carbon\Carbon;
use App\Gigtype;
use App\FavouriteGigs;
use App\FavouritePackages;
use App\GigImages;
use App\Gigtype_Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Response;
use Hash;
use Mail;
use DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{

    public function index()
    {
        $show_rating1=0;
        $show_rating2=0;
        $show_rating3=0;
        $show_rating4=0;
        $show_rating5=0;
        $show_rating6=0;
        $show_rating7=0;
        $show_rating8=0;
        $show_rating9=0;
        $show_rating10=0;
        $show_rating11=0;
        $show_rating12=0;
        $show_rating13=0;
        $show_rating14=0;

        
            $featuredGigs = Gig::where(['active' => 1,'status' => 'enabled','vacation' => 0])->orderByRaw("RAND()")->take(3)->get();
            $featuredGigs1 = Gig::where(['active' => 1,'status' => 'enabled','vacation' => 0,'gigtype_id' => 61])->orderByRaw("RAND()")->take(3)->get();
            $featuredGigs2 = Gig::where(['active' => 1,'status' => 'enabled','vacation' => 0,'gigtype_id' => 62])->orderByRaw("RAND()")->take(3)->get();
            $featuredGigs3 = Gig::where(['active' => 1,'status' => 'enabled','vacation' => 0,'gigtype_id' => 63])->orderByRaw("RAND()")->take(3)->get();
            $featuredGigs4 = Gig::where(['active' => 1,'status' => 'enabled','vacation' => 0,'gigtype_id' => 64])->orderByRaw("RAND()")->take(3)->get();
            $featuredGigs5 = Gig::where(['active' => 1,'status' => 'enabled','vacation' => 0,'gigtype_id' => 66])->orderByRaw("RAND()")->take(3)->get();
            $featuredGigs6 = Gig::where(['active' => 1,'status' => 'enabled','vacation' => 0,'gigtype_id' => 129])->orderByRaw("RAND()")->take(3)->get();
            $data['gigtype1'] = Gigtype::where(['active' => 1, 'status' => 'enabled','id' => 61])->first();
            $data['gigtype2'] = Gigtype::where(['active' => 1, 'status' => 'enabled','id' => 62])->first();
            $data['gigtype3'] = Gigtype::where(['active' => 1, 'status' => 'enabled','id' => 63])->first();
            $data['gigtype4'] = Gigtype::where(['active' => 1, 'status' => 'enabled','id' => 64])->first();
            $data['gigtype5'] = Gigtype::where(['active' => 1, 'status' => 'enabled','id' => 66])->first();
            $data['gigtype6'] = Gigtype::where(['active' => 1, 'status' => 'enabled','id' => 129])->first();
            $imgages  = DB::table('home_slider')->orderBy('created_at','asc')->take(15)->get();
            $headings  = DB::table('home_slider_headings')->orderBy('id','desc')->first();
            $gig = Gig::getAllGigs();
           /* $query= DB::table('gigs')->get();

            /*var_dump($query);
            exit;*/
           //foreach($query as $data)
           // {
/*
                $rating = DB::table('order_feedback')->where('gig_id',$data->id)->get();
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
                }*/

           // }
            //exit;*/
            $user = Auth::user()->get();

            $data['user'] = $user;

            foreach ($featuredGigs as $featuredGig) {

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
                $rating = DB::table('order_feedback')->where('gig_id',$featuredGig->id)->get();
                $count_avg_rows = count($rating);

                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating1 = $avg_rate/$count_avg_rows;
                    $gig['show_rating1'] = round($show_rating1,1) ;
                }
                else{
                    $gig['show_rating1'] = 0;
                }

            }

            foreach ($featuredGigs1 as $featuredGig) {

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
                $rating = DB::table('order_feedback')->where('gig_id',$featuredGig->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating2 = $avg_rate/$count_avg_rows;
                    $gig['show_rating2'] = round($show_rating2,1) ;
                }
                else{
                    $gig['show_rating2'] = 0;
                }

            }
            foreach ($featuredGigs2 as $featuredGig) {

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
                $rating = DB::table('order_feedback')->where('gig_id',$featuredGig->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating3 = $avg_rate/$count_avg_rows;
                    $gig['show_rating3'] = round($show_rating3,1) ;
                }
                else{
                    $gig['show_rating3'] = 0;
                }

            }
            foreach ($featuredGigs3 as $featuredGig) {

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
                $rating = DB::table('order_feedback')->where('gig_id',$featuredGig->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating4 = $avg_rate/$count_avg_rows;
                    $gig['show_rating4'] = round($show_rating4,1) ;
                }
                else{
                    $gig['show_rating4'] = 0;
                }

            }
            foreach ($featuredGigs4 as $featuredGig) {

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
                $rating = DB::table('order_feedback')->where('gig_id',$featuredGig->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating5 = $avg_rate/$count_avg_rows;
                    $gig['show_rating5'] = round($show_rating5,1) ;
                }
                else{
                    $gig['show_rating5'] = 0;
                }

            }
            foreach ($featuredGigs5 as $featuredGig) {

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
                $rating = DB::table('order_feedback')->where('gig_id',$featuredGig->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating6 = $avg_rate/$count_avg_rows;
                    $gig['show_rating6'] = round($show_rating6,1) ;
                }
                else{
                    $gig['show_rating6'] = 0;
                }

            }
            foreach ($featuredGigs6 as $featuredGig) {

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
                $rating = DB::table('order_feedback')->where('gig_id',$featuredGig->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating7 = $avg_rate/$count_avg_rows;
                    $gig['show_rating7'] = round($show_rating7,1) ;
                }
                else{
                    $gig['show_rating7'] = 0;
                }

            }

            $featuredpackages = Package::where(['active' => 1,'status' => 'enabled' ,'vacation' => 0])->orderByRaw("RAND()")->take(3)->get();
            $featuredpackages1 = Package::where(['active' => 1,'status' => 'enabled' ,'vacation' => 0,'packages_types_id' => 61])->orderByRaw("RAND()")->take(3)->get();
            $featuredpackages2 = Package::where(['active' => 1,'status' => 'enabled' ,'vacation' => 0,'packages_types_id' => 62])->orderByRaw("RAND()")->take(3)->get();
            $featuredpackages3 = Package::where(['active' => 1,'status' => 'enabled' ,'vacation' => 0,'packages_types_id' => 63])->orderByRaw("RAND()")->take(3)->get();
            $featuredpackages4 = Package::where(['active' => 1,'status' => 'enabled' ,'vacation' => 0,'packages_types_id' => 64])->orderByRaw("RAND()")->take(3)->get();
            $featuredpackages5 = Package::where(['active' => 1,'status' => 'enabled' ,'vacation' => 0,'packages_types_id' => 65])->orderByRaw("RAND()")->take(3)->get();
            $featuredpackages6 = Package::where(['active' => 1,'status' => 'enabled' ,'vacation' => 0,'packages_types_id' => 129])->orderByRaw("RAND()")->take(3)->get();
            foreach ($featuredpackages as $featuredpackage){
                $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                if($user){
                    $favouriteGig = FavouritePackages::where(['user_id' => $user->id, 'package_id' => $featuredpackage->id])->first();

                    if(is_object($favouriteGig)) {
                        $featuredpackage['favourite'] = ' collected';
                        $featuredpackage['my_fav'] = true;
                    } else {
                        $featuredpackage['favourite'] = '';
                        $featuredpackage['my_fav'] = false;
                    }
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating8 = $avg_rate/$count_avg_rows;
                    $gig['show_rating8'] = round($show_rating8,1) ;
                }
                else{
                    $gig['show_rating8'] = 0;
                }
            }
            foreach ($featuredpackages1 as $featuredpackage){
                $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                if($user){
                    $favouriteGig = FavouritePackages::where(['user_id' => $user->id, 'package_id' => $featuredpackage->id])->first();

                    if(is_object($favouriteGig)) {
                        $featuredpackage['favourite'] = ' collected';
                        $featuredpackage['my_fav'] = true;
                    } else {
                        $featuredpackage['favourite'] = '';
                        $featuredpackage['my_fav'] = false;
                    }
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating9 = $avg_rate/$count_avg_rows;
                    $gig['show_rating9'] = round($show_rating9,1) ;
                }
                else{
                    $gig['show_rating9'] = 0;
                }
            }
            foreach ($featuredpackages2 as $featuredpackage){
                $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                if($user){
                    $favouriteGig = FavouritePackages::where(['user_id' => $user->id, 'package_id' => $featuredpackage->id])->first();

                    if(is_object($favouriteGig)) {
                        $featuredpackage['favourite'] = ' collected';
                        $featuredpackage['my_fav'] = true;
                    } else {
                        $featuredpackage['favourite'] = '';
                        $featuredpackage['my_fav'] = false;
                    }
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating10 = $avg_rate/$count_avg_rows;
                    $gig['show_rating10'] = round($show_rating10,1) ;
                }
                else{
                    $gig['show_rating10'] = 0;
                }
            }
            foreach ($featuredpackages3 as $featuredpackage){
                $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                if($user){
                    $favouriteGig = FavouritePackages::where(['user_id' => $user->id, 'package_id' => $featuredpackage->id])->first();

                    if(is_object($favouriteGig)) {
                        $featuredpackage['favourite'] = ' collected';
                        $featuredpackage['my_fav'] = true;
                    } else {
                        $featuredpackage['favourite'] = '';
                        $featuredpackage['my_fav'] = false;
                    }
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating11 = $avg_rate/$count_avg_rows;
                    $gig['show_rating11'] = round($show_rating11,1) ;
                }
                else{
                    $gig['show_rating11'] = 0;
                }
            }
            foreach ($featuredpackages4 as $featuredpackage){
                $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                if($user){
                    $favouriteGig = FavouritePackages::where(['user_id' => $user->id, 'package_id' => $featuredpackage->id])->first();

                    if(is_object($favouriteGig)) {
                        $featuredpackage['favourite'] = ' collected';
                        $featuredpackage['my_fav'] = true;
                    } else {
                        $featuredpackage['favourite'] = '';
                        $featuredpackage['my_fav'] = false;
                    }
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating12 = $avg_rate/$count_avg_rows;
                    $gig['show_rating12'] = round($show_rating12,1) ;
                }
                else{
                    $gig['show_rating12'] = 0;
                }
            }
            foreach ($featuredpackages5 as $featuredpackage){
                $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                if($user){
                    $favouriteGig = FavouritePackages::where(['user_id' => $user->id, 'package_id' => $featuredpackage->id])->first();

                    if(is_object($favouriteGig)) {
                        $featuredpackage['favourite'] = ' collected';
                        $featuredpackage['my_fav'] = true;
                    } else {
                        $featuredpackage['favourite'] = '';
                        $featuredpackage['my_fav'] = false;
                    }
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating13 = $avg_rate/$count_avg_rows;
                    $gig['show_rating13'] = round($show_rating13,1) ;
                }
                else{
                    $gig['show_rating13'] = 0;
                }
            }
            foreach ($featuredpackages6 as $featuredpackage){
                $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                if($user){
                    $favouriteGig = FavouritePackages::where(['user_id' => $user->id, 'package_id' => $featuredpackage->id])->first();

                    if(is_object($favouriteGig)) {
                        $featuredpackage['favourite'] = ' collected';
                        $featuredpackage['my_fav'] = true;
                    } else {
                        $featuredpackage['favourite'] = '';
                        $featuredpackage['my_fav'] = false;
                    }
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating14 = $avg_rate/$count_avg_rows;
                    $gig['show_rating14'] = round($show_rating14,1) ;
                }
                else{
                    $gig['show_rating14'] = 0;
                }
            }


            $data['featuredCat'] = Gigtype::where('featured', 1)->get();

            $data['featuredGigs'] = $featuredGigs;
            $data['featuredGigs1'] = $featuredGigs1;
            $data['featuredGigs2'] = $featuredGigs2;
            $data['featuredGigs3'] = $featuredGigs3;
            $data['featuredGigs4'] = $featuredGigs4;
            $data['featuredGigs5'] = $featuredGigs5;
            $data['featuredGigs6'] = $featuredGigs6;
            $data['featuredPackages'] = $featuredpackages;
            $data['featuredPackages1'] = $featuredpackages1;
            $data['featuredPackages2'] = $featuredpackages2;
            $data['featuredPackages3'] = $featuredpackages3;
            $data['featuredPackages4'] = $featuredpackages4;
            $data['featuredPackages5'] = $featuredpackages5;
            $data['featuredPackages6'] = $featuredpackages6;
            $data['rating_gig_show1']=$show_rating1;
            $data['rating_gig_show2']=$show_rating2;
            $data['rating_gig_show3']=$show_rating3;
            $data['rating_gig_show4']=$show_rating4;
            $data['rating_gig_show5']=$show_rating5;
            $data['rating_gig_show6']=$show_rating6;
            $data['rating_gig_show7']=$show_rating7;
            $data['rating_gig_show8']=$show_rating8;
            $data['rating_gig_show9']=$show_rating9;
            $data['rating_gig_show10']=$show_rating10;
            $data['rating_gig_show11']=$show_rating11;
            $data['rating_gig_show12']=$show_rating12;
            $data['rating_gig_show13']=$show_rating13;
            $data['rating_gig_show14']=$show_rating14;
            $data['gig']     = $gig;
            $data['images']     = $imgages;
            $data['headings']     = $headings;
            return view('pages.home')->with($data);
        }



    public function agencyContact(Request $request){

//        if($request->has('submit')){
//            $vaidationData = [
//                'username' => $request->input('username'),
//                'email'    => $request->input('email'),
//                'password' => $request->input('password'),
//                'password_confirmation' => $request->input('password_confirmation'),
//            ];
//            $ValidationRules = [
//                'username' => 'unique:users',
//                'email'    => 'required|email|unique:users|max:255',
//                'password' => 'required|min:8|confirmed:password_confirmation',
//            ];
//
//            $validator = Validator::make($vaidationData, $ValidationRules);
//            if($validator->fails()) {
//
//                return Redirect::back()->withErrors($validator);
//
//            }
//            else {
//                $agency = User::create([
//                    'username' => $request->input('username'),
//                    /*'username' => $request->input('name'),*/
//                    'email' => $request->input('email'),
//                    'password' => Hash::make($request->input('password')),
//                    'agency_percentage' => $request->input('percent'),
//                    'type' => 'agency',
//                ]);
//
//            }
//        }
//        return view('pages.agencyRegister');
        $gigTypes = Gigtype::where(['status' => 'enabled', 'active' => 1])->get();
        foreach ($gigTypes as $gigType) {
            $gigType['Subcategory'] = Gigtype_Subcategory::where('gigtypes_id', $gigType->id)->get();
        }
        $countries = DB::table('apps_countries')->get();
        $data['gigtypes'] = $gigTypes;
        $data['countries'] = $countries;
        return view('pages.agencyRegisterForm',$data);
    }

    public function agencyRegister(Request $request){

        $requestEmail = $request->input('varify');
        $agency_varify = DB::table('agency_inquires')->where('activation_code',$requestEmail)
            ->where('created_at','>',Carbon::now()->subHours(2))->first();
        if($agency_varify && $agency_varify->activation_status == 1) {

            $gigTypes = Gigtype::where(['status' => 'enabled', 'active' => 1])->get();
            foreach ($gigTypes as $gigType) {
                $gigType['Subcategory'] = Gigtype_Subcategory::where('gigtypes_id', $gigType->id)->get();
            }
            $countries = DB::table('apps_countries')->get();
            $data['gigtypes'] = $gigTypes;
            $data['countries'] = $countries;
            return view('pages.agencyRegisterForm', $data);
        }
        if ($request->has('submit')) {
            if($request->has('subcat')){
                if ($request->input('types') OR $request->input('subcat') OR $request->input('others')){
                  //  Session::forget('types');
                   // $types = $request->input('types');
                   // Session::put('types', $types);
                    $products[] = implode(',', $request->input('types')); //$products[]
                    if(!empty($request->input('subcat')))
                        $products[] = implode(',', $request->input('subcat'));
                    if(!empty($request->input('others')))
                        $products[]=  $request->input('others');

                    $prod = '';
                    for($i=0; $i<count($products); $i++){
                        $prod .= $products[$i].',';
                    }

                }
            }
            else {
                $prod = '';
            }
            if($request->input('fbmedia') OR $request->input('limedia') OR $request->input('gmedia') OR $request->input('tmedia')){
                $portfolio = $request->input('fbmedia');
                $portfolio .= $request->input('limedia');
                $portfolio .= $request->input('gmedia');
                $portfolio .= $request->input('tmedia');
            }
            else{
                $portfolio = '';
            }
            if ($request->hasFile('file-attachment')) {
                if ($request->file('file-attachment')->isValid()) {

                    $file = $request->file('file-attachment')->move(public_path() . '/files/agency_files/', time().$request->input('username') . $request->file('file-attachment')->getClientOriginalName());
                    $file_url = '<a target="_blank" href="' . url() . '/files/agency_files/' . $file->getFilename() . '">' .$request->input('username'). $request->file('file-attachment')->getClientOriginalName() . '</a>';
                }
            }
            else{
                $file_url = '';
            }
            $vaidationData = [
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'tel' => $request->input('tel'),
                'password_confirmation' => $request->input('password_confirmation')
            ];
            $ValidationRules = [
                'username' => 'unique:users',
                'email' => 'required|email|unique:users|max:255',
                'fname'    => 'required',
                'lname'    => 'required',
                'street'    => 'required',
                'city'    => 'required',
                'tel'    => 'required',
                'password' => 'required|min:8|confirmed:password_confirmation'
            ];
            if($request->input('sel_lang') == 'eng'){
                $messages = array(
                    'username.unique' => "Username already exist",
                    'email.required'  => "Please fill out this field",
                    'email.unique' => "Email already exist",
                    'fname.required' => "Please fill out this field",
                    'lname.required' => "Please fill out this field",
                    'street.required' => "Please fill out this field",
                    'city.required' => "Please fill out this field",
                    'tel.required' => "Please fill out this field",
                    'password.required' => "Please fill out this field",
                    'password.min' => "Minimum 8 characters required",
                    'password.confirmed' => "Password not matched",
                    'password_confirmation.required' => "Please fill out this field"
                );
                $validator = Validator::make($vaidationData, $ValidationRules,$messages);
            }else {
                $messages = array(
                    'email.required'  => "Bitte füllen Sie dieses Feld aus",
                    'fname.required' => "Bitte füllen Sie dieses Feld aus",
                    'lname.required' => "Bitte füllen Sie dieses Feld aus",
                    'street.required' => "Bitte füllen Sie dieses Feld aus",
                    'city.required' => "Bitte füllen Sie dieses Feld aus",
                    'tel.required' => "Bitte füllen Sie dieses Feld aus",
                    'password.required' => "Bitte füllen Sie dieses Feld aus",
                    'password_confirmation.required' => "Bitte füllen Sie dieses Feld aus"
                );
                $validator = Validator::make($vaidationData, $ValidationRules, $messages);
            }
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput($request->except('password'));

            } else {

                $activation = str_random(60). $request->input('email');
                $agency = User::create([
                    'username' => $request->input('username'),
                    /*'username' => $request->input('name'),*/
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'master_percent' => 45,
                    'agency_percentage' => 55,
                    'activation_code' => $activation,
                    'type' => 'agency',
                ]);
                $user_id = $agency->id;
                DB::table('agency_additional')->insert([
                    'agency_id' => $user_id,
                    'agency_name' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'language' => $request->input('ch-lang'),
                    'gender' => $request->input('gender'),
                    'f_name' => $request->input('fname'),
                    'l_name' => $request->input('lname'),
                    'street_no' => $request->input('street'),
                    'postal_code' => $request->input('post'),
                    'city' => $request->input('city'),
                    'country' => $request->input('country'),
                    'telephone' => $request->input('tel'),
                    'mobile' => $request->input('cell'),
                    'company_ragistraion_no' => $request->input('cnumber'),
                    'employees' => $request->input('emp'),
                    'skills' => $prod,
                    'attachment' => $file_url,
                    'protfolio' => $portfolio
                ]);
                $users = array('admin','agency');
                for($i = 0; $i <= 1; $i++){
                    $from='marketplace@4slash.com';
                    $sub='Partner Anfrage | 4slash';
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
                    if($users[$i] == 'admin'){
                        $data = [
                            'type'  => 'registered',
                            'user'   => 'admin',
                            'agency' => $request->input('username')
                        ];
                        $to = 'marketplace@4slash.com';
                        $message = view('agency_registration', $data)->render();

                        mail($to, $sub, $message, $headers);
                    }
                    elseif($users[$i] == 'agency'){

                        $sub = 'Partner Anfrage | 4slash';

                        $data = [
                            'type'  => 'registered',
                            'user'   => 'agency',
                            'agency' => $request->input('username'),
                            'activation_code' => $activation
                        ];

                        $to = $request->input('email');
                        $message = view('agency_registration', $data)->render();

                        if (mail($to, $sub, $message, $headers)) {
                            if($request->input('language') == "germany") {
                                return redirect()->route('tahnku')
                                    ->with('successMessage_title', 'Your registration was successful.')
                                    ->with('successMessage_subtitle', 'Welcome to the Partner Program.')
                                    ->with('successMessage_subtitle2','4slash has sent you a confirmation mail. Please verify your user account. Then you can log in with your personal data on 4slash.com');
                            }else{
                                return redirect()->route('tahnku')
                                    ->with('successMessage_title', 'Your registration was successful.')
                                    ->with('successMessage_subtitle', 'Welcome to the Partner Program')
                                    ->with('successMessage_subtitle2','4slash has sent you a verification email . Please verify your account to Log in agency Pannel');
                            }
                        } else {
                            return Redirect::back()->with('errorMessage', 'Sorry! Please try again, some errors occured');
                        }

                    }
                }
            }

        }
        else {
            return redirect()->route('agency.register');
        }

    }

//    public function sendmail(){
//
//        /*$from='marketplace@4slash.com';
//        $sub='Agency Registered';
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
//
//
//        if(mail('webcomputerguy@gmail.com','test', 'hello', $headers)){
//            echo 'sent';
//        } else {
//            echo 'not sent';
//        }*/
//
//        Mail::send('test', ['key' => 'value'], function($message)
//        {
//            $message->to('webcomputerguy@gmail.com', 'John Smith')->subject('Welcome!');
//        });
//    }


    public function propro (){

        return view('pages.profile_new');

    }

    public function pricing(){
        return view('pages.pricing');
    }

    public function contact(){
        return view('pages.contact');
    }

    public function trial(){
        return view('pages.trial');
    }

    public function customer(){
        return view('pages.customer');
    }
    public function terms(){
        return view('pages.terms');
    }
    public function press(){
        return view('pages.press');
    }
    public function partnership(){
        return view('pages.partnership');
    }
    public function privacy(){
        return view('pages.privacy');
    }

    public function thankyou(){
        return view('pages.thankyou');
    }

    public function enterprise(){
        return view('pages.enterprise_package');
    }

    public function custom(){
        return view('pages.custom_package');
    }
    public function free(Request $request){


        $userValidationData = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $userValidationRules = [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ];


        $validator = Validator::make($userValidationData, $userValidationRules);

        if ($validator->fails()) {

            return Redirect::back()->withInput($request->except('password'))->withErrors(['ErrorMessage' => 'Username or password is incorrect']);
        } elseif (Auth::user()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'user'])) {
            {
                if (Auth::user()->get()->active) {

                        return view('pages.free_package');

                } elseif (!Auth::user()->get()->active) {
                    Auth::user()->logout();
                    return redirect()->back()->withErrors(['auth' => 'Your registration has not yet been confirmed. Please confirm your registration and try again.']);
                }

         else {

            return Redirect::back()->withInput($request->except('password'))->withErrors(['ErrorMessage' => 'Username or password is incorrect ']);
        }

    }

}}



    public function freeform(Request $request){

$data['get_apps'] = $request->input('apps');

        return view('pages.free_package_form', $data);
    }
    public function essentialform(){
        return view('pages.essential_form');
    }
    public function enterpriseform(){
        return view('pages.enterprise_form');
    }
    public function featureapps(){
        return view('pages.feature_apps');
    }
    
    public function proceed_to_checkout(Request $request){
        $all = $request->all();
        $ids = array();
        $quantity = array();
        $addon = $request->input('addon');
        foreach ($addon['id'] as $data){
                array_push($ids,$data);

        }
        foreach ($addon['quantity'] as $data){
                array_push($quantity,$data);

        }
        Session::put('questions', $request->input('question'));
        $company_description = $all['company_discription'];
        Session::put('company_discription',$company_description);
        $order_gig = Session::get('order_gig');
        if(!empty($all['addon'])) {
            $addons = $all['addon'];
        }else{
            $addons = null;
        }
        $orderAddons = OrderAddon::getOrderAddons($addons);
        Session::put('order_addons', $orderAddons);

        $total_addons_amount = 0;
        foreach ($orderAddons as $orderAddon) {
            $total_addons_amount += $orderAddon->total_amount;
            Session::put('total_order_amount', ($total_addons_amount + $order_gig->price));
        }

        if (!empty($total_addons_amount)) {

            Session::put('total_order_amount', ($total_addons_amount + $order_gig->price));
        } else {
            Session::put('total_order_amount', $order_gig->price);
        }

        $totalOrderAmount = ($total_addons_amount + $order_gig->price);
        $processingFees = (($totalOrderAmount * 5) / 100);
        Session::put('order_last_amount', $totalOrderAmount + $processingFees);
        Session::put('processing_fee', $processingFees);
        $gig = Gig::where(['uuid' => $all['funnel']])->first();
        if(!empty($all['addon'])) {
            $addons = $all['addon'];
        }else{
            $addons = null;
        }
        $data['orderAddons'] = $orderAddons;
        $data['gig'] = $gig;
        if(Auth::user()->check()){
            $data['user_wallet'] = Auth::user()->get()->wallet;
        }else{
            $data['user_wallet'] = '';
        }

        return view('pages.checkout')->with($data);
    }

    public function referral_programme(){
        return view('pages.referral_programme');
    }

    public function checkEmail(Request $request)
    {

        $response = array();

        $userValidationData = [
            'email' => $request->input('email'),
        ];

        $userValidationRules = [
            'email' => 'required|email|unique:users|max:255',
        ];


        $validator = Validator::make($userValidationData, $userValidationRules);
        if ($request->ajax()) {

            if ($validator->fails()) {

                $response['error'] = true;

                if ($validator->errors()->has('email')) {
                    $response['errors']['emailError'] = true;
                    $response['errorsMessages']['emailError'] = "This Email address is already exist!";
                } else {
                    $response['errors']['emailError'] = false;
                }
                return Response::json($response);
            }else{
                $response['error'] = true;
                $user_id = Auth::user()->get()->id;
                $user_name = Auth::user()->get()->username;
                $image = Auth::user()->get()->profile_image;
                $user_image = Auth::user()->get()->username[0];
                $email  = $request->input('email');
                $check_email = DB::table('user_referral')->where(['referral_email'=>$email,'status' => 1])->orWhere(['referral_email'=>$email,'status' => 0])->get();
                if($check_email){
                    $response['errors']['emailError'] = true;
                    $response['errorsMessages']['emailError'] = "Email has been already sent to this user!";
                }else {
                    $insert = DB::table('user_referral')->insert([
                        'referral_email' => $email,
                        'user_id' => $user_id
                    ]);
                    if ($insert) {
                        $data = [
                            'referrer_username' => $user_name,
                            'image'             => $image,
                            'user_image'        => $user_image
                        ];
                        $from = 'marketplace@4slash.com';
                        $sub = '4slash Refer Invitation';
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                        $message = view('referral_email',$data)->render();
                        mail($request->input('email'), $sub, $message, $headers);
                        $response['error'] = false;
                        $response['success'] = true;
                    }
                }
                return Response::json($response);
            }

        }

    }

    public function check_promocode(Request $request){
        $promocode = $request->input('promocode');
        $promo_data = DB::table('Promocodes')->where(['promocode' => $promocode,'type' => 'free','status' => 1])->get();
        if($promo_data) {
            return $promo_data;
        }else{
            return $promo_data;
        }
    }

    private function generate_promocode(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 4; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return '4S-'.$randomString;
    }

    public function insert_promocode(){
        $promocode = $this->generate_promocode();
        $promcode_arrya = array();
        for ($i = 0 ; $i <= 100 ; $i++) {
            array_push($promcode_arrya,$this->generate_promocode());
        }
        foreach($promcode_arrya as $code){
            DB::table('Promocodes')->insert([
                'promocode' => $code,
                'amount'    => 20,
                'type'      => 'free',
            ]);
        }
    }
    
}
