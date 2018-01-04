<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use App\User;
use App\Agency;
use App\Gig;
use App\Package;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class AgencyAuthController extends Controller
{

    public function index()
    {
        if(Auth::agency()->check())
        {
            return redirect()->route('agencydashboard');
        }

        return view('pages.agency.login');

    }

    public function postLogin(Request $request) {


        $agencyData = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ];


        $agencyRules = [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($agencyData, $agencyRules);
        if($validator->fails()){

            return Redirect::back()->withErrors(['auth' => 'Username and or Password is invalid.']);
        }
        elseif (Auth::agency()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'agency', 'active' => 1])) {
            return redirect()->route('agencydashboard');
        }else {
            return Redirect::back()->withErrors(['auth' => 'Your email address is not verified.']);
        }


    }

    public function logout() {

        Auth::agency()->logout();

        return redirect()->route('agencylogin');

    }
    public function activateAgency(Request $request){

        /*$token = $request->input('token');
        $agency = User::where(['activation_code' => $token])->first();
        $agency->active = 0;
        if($agency->save())*/
            Session::put('emailVerified', 'You have successfully completed your registration.');
        return redirect()->route('agencylogin');

    }

    public function vacation_mode(Request $request){
        $mode = $request->input('mode');
        if($mode == "on"){
            $user_id = Auth::agency()->get()->id;
            $update = Agency::where(['id' => $user_id])->update(['vacation' => 1]);
            if($update) {
                $gig_update = Gig::where(['suggested_by' => $user_id])->update(['vacation' => 1]);
                if($gig_update) {
                    Package::where(['suggested_by' => $user_id])->update(['vacation' => 1]);
                    header('Content-Type: application/json');
                    echo $update;
                }
            }
        }else{
            $user_id = Auth::agency()->get()->id;
            $update = Agency::where(['id' => $user_id])->update(['vacation' => 0]);
            if($update) {
                $gig_update = Gig::where(['suggested_by' => $user_id])->update(['vacation' => 0]);
                if($gig_update) {
                    Package::where(['suggested_by' => $user_id])->update(['vacation' => 0]);
                    header('Content-Type: application/json');
                    echo $update;
                }
            }
        }
    }

}
