<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\SocialAccountService;
use Socialite;
use App\User;
use Auth;
use Hash;
use Str;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {

        $providerUser = \Socialite::driver('facebook')->user();
        $check_user = User::where('email', $providerUser->email)->first();

            if ($providerUser) {
           
                $check_fb_user = User::where('provider_user_id', $providerUser->id)->first();
                $check_fb_user_email = User::where('email', $providerUser->email)->first();

                if (count($check_fb_user) == 0) {
                    if(count($check_fb_user_email) == 0){
                   
                        $user = new User();
                        $user->name = $providerUser->name;
                        $user->email = $providerUser->email;
                        $user->username = $providerUser->name;
                        $user->password = Hash::make($providerUser->id);
                        $user->profile_image = $providerUser->avatar;
                        $user->active = 1;
                        $user->type = 'user';
                        $user->provider_user_id = $providerUser->id;
                        $user->provider = 'facebook';

                        if ($user->save()) {

                            if ($this->login($providerUser->email, $providerUser->id)) {

                                Session::put('success', 'You are successfully registered');
                                return redirect()->intended('/my_orders');
                            }

                        }
                    }else{
                        Session::flash('fb_error_message','User already exist with this email');
                        return redirect()->intended('/login');
                    }
                } else {
                    if ($this->login($providerUser->email, $providerUser->id)) {

                        return redirect()->intended('/my_orders');

                    } else {
                        return redirect()->back();
                    }

                }


            }

    }



    function login($email, $provider_id){

        if (Auth::user()->attempt(['email' => $email, 'password' => $provider_id, 'type' => 'user'])) {

                return true;

        } else {

                return false;
        }

    }
}