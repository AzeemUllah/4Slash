<?php

namespace App\Http\Controllers;

use App\Gig;
use App\Package;
use App\User;
use App\PackageOption;
use App\PackageType;
use Illuminate\Http\Request;
use App\Agency;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Gigtype;
use App\Gigtype_Subcategory;
use Illuminate\Support\Facades\Validator;

class AdminPackagesController extends Controller
{
    use LogTrait;
    public function index()
    {

        $packages = Package::where(['status' => 'enabled' , 'active' => 0])->orwhere(['status' => 'enabled' , 'active' => 1])->orderBy('id','desc')->get();

        foreach($packages as $package) {
            $package->type = PackageType::where(['id' => $package->packages_types_id])->first();
        }
        $data['get_activated'] = Package::where(['active' => 1,'status' => 'enabled'])->count();
        $data['get_deactivated'] = Package::where(['active' => 0,'featured' => 0, 'status' => 'enabled'])->orwhere(['active' => 0,'featured' => 1, 'status' => 'enabled'])->count();
        $data['get_featured'] = Package::where(['active' => 1,'featured' => 1, 'status' => 'enabled'])
            ->orwhere(['active' => 0,'featured' => 1, 'status' => 'disabled'])
            ->orwhere(['active' => 1,'featured' => 1, 'status' => 'disabled'])
            ->orwhere(['active' => 0,'featured' => 1, 'status' => 'enabled'])
            ->count();
        $data['packages'] = $packages;
        /*var_dump($data);
        exit;*/
        return view('pages.admin.packages')->with($data);
    }
    public function suggestedPackages()
    {

        /*if(isset($_GET['id']))
        {

            $notify = Notification::where('id',$_GET['id'])->first();
            $notify->seen = 1;
            $notify->save();


        }

        $packages = Package::where('status','disabled')->get();

        foreach($packages as $package) {
            $package->type = PackageType::where(['id' => $package->packages_types_id])->first();
        }
        foreach($packages as $package) {
            $package->agency = Agency::where(['id' => $package->suggested_by])->first();
        }
        $data['packages'] = $packages;
        return view('pages.admin.gigssuggestion')->with($data);*/
        if (isset($_GET['ref'])) {
            if (isset($_GET['id'])) {
                $notify = Notification::where('id', $_GET['id'])->first();
                $notify->seen = 1;
                $notify->save();
            }
        }

        $packages = Package::where(['status' => 'disabled'])->orderBy('created_at', 'desc')->get();
        foreach ($packages as $package) {
            $package->type = PackageType::where(['id' => $package->packages_types_id])->first();
        }
        $data['packages'] = $packages;
        return view('pages.admin.packagesuggestion')->with($data);
    }

    public function create(Request $request)
    {
        $data['update'] = false;
        if(isset($_POST['create-package']))
        {
            $admin = Auth::admin()->get();
            $packageTypeId = $request->input('package-type');
            $packageTitle = $request->input('package-title');
            $packagePrice = $request->input('package-price');
            $packageOptions = $request->input('package-option');
            try {

                DB::transaction(function () use ($packageTypeId, $packageTitle, $packagePrice, $packageOptions, $admin) {
                    $package = Package::create([
                        'packages_id' => uniqid(),
                        'title' => $packageTitle,
                        'price' => $packagePrice,
                        'packages_types_id' => $packageTypeId,
                        'user_id' => $admin->id,
                        'status' => 'enabled'
                    ]);
                    if($packageOptions != Null)
                    {
                    foreach ($packageOptions as $packageOption) {
                        PackageOption::create([
                            'option' => $packageOption,
                            'packages_id' => $package->id
                        ]);
                    }
                    }
                });


                return redirect()->route('adminpackages');
            } catch(\Exception $e) {
                dd($e);
            }
        }


        $packagesTypes = PackageType::all();

        $data['packagestypes'] = $packagesTypes;
        $categories = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
        // $data['subCategories'] = Gigtype_Subcategory::where(['gigtypes_id' => $gig->gigtype_id])->get();

        $data['categories'] = $categories;
        $categories = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
        // $data['subCategories'] = Gigtype_Subcategory::where(['gigtypes_id' => $gig->gigtype_id])->get();

        $data['categories'] = $categories;
        $data['agency_favors'] = Gig::where(['active' => 1, 'status' => 'enabled','rejection' => 0 ,'vacation' => 0 ,'save' => 0])->get();
        return view('pages.admin.packages_create')->with($data);
    }

    public function PackageCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package-title' => 'required|max:50',
            'platinum_package_name' => 'required|max:50',
            'silver_package_name' => 'required|max:50',
            'gold_package_name' => 'required|max:50',
            'platinum_package_text' => 'required|max:300',
            'silver_package_text' => 'required|max:300',
            'gold_package_text' => 'required|max:300',
            'platinum_days' => 'required|max:10',
            'silver_days' => 'required|max:10',
            'gold_days' => 'required|max:10',
            'platinum_package_price' => 'required|max:10',
            'silver_package_price' => 'required|max:10',
            'gold_package_price' => 'required|max:10',
            'association' => 'required'
        ]);

        if ($validator->fails()) {

            if (!$request->hasFile('gig-images')) {
                SESSION::put('gig-image', 'At least one image is required');
            }

            return Redirect::back()->withInput()->withErrors($validator);
        } else if (!$request->hasFile('gig-images')) {
            SESSION::put('gig-image', 'At least one image is required');
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $suggest = $request->input('create_package');

        $agency = Auth::agency()->get();
        $packageTypeId = $request->input('package-type');
        $packageTitle = $request->input('package-title');
        $packagePrice = 10;
        $packageOptions = $request->input('package-option');
        $unique_id = uniqid();
        $images = $request->file('gig-images');
        $cat = $request->input('package-category');
        if($request->input('gig-sub-category')) {
            $subcats_id = array();
            foreach ($request->input('gig-sub-category') as $key => $subcatId) {
                $subcats_id[] = $subcatId;
            }
            $favor_id = '';
            $Subcat = implode(',', $subcats_id);
        }else{
            $favor_id = $request->input('favor_associate');
            $cat = '';
            $Subcat = '';
        }
        try {

            DB::transaction(function () use ($request,$suggest,$unique_id,$packageTitle, $packagePrice,$cat,$Subcat,$favor_id, $agency,$images,$packageOptions) {
                if($suggest){
                    $package = Package::create([
                        'packages_id' => $unique_id,
                        'title' => $packageTitle,
                        'price' => $packagePrice,
                        'packages_types_id' => $cat,
                        'packages_subtypes_id' => $Subcat,
                        'favor_id' => $favor_id,
                        'user_id' => $agency->id,
                        'suggested_by' => $agency->id,
                        'status' => 'disabled',
                    ]);
                }else{
                    $package = Package::create([
                        'packages_id' => $unique_id,
                        'title' => $packageTitle,
                        'price' => $packagePrice,
                        'packages_types_id' => $cat,
                        'packages_subtypes_id' => $Subcat,
                        'favor_id' => $favor_id,
                        'user_id' => $agency->id,
                        'suggested_by' => $agency->id,
                        'status' => 'disabled',
                        'save'  => 1
                    ]);
                }
                $silver_package_name = $request->input('silver_package_name');
                $gold_package_name = $request->input('gold_package_name');
                $platinum_package_name = $request->input('platinum_package_name');
                $silver_package_text = $request->input('silver_package_text');
                $gold_package_text = $request->input('gold_package_text');
                $platinum_package_text = $request->input('platinum_package_text');
                $silver_days = $request->input('silver_days');
                $gold_days = $request->input('gold_days');
                $platinum_days = $request->input('platinum_days');
                $silver_source = $request->input('silver_source');
                $gold_source = $request->input('gold_source');
                $platinum_source = $request->input('platinum_source');
                $silver_revision = $request->input('silver_revision');
                $gold_revision = $request->input('gold_revision');
                $platinum_revision = $request->input('platinum_revision');
                $silver_package_price = $request->input('silver_package_price');
                $gold_package_price = $request->input('gold_package_price');
                $platinum_package_price = $request->input('platinum_package_price');
                DB::table('package_silver')->insert(['package_name' => $silver_package_name,'desc' => $silver_package_text,'delivery_days' => $silver_days ,'source_file' =>$silver_source ,'revisions' => $silver_revision,'price' => $silver_package_price,'package_id' => $unique_id]);
                DB::table('package_gold')->insert(['package_name' => $gold_package_name,'desc' => $gold_package_text,'delivery_days' => $gold_days ,'source_file' =>$gold_source ,'revisions' => $gold_revision,'price' => $gold_package_price,'package_id' => $unique_id]);
                DB::table('package_bronze')->insert(['package_name' => $platinum_package_name,'desc' => $platinum_package_text,'delivery_days' => $platinum_days ,'source_file' =>$platinum_source ,'revisions' => $platinum_revision,'price' => $platinum_package_price,'package_id' => $unique_id]);
                if (count($images) > 0) {

                    foreach ($images as $image) {
                        if (!empty($image)) {
                            list($width, $height) = getimagesize($image);
                            if ($width == 750 && $height == 350) {
                                $length = 2;
                                $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                                $file_ext = '.' . $image->getClientOriginalExtension();
                                $new_name = $image->getClientOriginalName() . md5($randomString) . $file_ext;
                                $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);

                                $gigImage = new PackageOption();
                                $gigImage->image = $new_name;
                                $gigImage->package_id = $package->id;
                                $gigImage->save();
                            } else {
                                continue;
                            }
                        }
                    }
                }
                if ($packageOptions != Null) {
                    $package_option_namesilver = $request->input('package_option_namesilver');
                    $package_option_namebronze = $request->input('package_option_namebronze');
                    $package_option_namegold = $request->input('package_option_namegold');
                    $reverse = array_reverse($packageOptions);
                    foreach ($reverse as $key=>$packageOption) {

                        $silver = (array_key_exists($key,$package_option_namesilver))? '1' : '0';
                        $bronze = (array_key_exists($key,$package_option_namebronze))? '1' : '0';
                        $gold = (array_key_exists($key,$package_option_namegold))? '1' : '0';

//                            if(array_key_exists($key,$package_option_namebronze) || array_key_exists($key,$package_option_namesilver) || $package_option_namegold) {
                        DB::table('package_option')->insert([
                            'option' => $packageOption,
                            'bronze' => $bronze,
                            'silver'=>$silver,
                            'gold'=>$gold,
                            'package_id' => $package->id
                        ]);

//                            }
                    }
                }
            });
            if($suggest) {
                $from = 'marketplace@4slash.com';
                $sub = '„New suggestion | P | Agency“';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                $data = [
                    'type' => 'package',
                    'status' => 'offered',
                    'agency' => $agency->username,
                    'package' => $packageTitle
                ];
                $to = 'marketplace@4slash.com';
                $body = view('gigssuggestionMale', $data)->render();
                mail($to, $sub, $body, $headers);
                $admin = User::where('type', 'admin')->first();
                /*
                                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                                    $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('packagesSuggestion') . '?ref=notification">Neu "P" Vorschlag | Agency</a>');
                                    Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('packagesSuggestion') . '?ref=notification&id=' . $notify_id . '&&action=update&&funnel='.$unique_id.'">Neu "P" Vorschlag | Agency</a>']);
                                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('admin.package.suggestion') . '?ref=notification">New "Package" suggestion | Agency</a>');
                Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('admin.package.suggestion') . '?ref=notification&id=' . $notify_id . '&&action=update&&funnel='.$unique_id.'">New "Package" suggestion | Agency</a>']);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return redirect()->route('suggestedpackages')->with('succ_msg_pack', 'Thank you for your package suggestion! We will check your offer!');
            }else{
                return redirect()->route('suggestedpackages')->with('succ_msg_pack', 'Saved!');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function package_suggestion(Request $request){
        if($request->input('action')){
            if($request->input('action') == "update"){
                if (isset($_GET['ref'])) {
                    if (isset($_GET['id'])) {
                        $notify = Notification::where('id', $_GET['id'])->first();
                        $notify->seen = 1;
                        $notify->save();
                    }
                }
                $package_id = $request->input('funnel');
                $package = Package::where('packages_id' ,$package_id)->first();
                $data['update'] = true;
                $data['packages'] = $package;
                $categories = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
                $agency_favors = Gig::where(['suggested_by' => $package->suggested_by,'active' => 1, 'status' => 'enabled'])->get();
                $subcats_id = array();
                $id = $package->packages_subtypes_id;
                $explo = explode(',',$id);
                foreach($explo as $key=>$subcatId){
                    $subcats = Gigtype_Subcategory::where('id', $subcatId)->first();
                    if(!empty($subcats))
                        $subcats_id[] = $subcats;
                }
                $data['subcategory'] = $subcats_id;
                $data['agency_favors'] = $agency_favors;
                $data['categories'] = $categories;
                $data['packageimages'] = PackageOption::where(['package_id' => $package->id])->get();
                $data['package_bronze'] = DB::table('package_bronze')->where('package_id',$package->packages_id)->first();
                $data['package_silver'] = DB::table('package_silver')->where('package_id',$package->packages_id)->first();
                $data['package_gold'] = DB::table('package_gold')->where('package_id',$package->packages_id)->first();
                $data['package_option'] = DB::table('package_option')->where('package_id',$package->id)->orderby('id','desc')->get();
                /*$data['status'] = $status;*/
                return view('pages.admin.packages_create')->with($data);
            }
        }
        $packageId = \Illuminate\Support\Facades\Request::segment(3);
        $package = Package::where('packages_id' ,$packageId)->first();
        $data['update'] = true;
        $data['packages'] = $package;
        $categories = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
        $agency_favors = Gig::where(['suggested_by' => $package->suggested_by,'active' => 1, 'status' => 'enabled'])->get();
        $subcats_id = array();
        $id = $package->packages_subtypes_id;
        $explo = explode(',',$id);
        foreach($explo as $key=>$subcatId){
            $subcats = Gigtype_Subcategory::where('id', $subcatId)->first();
            if(!empty($subcats))
                $subcats_id[] = $subcats;
        }
        $data['subcategory'] = $subcats_id;
        $data['agency_favors'] = $agency_favors;
        $data['categories'] = $categories;
        $data['packageimages'] = PackageOption::where(['package_id' => $package->id])->get();
        $data['package_bronze'] = DB::table('package_bronze')->where('package_id',$package->packages_id)->first();
        $data['package_silver'] = DB::table('package_silver')->where('package_id',$package->packages_id)->first();
        $data['package_gold'] = DB::table('package_gold')->where('package_id',$package->packages_id)->first();
        $data['package_option'] = DB::table('package_option')->where('package_id',$package->id)->orderby('id','desc')->get();
        return view('pages.admin.packages_create')->with($data);
    }
    public function packageUpdate(Request $request, $packageId)
    {
        $packages = Package::where(['packages_id' => $packageId])->first();
        $package_type= PackageType::where(['id' => $packages->packages_types_id])->first();
        $options= PackageOption::where(['package_id' => $packages->id])->get();
//        foreach($packages as $package)
//        {
//        $packagesOptions = PackageOption::where(['packages_id' => $package->id])->first();
//        }

        if(empty($options))
            $data['button'] = true;

        $data['update'] = true;
        $data['package_type'] = $package_type;
        $data['packages'] =   $packages;

       $data['options'] = $options;
        return view('pages.admin.packages_create', $data);

    }
    /*public function putPackageUpdate(Request $request) {

        $package = Package::where(['id' => $request->input('package_id')])->first();
        $package->packages_types_id = $request->input('package-type');
        $package->title = $request->input('package-title');
        $package->price = $request->input('package-price');
        $package->save();
      //  $package_options = $request->input('package-option');


      for($i =0; $i < count($request->input('package-option')); $i++)
      {
          if($request->input('option-id'.$i) > 0) {

              PackageOption::where(['id' => $request->input('option-id' . $i)])->update(['option' => $_POST['package-option'][$i]]);
          }

          else
          {
              PackageOption::insert(['packages_id' =>  $package->id,'option' => $_POST['package-option'][$i]]);
          }
      }
          return redirect()->route('adminpackages');

    }*/
    public function putPackageUpdate(Request $request) {
        if($request->input('action')){
            if($request->input('action') == "update"){
                $suggest = $request->input('update-package');
                $package_id = $request->input('package_id');
                $agency = Agency::where('id',$request->input('agency_id'));
                $packageTitle = $request->input('package-title');
                $packagedesc = $request->input('package-discription');
                $packagePrice = 10;
                $packageOptions = $request->input('package-option');
                $unique_id = uniqid();
                $images = $request->file('gig-images');
                $pack_number = $request->input('package_id');
                if(!empty($request->input('package-category'))) {
                    $cat = $request->input('package-category');
                    if($request->input('gig-sub-category')) {
                        $subcats_id = array();
                        foreach ($request->input('gig-sub-category') as $key => $subcatId) {
                            $subcats_id[] = $subcatId;
                        }
                        $favor_id = '';
                        $Subcat = implode(',', $subcats_id);
                    }else{
                        $favor_id = $request->input('favor_associate');
                        $cat = '';
                        $Subcat = '';
                    }
                }else{
                    $favor_id = $request->input('favor_associate');
                    $gig = Gig::where('id',$request->input('favor_associate'))->first();
                    $cat = $gig->gigtype_id;
                    $Subcat = $gig->gigtypes_subcategories_id;
                }
                $validator = Validator::make($request->all(), [
                    'package-title' => 'required|max:50',
                    'platinum_package_name' => 'required|max:50',
                    'silver_package_name' => 'required|max:50',
                    'gold_package_name' => 'required|max:50',
                    'platinum_package_text' => 'required|max:300',
                    'silver_package_text' => 'required|max:300',
                    'gold_package_text' => 'required|max:300',
                    'platinum_days' => 'required|max:10',
                    'silver_days' => 'required|max:10',
                    'gold_days' => 'required|max:10',
                    'platinum_package_price' => 'required|max:10',
                    'silver_package_price' => 'required|max:10',
                    'gold_package_price' => 'required|max:10',
                    'association' => 'required'
                ]);

                try {

                    DB::transaction(function () use ($request,$suggest,$packagedesc,$pack_number,$package_id,$unique_id,$packageTitle, $packagePrice,$cat,$Subcat,$favor_id, $agency,$images,$packageOptions) {
                        if($suggest) {
                            $package_update = DB::table('packages')->where('packages_id', $package_id)->update([
                                'title' => $packageTitle,
                                'pack_desc' => $packagedesc,
                                'price' => $packagePrice,
                                'packages_types_id' => $cat,
                                'packages_subtypes_id' => $Subcat,
                                'favor_id' => $favor_id,
                                'status' => 'enabled',
                                'save'   => 0
                            ]);
                        }else{
                            $package_update = DB::table('packages')->where('packages_id', $package_id)->update([
                                'title' => $packageTitle,
                                'pack_desc' => $packagedesc,
                                'price' => $packagePrice,
                                'packages_types_id' => $cat,
                                'packages_subtypes_id' => $Subcat,
                                'favor_id' => $favor_id,
                            ]);
                        }
                        $silver_package_name = $request->input('silver_package_name');
                        $gold_package_name = $request->input('gold_package_name');
                        $platinum_package_name = $request->input('platinum_package_name');
                        $silver_package_text = $request->input('silver_package_text');
                        $gold_package_text = $request->input('gold_package_text');
                        $platinum_package_text = $request->input('platinum_package_text');
                        $silver_days = $request->input('silver_days');
                        $gold_days = $request->input('gold_days');
                        $platinum_days = $request->input('platinum_days');
                        $silver_source = $request->input('silver_source');
                        $gold_source = $request->input('gold_source');
                        $platinum_source = $request->input('platinum_source');
                        $silver_revision = $request->input('silver_revision');
                        $gold_revision = $request->input('gold_revision');
                        $platinum_revision = $request->input('platinum_revision');
                        $silver_package_price = $request->input('silver_package_price');
                        $gold_package_price = $request->input('gold_package_price');
                        $platinum_package_price = $request->input('platinum_package_price');
                        DB::table('package_silver')->where('package_id',$pack_number)->update(['package_name' => $silver_package_name,'desc' => $silver_package_text,'delivery_days' => $silver_days ,'source_file' =>$silver_source ,'revisions' => $silver_revision,'price' => $silver_package_price]);
                        DB::table('package_gold')->where('package_id',$pack_number)->update(['package_name' => $gold_package_name,'desc' => $gold_package_text,'delivery_days' => $gold_days ,'source_file' =>$gold_source ,'revisions' => $gold_revision,'price' => $gold_package_price]);
                        DB::table('package_bronze')->where('package_id',$pack_number)->update(['package_name' => $platinum_package_name,'desc' => $platinum_package_text,'delivery_days' => $platinum_days ,'source_file' =>$platinum_source ,'revisions' => $platinum_revision,'price' => $platinum_package_price]);
                        if (count($images) > 0) {

                            foreach ($images as $image) {
                                if (!empty($image)) {
                                    list($width, $height) = getimagesize($image);
                                    if ($width == 750 && $height == 350) {
                                        $length = 2;
                                        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                                        $file_ext = '.' . $image->getClientOriginalExtension();
                                        $new_name = $image->getClientOriginalName() . md5($randomString) . $file_ext;
                                        $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);

                                        $gigImage = new PackageOption();
                                        $gigImage->image = $new_name;
                                        $gigImage->package_id = $package_id->id;
                                        $gigImage->save();
                                    } else {
                                        continue;
                                    }
                                }
                            }
                        }
                        if ($packageOptions != Null) {
                            $package_option_namesilver = $request->input('package_option_namesilver');
                            $package_option_namebronze = $request->input('package_option_namebronze');
                            $package_option_namegold = $request->input('package_option_namegold');
                            $reverse = array_reverse($packageOptions);
                            foreach ($reverse as $key=>$packageOption) {
                                /*var_dump($request->input('option_id'));*/

                                $silver = (array_key_exists($key,$package_option_namesilver))? '1' : '0';
                                $bronze = (array_key_exists($key,$package_option_namebronze))? '1' : '0';
                                $gold = (array_key_exists($key,$package_option_namegold))? '1' : '0';

//                            if(array_key_exists($key,$package_option_namebronze) || array_key_exists($key,$package_option_namesilver) || $package_option_namegold) {
                                DB::table('package_option')->where('package_id',$package_id)->update([
                                    'option' => $packageOption,
                                    'bronze' => $bronze,
                                    'silver'=>$silver,
                                    'gold'=>$gold,
                                ]);
//                            }
                            }
                            /*exit;*/
                        }
                    });
                    if($suggest) {
                        return redirect()->route('adminpackages')->with('succ_msg_pack', 'Thank you for your package suggestion! We will check your offer!');
                    }else{
                        return redirect()->back()->with('succ_msg_pack', 'Saved!');
                    }
//            return redirect()->route('suggestedpackages')->with('succ_msg_pack', 'Vielen Dank für Ihren package Vorschlag! Wir werden Ihr Angebot prüfen!');
                } catch (\Exception $e) {
                    dd($e);
                }
            }
        }

    }

    public function singlePackage(Request $request){


        $gig = Package::where('id', $request->input('gig_id'))->first();

        return response()->json($gig);
        //json_encode($gig);
    }

    public function undoPackage(Request $request){

        $gig_id = $request->input('gig_id');

        $affected_rows = Package::where('id', $gig_id)->update(['status' => 'enabled','active' => 1]);

        if($affected_rows)
            echo '1';
        else
            echo '0';

    }

    public function PackageAccept(Request $request, $packageId)
    {
        /*$packageId = $request->input('package-id');*/
        $package = Package::where('id', $packageId)->first();
        $agency = User::where('id', $package->suggested_by)->first();
        $accepted = $package->update(['status' => 'enabled']);
        if($accepted){
            $from='marketplace@4slash.com';
            $sub='Package accept | Agency | 4slash';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
            $data = [
                'type'   => 'package',
                'status'  => 'accepted',
                'user'     => $agency->username,
                'gig'      => $package->title,
            ];
            $to = $agency->email;
            $body = view('gigssuggestionMale', $data)->render();
            mail($to,$sub,$body,$headers);
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $notify_id = Notification::sendnotification('', $agency->id,'<a href="'.route('suggestedpackages').'?ref=notification">New "Package" Suggestion | Agency</a>');
            Notification::where('id', $notify_id)->update(['message' =>'<a href="'.route('suggestedpackages').'?ref=notification&id='.$notify_id.'">New "Package" Suggestion | Agency</a>']);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        }
        return redirect()->route('packagesSuggestion')->with('succ_msg_pack', 'Saved!');
    }

    public function PackageReject(Request $request)
    {
        $packageId = $request->input('package_id');
        $package = Package::where('id', $packageId)->first();
        $reason = $request->input('reject_reason');
        /*var_dump($reason);
        exit;*/
        $agency = User::where('id', $package->suggested_by)->first();
        $accepted = $package->update(['status' => 'rejected']);
        $reject_data = DB::table('package_reject_reason')->insert([
            'reason' => $reason,
            'created_at' => date('y-m-d H:i:s'),
            'package_id'   => $packageId
        ]);
        if($accepted){
            $from='marketplace@4slash.com';
            $sub='Package rejected | Agency | 4slash';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
            $data = [
                'type'   => 'package',
                'status'  => 'accepted',
                'reason'  => $reason,
                'user'     => $agency->username,
                'package'      => $package->title,
            ];
            $to = $agency->email;
            $body = view('rejection_package', $data)->render();
            mail($to,$sub,$body,$headers);
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $notify_id = Notification::sendnotification('', $agency->id,'<a href="'.route('suggestedpackages').'?ref=notification">New "Package" Suggestion | Agency</a>');
            Notification::where('id', $notify_id)->update(['message' =>'<a href="'.route('suggestedpackages').'?ref=notification&id='.$notify_id.'">New "Package" Suggestion | Agency</a>']);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        }
        return ['status' => $accepted];
    }

    public function packageoption(Request $request)
    {

        $PackageOption = PackageOption::where('id',$request->input('gigoptionid'))->delete();
        //$gigAddon->delete;
        return ['result' => $PackageOption];
    }

    public function removepackageImages(Request $request)
    {
        return ['result' => PackageOption::removePackageImage($request->input('packageimage_id'))];

    }

    public function delete(Request $request)
    {
        /*$pakage = Package::destroy($request->input('package_id'));
        if($pakage){
            return 1;
        }else{
            return 0;
        }*/
        $package_id = $request->input('package_id');
        $check_pending_orders = Package::where(['packages_id' => $package_id, 'status' => 'pending'])->first();
        if(count($check_pending_orders) > 0){
            return ['has_pending' => 'Sorry this favor has pending orders to complete!'];
        }
        else{
            $affected_rows = Package::where('packages_id', $package_id)->update(['status' => 'disabled','active'=> 0,'save' => 1]);

            if($affected_rows)
                echo '1';
            else
                echo '0';
        }

    }

    public function packageActivate(Request $request)
    {
        $admin = Auth::admin()->get();
        $message = 'Change favor status';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $gigId = $request->input('package-id');

        return ['status' => Package::packageActivate($gigId)];
    }

    public function packageFeatured(Request $request) {
        $admin = Auth::admin()->get();
        $message = 'set favor featured';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $package = $request->input('package-id');

        return ['status' => Package::packageFeatured($package)];
    }

    public function trashpackages(){
        $packages = Package::where(['status' => 'disabled','active'=> 0])->orderBy('created_at', 'desc')->get();
        $data['packages'] = $packages;
        return view('pages.admin.trashpackages')->with($data);
    }

}