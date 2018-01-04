<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Redirect;
use Hash;

use App\User;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminAgenciesCreateController extends Controller
{

    public function index()
    {
        $data['update'] = false;

        return view('pages.admin.agency_create', $data);
    }

    public function agencyRegister(Request $request) {

        $userValidationData = [
            'name'      => $request->input('name'),
            'username'  => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        $userValidationRules = [
            'name'     => 'required|alpha_dash',
            'username' => 'unique:users',
            'email'    => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($userValidationData, $userValidationRules);

        if($validator->fails()) {

            return Redirect::back()->withErrors($validator);

        }

       $agency = User::create([
            'username' => $request->input('name'),
            /*'username' => $request->input('name'),*/
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'agency_percentage' => $request->input('percent'),
            'type' => 'agency',
        ]);
        $user_id = $agency->id;
         DB::table('users_info')->insertGetid(['user_id' => $user_id,'type' => 'agency']);

        return redirect()->route('adminagencies');

    }

}
