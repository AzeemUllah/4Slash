<?php

namespace App\Http\Controllers;

use Aws\Common\Facade\Ses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Validator;
use Redirect;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::user()->check()) {
//                return redirect()->route('userdashboard');
            return redirect("https://4slash.com");
        } else {
            return view('pages.login');
        }
    }


    public function index1(Request $request)
    {
            return view('pages.login1');

    }
    public function signin(Request $request)
    {
        return view('pages.login');

    }


    public function index2(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'admin_email' => 'required|email|unique:essential_form',
            'fullname' => 'required',
            'password' => 'required|min:5',
            'companyname' => 'required',
            'country' => 'required',
            'phonenumber' => 'required',
            'usernumber' => 'required',
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else {



            Session::put('order_information', [
                'full_name' => $request->input('fullname'),
                'admin_email' => $request->input('admin_email'),
                'company_name' => $request->input('companyname'),
                'country' => $request->input('country'),
                'user_number' => $request->input('usernumber'),
                'phone_number' => $request->input('phonenumber'),
                'password' => $request->input('password'),
            ]);

            $totalOrderAmount = $request->input('totalamount');
            $processingFees = (($totalOrderAmount * 5) / 100);
            Session::put('totalorderamount',$totalOrderAmount);
            Session::put('processing_fee',$processingFees);



            return view('pages.login2');
        }
        }



    public function index3(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'admin_email' => 'required|email|unique:enterprise',
            'fullname' => 'required',
            'password' => 'required|min:5',
            'companyname' => 'required',
            'country' => 'required',
            'phonenumber' => 'required',
            'usernumber' => 'required',
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else {



            Session::put('order_information1', [
                'full_name' => $request->input('fullname'),
                'admin_email' => $request->input('admin_email'),
                'company_name' => $request->input('companyname'),
                'country' => $request->input('country'),
                'user_number' => $request->input('usernumber'),
                'phone_number' => $request->input('phonenumber'),
                'password' => $request->input('password'),
            ]);

            $totalOrderAmount = $request->input('totalamount1');
            $processingFees = (($totalOrderAmount * 5) / 100);
            Session::put('totalorderamount',$totalOrderAmount);
            Session::put('processing_fee',$processingFees);



            return view('pages.login4');
        }
    }







    public function postLogin(Request $request)
    {

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
                    if ($request->session()->has('order_last_amount')) {
                        return redirect()->intended('paymentprocess');
                    }
                    elseif ($request->session()->has('package_order_last_amount')){
                        return redirect()->intended('/order/packages/auth');
                    }
                    else {
                        return redirect()->intended('/');
                    }
                } elseif (!Auth::user()->get()->active) {
                    Auth::user()->logout();
                    return redirect()->back()->withErrors(['auth' => 'Your registration has not yet been confirmed. Please confirm your registration and try again.']);
                }
            }
        } else {

            return Redirect::back()->withInput($request->except('password'))->withErrors(['ErrorMessage' => 'Username or password is incorrect']);
        }

    }


    public function postLogin1(Request $request)
    {

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
                    if ($request->session()->has('totalorderamount')) {


                        return redirect()->intended('withoutloginessential');
                    } else {
                        return redirect()->intended('/');

                    }
                } elseif (!Auth::user()->get()->active) {
                    Auth::user()->logout();
                    return redirect()->back()->withErrors(['auth' => 'Your registration has not yet been confirmed. Please confirm your registration and try again.']);
                }
            }
        } else {

            return Redirect::back()->withInput($request->except('password'))->withErrors(['ErrorMessage' => 'Username or password is incorrect ']);
        }

    }




    public function postLogin2(Request $request)
    {

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
                    if ($request->session()->has('totalorderamount')) {


                        return redirect()->intended('withoutloginenterprise');
                    } else {
                        return redirect()->intended('/');

                    }
                } elseif (!Auth::user()->get()->active) {
                    Auth::user()->logout();
                    return redirect()->back()->withErrors(['auth' => 'Your registration has not yet been confirmed. Please confirm your registration and try again.']);
                }
            }
        } else {

            return Redirect::back()->withInput($request->except('password'))->withErrors(['ErrorMessage' => 'Username or password is incorrect ']);
        }

    }


    public function daten_page()
    {
        return view('pages.date-page');
    }


}
