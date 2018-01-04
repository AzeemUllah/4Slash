<?php

namespace App\Http\Controllers;

use App\Gig;
use App\Gigtype_Subcategory;
use Illuminate\Http\Request;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use App\Gigtype;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminGigsCategoriesController extends Controller
{

    public function index() {
        $gigs_categories = Gigtype::where('status', 'enabled')->get();

        $data['gigs_categories'] = $gigs_categories;

        $data['featured_gigs'] = Gigtype::select('id', 'name')->where('featured', 1)->get();

        return view('pages.admin.gigs_categories')->with($data);
    }

    public function getCreate(Request $request) {
        $update = false;

        if($request->input('action')) {
            if($request->input('action') == 'update') {
                $update = true;
                $data['category'] = Gigtype::find($request->input('id'));
            }
        }

        $data['update'] = $update;

        return view('pages.admin.gigs_categories_create')->with($data);
    }

    public function postCreate(Request $request) {
        $categoryName = $request->input('gigcategory-name');
        $subCategories = $request->input('subcategories');
        $categoryDisc = $request->input('gigcategory-description');
        //dd($subCategories);
        Gigtype::createNewGigType($categoryName, $subCategories, $categoryDisc, $request);
//        $gigCategory = new Gigtype();
//        $gigCategory->slug = str_replace(' ', '_', strtolower($request->input('gigcategory-name')));
//        $gigCategory->name = $request->input('gigcategory-name');
//        if($gigCategory->save())
//        {
            return redirect()->route('admingigscategories');
//        }
//        else
//        {
//            return redirect()->route('admingigscategoriescreate')->withErrors(['msg' => 'cannot create new category right now please try later.']);
//        }
    }

    public function postUpdate(Request $request) {
        $gigCategory = Gigtype::where('id', $request->input('id'))->first();
        $gigCategory->name = $request->input('gigcategory-name');
        $gigCategory->description = $request->input('gigcategory-description');
        $gigCategory->slug = preg_replace('([/ ]+)','_', strtolower($request->input('gigcategory-name')));
        $gigCategory->slug = str_replace(' ', '_', strtolower($request->input('gigcategory-name')));
        if($gigCategory->save())
        {
            return redirect()->route('admingigscategories');
        }
        else
        {
            return redirect()->route('admingigscategoriescreate')->withErrors(['msg' => 'cannot update category right now please try later.']);
        }
    }

    public function categoryUpdate(Request $request) {

        if($request->hasFile('gig-image')){

            $image = Input::file('gig-image');
            $absolute_path = '/files/gigs/images/'.$image->getClientOriginalName();
            $relative_path = public_path($absolute_path);
            Image::make($image->getRealPath())->resize(214, 160)->save($relative_path);
            Gigtype::where('id', $request->input('category-id'))->update(['image' => $image->getClientOriginalName()]);
        }

        if(Gigtype::categoryUpdate($request)) {
            return redirect()->route('admingigscategories');
        }



    }

    public function getSubCategories(Request $request) {

        $catId = $request->input('cat-id');

        $subCats = Gigtype_Subcategory::where(['gigtypes_id' => $catId])->get();

        $returnCats = [];

        foreach($subCats as $subCat) {
            $sc = ['id' => $subCat->id, 'name' => $subCat->name];
            array_push($returnCats, $sc);
        }

        return $returnCats;

    }
    public function CategoriesGigActivate(Request $request)
    {
        $gigCatId = $request->input('Cat-gig-id');

        return ['status' => Gigtype::CategoriesGigActivate($gigCatId)];
    }

    public function featuredCategory(Request $request){

        $affected_rows =  DB::table('gigtypes')->update(['featured' => 0]);


        for($i=0; $i<4; $i++){
            $affected_rows =  DB::table('gigtypes')->where('id', $_POST['cat'.$i])->update(['featured' => 1]);
        }


        if($affected_rows)
            echo '1';
        else
            echo '1';


    }





}
