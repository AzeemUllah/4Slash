<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Gigtype;
use App\Gigtype_Subcategory;

class AdminGigsCategoriesCreateController extends Controller
{
    public function index()
    {
        return view('pages.admin.gigs_categories_create');
    }

    public function create(Request $request)
    {
        $gigCategory = new Gigtype();
        $gigCategory->slug = preg_replace('([/ ]+)','_', strtolower($request->input('gigcategory-name')));
        $gigCategory->name = $request->input('gigcategory-name');
//        $gigCategory->description = $request->input('gigcategory-description');

        if($gigCategory->save())
        {
            return redirect()->route('admingigscategoriescreate');
        }
        else
        {
            return redirect()->route('admingigscategoriescreate')->withErrors(['msg' => 'cannot create new category right now please try later.']);
        }


    }
    public function active(Request $request) {
        $gigId = $request->input('gig-category-id');

        return ['status' => Gigtype::gigCategoryActivate($gigId)];
    }

    public function delete(Request $request) {
        $gigDelete = Gigtype::destroy($request->input('gig-category-id'));


        if($gigDelete > 0)
        {
            return ['deleted' => true];
        }
        else
        {
            return ['deleted' => false];
        }
    }
    public function deleteSubCategory(Request $request) {
        $subCatDelete = Gigtype_Subcategory::destroy($request->input('id'));


        if($subCatDelete > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
}