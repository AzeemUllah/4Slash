<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{

    public function postLogin(Request $request) {



        $adminValidationData = [
            'email'                 => $request->input('email'),
            'password'              => $request->input('password'),
        ];

        $adminValidationRules = [
            'email'    => 'required|email|max:255',
            'password' => 'required|min:6',
        ];


        $validator = Validator::make($adminValidationData, $adminValidationRules);

        if($validator->fails()){

            return Redirect::back()->withInput($request->except('password'))->withErrors(['auth' => 'Username and or Password is invalid.']);
        }
        if (Auth::admin()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'admin'])) {

            return redirect()->route('admindashboard');
        }
        else if (Auth::admin()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'subadmin'])) {
            return redirect()->route('admindashboard');
        }
        else {
            return Redirect::back()->withInput($request->except('password'))->withErrors(['auth' => 'Username and or Password is invalid.']);
        }



    }

    public function logout() {

        Auth::admin()->logout();

        return redirect()->route('adminlogin');

    }

}
