<?php

namespace App\Http\Controllers;

use App\Package;
use App\PackageOption;
use App\PackageType;
use Guzzle\Http\Message\Response;
use Illuminate\Http\Request;
use App\FavouriteGigs;
use App\FavouritePackages;
use App\Http\Requests;
use App\Gig;
use App\Gigtype;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PackagesController extends Controller
{
    public function index(Request $request) {
        $package_title = $request->input('package_name');
        $package_id = $request->input('package_id');
        $package = Package::where('id' , $package_id)->first();
        $categorypackages = Package::getCategoryPackages($package->packages_types_id);
        $pack_fav_id = DB::table('gigs')->where('id',$package->favor_id)->first();
        if(!empty($pack_fav_id)) {
            $fav_cat = Gigtype::where('id', $pack_fav_id->gigtype_id)->first();
        }
        foreach ($categorypackages as $featuredPackag) {

            $featuredPackag['thumbnail'] = PackageOption::getPackageThumbnail($featuredPackag->id);
            $featuredPackag['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredPackag->packages_id)->first();
            /*var_dump($data['package_bronze']);
            exit;*/
            $featuredPackag['package_silver'] = DB::table('package_silver')->where('package_id',$featuredPackag->packages_id)->first();
            $featuredPackag['package_gold'] = DB::table('package_gold')->where('package_id',$featuredPackag->packages_id)->first();
            $featuredPackag['package_option'] = DB::table('package_option')->where('package_id',$featuredPackag)->orderBy('id','desc')->get();


        }
        $data['package'] = Package::where(['id' => $package_id])->first();
        $data['package_images'] = DB::table('package_images')->where('package_id',$package->id)->get();
        $data['package_bronze'] = DB::table('package_bronze')->where('package_id',$package->packages_id)->first();
        /*var_dump($data['package_bronze']);
        exit;*/
        $gigTypee = Gigtype::where('id', $package->packages_types_id)->first();
        if(!empty($pack_fav_id)) {
            $gig_cat_Typee = Gigtype::where('id', $pack_fav_id->gigtype_id)->first();
            $data['package_cat_type'] = $gig_cat_Typee;
        }
        $data['packagetype'] = $gigTypee;
        $data['categorypackages'] = $categorypackages;
        $data['package_silver'] = DB::table('package_silver')->where('package_id',$package->packages_id)->first();
        $data['package_gold'] = DB::table('package_gold')->where('package_id',$package->packages_id)->first();
        $data['package_option'] = DB::table('package_option')->where('package_id',$package_id)->orderBy('id','desc')->get();
        return view('pages.packages')->with($data);
    }

    public function single_package(Request $request , $packageId){
        $user = Auth::user()->get();
        $data['user'] = $user;
        $package_id = $packageId;
        $package = Package::where('id' , $package_id)->first();
        $categorypackages = Package::getCategoryPackages($package->packages_types_id);
        foreach ($categorypackages as $featuredPackag) {

            $featuredPackag['thumbnail'] = PackageOption::getPackageThumbnail($featuredPackag->id);
            $featuredPackag['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredPackag->packages_id)->first();
            /*var_dump($data['package_bronze']);
            exit;*/
            $featuredPackag['package_silver'] = DB::table('package_silver')->where('package_id',$featuredPackag->packages_id)->first();
            $featuredPackag['package_gold'] = DB::table('package_gold')->where('package_id',$featuredPackag->packages_id)->first();
            $featuredPackag['package_option'] = DB::table('package_option')->where('package_id',$featuredPackag)->orderBy('id','desc')->get();


        }
        if(Auth::user()->check()) {
            $favourite = FavouritePackages::where(['user_id' => $user->id, 'package_id' => $package->id])->first();

            if (is_object($favourite)) {
                $package['favourite'] = 'collected';
                $data['my_fav'] = true;
            } else {
                $package['favourite'] = '';
                $data['my_fav'] = false;
            }

        }
        $gigTypee = Gigtype::where('id', $package->packages_types_id)->first();
        $data['packagetype'] = $gigTypee;
        $data['package'] = Package::where(['id' => $package_id])->first();
        $data['categorypackages'] = $categorypackages;
        /*var_dump($categorypackages);
        exit;*/
        $data['package_images'] = DB::table('package_images')->where('package_id',$package->id)->get();
        $data['package_bronze'] = DB::table('package_bronze')->where('package_id',$package->packages_id)->first();
        /*var_dump($data['package_bronze']);
        exit;*/
        $data['package_silver'] = DB::table('package_silver')->where('package_id',$package->packages_id)->first();
        $data['package_gold'] = DB::table('package_gold')->where('package_id',$package->packages_id)->first();
        $data['package_option'] = DB::table('package_option')->where('package_id',$package_id)->orderBy('id','desc')->get();
        return view('pages.packages')->with($data);
    }

    public function favourite(Request $request) {

        $user = Auth::user()->get();


        if($request->input('action') == 'addToFavorite') {
            FavouritePackages::insert(['user_id' => $user->id, 'package_id' => $request->input('gig-id'), 'created_at' => date('Y-m-d H:m:i'), 'updated_at' => date('Y-m-d H:m:i')]);
            $data = 1;
        }
        else {
            FavouritePackages::where(['package_id' => $request->input('gig-id'), 'user_id' => $user->id])->delete();
            $data = 0;
        }

        return $data;
    }
    
    /*when ajax call get single package details when click on package type in package page*/
    public function get_single_pakcage_details(Request $request){
        $package_id = $request->input('package_id');
        $package_type = $request->input('package_type');
        if($package_type == "bronze"){
            $package_data = DB::table('package_bronze')->where('id',$package_id)->first();
            return response()->json($package_data);
        }elseif ($package_type == "silver"){
            $package_data = DB::table('package_silver')->where('id',$package_id)->first();
            return response()->json($package_data);
        }else{
            $package_data = DB::table('package_gold')->where('id',$package_id)->first();
            return response()->json($package_data);
        }
    }
}