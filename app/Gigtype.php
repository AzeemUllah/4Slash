<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use RecursiveIterator;


class Gigtype extends Model
{
    protected $fillable = ['slug', 'name', 'description'];

    public static function createNewGigType($gigTypeName = "", array $gigTypeSubcategoriesName = null, $gigTypeSubcategoriesDes = "", $request) {

        if($request->hasFile('gig-image')){

            $image = $request->file('gig-image');
            $image->move(public_path('files/gigs/images/'), $image->getClientOriginalName());
            $image = $image->getClientOriginalName();
        }
        else{
            $image = null;
        }

        $gigCategory = new Gigtype();
        $gigCategory->slug = preg_replace('([/\s]+)','_', strtolower($gigTypeName));
        $gigCategory->name = $gigTypeName;
        $gigCategory->description = $gigTypeSubcategoriesDes;
        $gigCategory->image = $image;
        $gigCategory->save();

        if($gigTypeSubcategoriesName != null) {
            if(is_array($gigTypeSubcategoriesName)) {
                foreach($gigTypeSubcategoriesName as $gigTypeSubcategoryName) {
                    $gigTypeSubcategory = new Gigtype_Subcategory();
                    $gigTypeSubcategory->slug = preg_replace('([/\s]+)','_', strtolower($gigTypeSubcategoryName));
                    $gigTypeSubcategory->name = $gigTypeSubcategoryName;
                    $gigTypeSubcategory->gigtypes_id = $gigCategory->id;
                    $gigTypeSubcategory->save();
                }
            }
        }
    }

    public static function categoryUpdate($request) {

        $catId      = $request->input('category-id');
        $catName    = $request->input('category-name');
        $catDisc    = $request->input('gigcategory-description');
        $subCats    = $request->input('subcategories');
        $subCatsid    = $request->input('subcategoriesid');
        if($request->hasFile('gig-image')){

            $image = $request->file('gig-image');
            $image->move(public_path('files/gigs/images/'), $image->getClientOriginalName());
            $image = $image->getClientOriginalName();
        }
        else{
            $image = null;
        }



        $result = DB::transaction(function () use ($catId, $catName, $subCats, $catDisc, $image, $subCatsid, $request) {

            try {

                $cat = self::where(['id' => $catId])->first();
                $cat->name = $catName;
                $cat->description = $catDisc;
                $cat->image = $image;
                $cat->slug = preg_replace('([/\s]+)','_', strtolower($catName));
                $cat->save();
                for($i =0; $i < count($request->input('subcategories')); $i++)
                {
                    if(($request->input('subcategoriesid'.$i)) > 0) {
                        Gigtype_Subcategory::where(['id' => ($request->input('subcategoriesid'.$i))])->update([
                            'slug' => preg_replace('([/\s]+)', '_', strtolower($request->input('subcategories')[$i])),
                            'name' => $request->input('subcategories')[$i],
                            'gigtypes_id' => $cat->id
                        ]);
                    }

                    else
                    {
                        $subCategory = new Gigtype_Subcategory();
                        $subCategory->slug = str_replace(' ', '_', strtolower($request->input('subcategories')[$i]));
                        $subCategory->name = $request->input('subcategories')[$i];
                        $subCategory->gigtypes_id = $cat->id;
                        $subCategory->save();
                    }
                }
//                if ($subCats) {
//
//                            foreach($subCats as $subCat ){
//
//                                    $subCategory = new Gigtype_Subcategory();
//                                    $subCategory->slug = str_replace(' ', '_', strtolower($subCat));
//                                    $subCategory->name = $subCat;
//                                    $subCategory->gigtypes_id = $cat->id;
//                                    $subCategory->save();
//
//
//
//                            }
//
//                    }



                 return true;

            } catch(\Exception $e) {

                return false;

            }

        });

        return $result;

    }

    public static function CategoriesGigActivate($gigCatId) {
        $gigCat = self::find($gigCatId);

        if($gigCat->active) {
            $gigCat->active = 0;
        } else {
            $gigCat->active = 1;
        }

        $gigCat->save();

        return $gigCat->active;
    }


    public function getFeaturedGigs(){





    }
}
