<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;


use Validator;
use Response;

class AuthController extends Controller
{


    public function postLogin(Request $request) {

        $response = array();

        $userValidationData = [
            'email'                 => $request->input('email'),
            'password'              => $request->input('password'),
        ];

        $userValidationRules = [
            'email'    => 'required|email|max:255',
            'password' => 'required|min:6',
        ];


        $validator = Validator::make($userValidationData, $userValidationRules);

        if($request->ajax()) {

            if ($validator->fails()) {

                $response['error'] = true;
                $response['errors']['otherError'] = true;
                $response['errorsMessages']['otherError'] = "Email and or Password was incorrect.";

                /*if ($validator->errors()->has('email')) {
                    $response['errors']['emailError'] = true;
                    $response['errorsMessages']['emailError'] = $validator->errors()->first('email');
                } else {
                    $response['errors']['emailError'] = false;
                }
                if ($validator->errors()->has('password')) {
                    $response['errors']['passwordError'] = true;
                    $response['errorsMessages']['passwordError'] = $validator->errors()->first('password');
                } else {
                    $response['errors']['passwordError'] = false;
                }*/

                return Response::json($response);
            }



            if(is_object(User::where(['email' => $request->input('email'), 'active' => 1])->first())) {

                if (Auth::user()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'user', 'active' => 1])) {
                    $response['error'] = false;
                } else {
                    $response['error'] = true;
                    $response['errors']['otherError'] = true;
                    $response['errorsMessages']['otherError'] = "Email and or Password was incorrect.";
                }

            } else if(User::where(['email' => $request->input('email'), 'active' => 0])) {

                $response['error'] = true;
                $response['errors']['otherError'] = true;
                $response['errorsMessages']['otherError'] = "Confirm your e-mail address!";
            }




            return Response::json($response);

        } else {

            if($validator->fails()) {
                return Redirect::back()->withInput($request->except('password'))->withErrors('ErrorMessage','Confirm your e-mail address!');
            }

            if (Auth::user()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 'user'])) {
                if(Auth::user()->get()->active) {
                    return redirect()->intended('/userdashboard');
                } else {
                    Auth::user()->logout();
                    return redirect()->back()->withErrors(['others' => 'Your registration has not yet been confirmed. Please confirm your registration and try again.']);
                }
            }
            else{

                return redircet()->back()->withErrorswithErrors('ErrorMessage','Confirm your e-mail address!');
            }

        }

    }

    public function getLogout() {
        Session::flush();
        Auth::user()->logout();
        return redirect('/login');
    }

    public function redirectToGoogleProvider() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback() {
        try {
            $user = Socialite::driver('google')->user();

            echo"Token: " . $user->token . "<br>";
            echo "Id: " . $user->getId() . "<br>";
            echo "NickName: " . $user->getNickname() . "<br>";
            echo "Name: " . $user->getName() . "<br>";
            echo "Email: " . $user->getEmail() . "<br>";
            echo "Avatar: " . $user->getAvatar() . "<br>";
        } catch(Exception $e) {
            return Redirect::to('/');
        }
    }

    public function activateEmail(Request $request) {
        Session::flush();
        $token = $request->input('token');

        $user = User::where(['activation_code' => $token])->first();

        $user->active = 1;
        $saved = $user->save();
        if($saved)
        {
            $from = 'marketplace@4slash.com';
            $sub = 'Congratulation! A new user | 4slash';
            $data = [
                'confirmed' => 'confirmmail',
                'user' => $user->username
            ];
            $message = view('UserConfirmedRegistraionEmail', $data)->render();
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
            mail('marketplace@4slash.com', $sub, $message, $headers);

        }

        Session::put('emailVerified', 'You have successfully completed your registration.');
        return redirect()->route('login');

    }

}
        