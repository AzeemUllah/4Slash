<?php

namespace App\Http\Controllers;

use App\Gigtype_Subcategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Gigtype;
use App\Gig;
use App\GigImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

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
            $query = "(title LIKE '%". $request->input('search') ."%' AND active=1) OR (title LIKE '%". explode(' ', $request->input('search'))[0] ."%' AND active=1)";

            $gigs = Gig::take(12)->whereRaw($query)->get();


        }
        else {
            $gigs = Gig::where(['active' => 1])->take(12)->get();
        }




        foreach($gigs as $gig) {
            $gig['thumbnail'] = GigImages::getGigThumbnail($gig->id);
            $gig['gigType'] = Gigtype::where('id', $gig->gigtype_id)->first();
        }

        $data['gigs'] = $gigs;


        return view('pages.gigs_without_login')->with($data);

    }

    public function gigsByType(Request $request, $gigType) {

        $gigType = Gigtype::where('slug', $gigType)->first();


        $data['user'] = Auth::user()->get();
        $data['gigType'] = $gigType;
        $data['gigs'] = Gig::where(['gigtype_id' => $gigType->id, 'active' => 1])->get();


        return view('pages.gigs')->with($data);
      
    }

    public function getGigsByCategory($categorySlug) {
        $gigType = Gigtype::where('slug', $categorySlug)->first();
        $gigs = Gig::where(['gigtype_id' => $gigType->id, 'active' => 1])->orderBy('featured', 'desc')->get();

        foreach($gigs as $gig) {
            $gig['thumbnail'] = GigImages::getGigThumbnail($gig->id);
            $gig['gigType'] = Gigtype::where('id', $gig->gigtype_id)->first();
        }

        $data['gigType'] = $gigType;
        $data['gigs'] = $gigs;

       
        return view('pages.gigs_without_login')->with($data);
    }

    public function getGigsBySubCategory($catSlug, $subCatSlug) {
        $gigType = Gigtype::where(['slug' => $catSlug])->first();
        $gigtype_subCat = Gigtype_Subcategory::where(['slug' => $subCatSlug, 'gigtypes_id' => $gigType->id])->first();

        $gigs = Gig::where(['gigtype_id' => $gigType->id, 'gigtypes_subcategories_id' => $gigtype_subCat->id])->get();
        foreach($gigs as $gig) {
            $gig['thumbnail'] = GigImages::getGigThumbnail($gig->id);
            $gig['gigType'] = Gigtype::where('id', $gig->gigtype_id)->first();
        }

        $data['gigType'] = $gigType;
        $data['gigs'] = $gigs;
       var_dump($gigType);
        return view('pages.gigs_without_login')->with($data);
    }

}
