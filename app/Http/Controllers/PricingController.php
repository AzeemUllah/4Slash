<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Session;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;




class PricingController extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {

    }



    public function delete(Request $request)
    {

    }

    public function store2(Request $request)
    {

//        if (Input::has('essentialpack'))
//        {

            $essentialpack = Input::get('essentialpack');
            $usernumber1 = Input::get('qty2');

            return view('pages.essential_form', array('essentialpack' => $essentialpack, 'qty2' => $usernumber1));

    }
    public function essen(Request $request){

            $essentialpack = Input::get('essentialpack');
            $usernumber1 = Input::get('qty2');

            return view('pages.essential_form', array('essentialpack' => $essentialpack, 'qty2' => $usernumber1));
    }


    public function store3(Request $request)
    {

//        if (Input::has('enterprisepack'))
//        {
            $enterprisepack = Input::get('enterprisepack');
            $usernumber2 = Input::get('qty3');
            return view('pages.enterprise_form', array('enterprisepack' => $enterprisepack, 'qty3' => $usernumber2));
//        }else{
//            return Redirect::route('pricing');
//        }
    }

    public function enter(Request $request){

        $enterprisepack = Input::get('enterprisepack');
        $usernumber2 = Input::get('qty3');

        return view('pages.essential_form', array('enterprisepack' => $enterprisepack, 'qty3' => $usernumber2));
    }

    public function store4(Request $request)
    {

        if (Input::has('qty2'))
        {
            $quantity2 = Input::get('qty2');

            return view('pages.essential_form', array('qty2' => $quantity2));
        }else{
            return Redirect::route('pricing');
        }

    }



public function checkfreelogin(Request $request){


    if (Auth::user()->check()) {

        return view("pages.free_package");

    } else {

        $testabc = route('free_package');

        Session::set('freepackage',$testabc);

        return view('pages.login1');
    }

}


}