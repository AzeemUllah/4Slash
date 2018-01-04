<?php

namespace App\Http\Controllers;

use App\Gigtype_Subcategory;
use App\Order;
use App\Package;
use App\PackageOption;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FavouriteGigs;
use App\Gigtype;
use App\Gig;
use App\GigImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Str;

class GigsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if($request->get('search')) {
            $query = "(title LIKE '%". $request->input('search') ."%' AND active=1 AND vacation=0) OR (title LIKE '%". explode(' ', $request->input('search'))[0] ."%' AND active=1 AND vacation=0) OR (title LIKE '%". $request->input('search') ."%' AND active=3 AND vacation=0) OR (title LIKE '%". explode(' ', $request->input('search'))[0] ."%' AND active=3 AND vacation=0)";
            $query_package = "(title LIKE '%". $request->input('search') ."%' AND active=1 AND vacation=0) OR (title LIKE '%". explode(' ', $request->input('search'))[0] ."%' AND active=1 AND vacation=0) OR (title LIKE '%". $request->input('search') ."%' AND active=3 AND vacation=0) OR (title LIKE '%". explode(' ', $request->input('search'))[0] ."%' AND active=3 AND vacation=0)";

            $gigs = Gig::take(12)->whereRaw($query)->get();

            $packages = Package::take(12)->whereRaw($query_package)->get();
        }
        else {
            $gigs = Gig::where(['active' => 1])->take(12)->get();
            $packages = Package::where(['active' => 1])->take(12)->get();
        }



        $store_thumbs = [];
        foreach($gigs as $gig) {
            $store_thumbs[$gig->id] = GigImages::getGigThumbnail($gig->id);
            //$gig['thumbnail'] = GigImages::getGigThumbnail($gig->id);
            $gig['gigType'] = Gigtype::where('id', $gig->gigtype_id)->first();
        }
        foreach ($packages as $featuredpackage){
            $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
            $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
            $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
            $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
        }
        $data['thumbs'] = $store_thumbs;
        $data['gigs'] = $gigs;
        $data['packages'] = $packages;
        return view('pages.gigs_without_login')->with($data);

    }

    public function gigsByType(Request $request, $gigType) {
        $gigType = Gigtype::where(['slug', $gigType])->first();
        $data['user'] = Auth::user()->get();
        $data['gigType'] = $gigType;
        $data['gigs'] = Gig::where(['gigtype_id' => $gigType->id, 'active' => 1, 'status' => 'enabled','vacation'=> 0])->owhere(['gigtype_id' => $gigType->id, 'active' => 3,'status' => 'enabled','vacation' => 0])->get();
        return view('pages.gigs')->with($data);
    }

    public function getGigsByCategory($categorySlug) {
        $show_rating=0;
        $gigType = Gigtype::where('slug', $categorySlug)->first();
        $gigs = Gig::where(['gigtype_id' => $gigType->id, 'active' => 1,'status' => 'enabled','vacation' => 0])->orwhere(['gigtype_id' => $gigType->id, 'active' => 3,'status' => 'enabled', 'vacation' => 0])->orderBy('featured', 'desc')->get();
        $packages = Package::where(['packages_types_id' => $gigType->id, 'active' => 1,'status' => 'enabled','vacation' => 0])->orwhere(['packages_types_id' => $gigType->id, 'active' => 3,'status' => 'enabled','vacation' => 0])->orderBy('featured', 'desc')->get();
        $user = Auth::user()->get();
        $store_thumbs = [];
        $package_thumbs = [];
        $sales_count  = [];
        foreach($gigs as $gig) {
            $store_thumbs[$gig->id] = GigImages::getGigThumbnail($gig->id);
            //$gig['thumbnail'] = GigImages::getGigThumbnail($gig->id);
            $gig['gigType'] = Gigtype::where('id', $gig->gigtype_id)->first();
            
            $sales_count[$gig->id] = Order::where(['gig_id' => $gig->id])->count();
            if($user){
                $favouriteGig = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $gig->id])->first();



                if(is_object($favouriteGig)) {
                    $gig['favourite'] = ' collected';
                    $gig['my_fav'] = true;
                } else {
                    $gig['favourite'] = '';
                    $gig['my_fav'] = false;
                }
            }
                $rating = DB::table('order_feedback')->where('gig_id',$gig->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating = $avg_rate/$count_avg_rows;
                    $gig['show_rating'] = round($show_rating,1) ;
                }
                else{
                    $gig['show_rating'] = 0;
                }
        }

        foreach ($packages as $featuredpackage){
            $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
            $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
            $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
            $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
            if($user){
                $favouriteGig = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $featuredpackage->id])->first();



                if(is_object($favouriteGig)) {
                    $featuredpackage['favourite'] = ' collected';
                    $featuredpackage['my_fav'] = true;
                } else {
                    $featuredpackage['favourite'] = '';
                    $featuredpackage['my_fav'] = false;
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating = $avg_rate/$count_avg_rows;
                    $gig['show_rating'] = round($show_rating,1) ;
                }
                else{
                    $gig['show_rating'] = 0;
                }
            }
        }

        $data['sales_count'] = $sales_count;
        $data['thumbs'] = $store_thumbs;
        $data['pacakge_thumbs'] = $package_thumbs;
        $data['gigType'] = $gigType;
        $data['gigs'] = $gigs;
        $data['packages'] = $packages;
        return view('pages.gigs_without_login')->with($data);
    }

    public function getPackagesByCategory($categorySlug) {
        $gigType = Gigtype::where('slug', $categorySlug)->first();
        $packages = Package::where(['packages_types_id' => $gigType->id, 'active' => 1,'status' => 'enabled','vacation' => 0])->orwhere(['packages_types_id' => $gigType->id, 'active' => 3,'status' => 'enabled','vacation' => 0])->orderBy('featured', 'desc')->get();
        $user = Auth::user()->get();
        $store_thumbs = [];
        $package_thumbs = [];
        $sales_count  = [];

        foreach ($packages as $featuredpackage){
            $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
            $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
            $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
            $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
        }

        $data['sales_count'] = $sales_count;
        $data['thumbs'] = $store_thumbs;
        $data['pacakge_thumbs'] = $package_thumbs;
        $data['gigType'] = $gigType;
        $data['packages'] = $packages;

        return view('pages.packages_without_login')->with($data);
    }

    public function getGigsBySubCategory($catSlug, $subCatSlug) {




        $gigType = Gigtype::where(['slug' => $catSlug])->first();
        $gigtype_subCat = Gigtype_Subcategory::where(['slug' => $subCatSlug, 'gigtypes_id' => $gigType->id])->first();

        $gigs = Gig::where(['gigtype_id' => $gigType->id,'active' =>1,'status' => 'enabled','vacation' => 0])->orwhere(['gigtype_id' => $gigType->id, 'active' => 3,'status' => 'enabled','vacation'=> 0])->get();

        $new_data = [];
        $new_data_pack = [];
        $store_thumbs = [];
        $sales_count  = [];
        $user = Auth::user()->get();
            foreach($gigs as $gig) {
                if(strpos($gig->gigtypes_subcategories_id, ",")) {
                    $exp_id = explode(",", $gig->gigtypes_subcategories_id);
                    if (in_array($gigtype_subCat->id, $exp_id)) {
                        array_push($new_data, $gig);
                        $store_thumbs[$gig->id] = GigImages::getGigThumbnail($gig->id);
                        $gig['gigType'] = Gigtype::where('id', $gig->gigtype_id)->first();
                        $rating = DB::table('order_feedback')->where('gig_id',$gig->id)->get();
                        $count_avg_rows = count($rating);
                        $avg_rate = 0;


                        foreach($rating as $rate){
                            $avg_rate += $rate->order_feedback;
                        }
                        if($avg_rate>0)
                        {
                            $show_rating = $avg_rate/$count_avg_rows;
                            $gig['show_rating'] = round($show_rating,1) ;
                        }
                        else{
                            $gig['show_rating'] = 0;
                        }

                        if($user){
                            $favouriteGig = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $gig->id])->first();



                            if(is_object($favouriteGig)) {
                                $gig['favourite'] = ' collected';
                                $gig['my_fav'] = true;
                            } else {
                                $gig['favourite'] = '';
                                $gig['my_fav'] = false;
                            }
                        }

                    }
                }else{
                    if($gig->gigtypes_subcategories_id == $gigtype_subCat->id){
                        array_push($new_data, $gig);
                        $store_thumbs[$gig->id] = GigImages::getGigThumbnail($gig->id);
                        $gig['gigType'] = Gigtype::where('id', $gig->gigtype_id)->first();
                        $rating = DB::table('order_feedback')->where('gig_id',$gig->id)->get();
                        $count_avg_rows = count($rating);
                        $avg_rate = 0;


                        foreach($rating as $rate){
                            $avg_rate += $rate->order_feedback;
                        }
                        if($avg_rate>0)
                        {
                            $show_rating = $avg_rate/$count_avg_rows;
                            $gig['show_rating'] = round($show_rating,1) ;
                        }
                        else{
                            $gig['show_rating'] = 0;
                        }
                    }
                    if(Auth::user()->check()){
                        $favouriteGig = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $gig->id])->first();



                        if(is_object($favouriteGig)) {
                            $gig['favourite'] = ' collected';
                            $gig['my_fav'] = true;
                        } else {
                            $gig['favourite'] = '';
                            $gig['my_fav'] = false;
                        }
                    }
                }
                $sales_count[$gig->id] = Order::where(['gig_id' => $gig->id])->count();
            }
        $packages = Package::where(['packages_types_id' => $gigType->id,'active' =>1,'status' => 'enabled','vacation' => 0])->orwhere(['packages_types_id' => $gigType->id, 'active' => 3,'status' => 'enabled','vacation' => 0])->get();

            foreach ($packages as $featuredpackage){
                if(strpos($featuredpackage->packages_subtypes_id, ",")) {
                    $exp_id = explode(",", $featuredpackage->packages_subtypes_id);
                    if (in_array($gigtype_subCat->id, $exp_id)) {
                        array_push($new_data_pack, $featuredpackage);
                        $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                        $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                        $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                        $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                    }
                }else{
                    if($featuredpackage->packages_subtypes_id == $gigtype_subCat->id){
                        array_push($new_data_pack, $featuredpackage);
                        $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
                        $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
                        $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
                        $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
                    }
                }
            }
        $data['thumbs'] = $store_thumbs;
        $data['gigs'] = $new_data;

        $data['gigType'] = $gigType;
//        var_dump($data['gigType']);
//        exit;
//        $data['gigs'] = $gigs;
        $data['gigtype_subCat'] = $gigtype_subCat;
        $data['sales_count'] = $sales_count;
        $data['packages'] = $new_data_pack;

        return view('pages.gigs_without_login')->with($data);
    }

}
