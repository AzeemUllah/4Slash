<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Essentialmodel;
use App\Http\Requests;
use Validator;
use Response;

use Illuminate\Support\Facades\Input;




class Essentialform extends Controller
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

    public function essential(Request $request)
    {
        return view("pages.essential_form");
    }




//    public function store1(Request $request)
//    {
//        $validator = Validator::make($request->all(),[
//            'admin_email' => 'required|email|unique:essential_form',
//            'name' => 'required|max:120',
//            'password' => 'required|min:4',
//            'companyname' => 'required',
//            'country' => 'required',
//            'phonenumber' => 'required',
//            'usernumber' => 'required',
//        ]);
//
//
//        if($validator->fails()){
//            return redirect()->back()->withErrors($validator->errors());
//        }
//
//        $user = new Essentialmodel;
//        $user->full_name = Input::get('name');
//        $user->admin_email = Input::get('email');
//        $user->company_name = Input::get('companyname');
//        $user->Country = Input::get('country');
//        $user->phone_number = Input::get('phonenumber');
//        $user->user_number = Input::get('usernumber');
//        $user->password = Input::get('password');
//        $user->save();
//
//        return('form saved');
//
//    }




}