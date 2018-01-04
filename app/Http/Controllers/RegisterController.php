<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Response;
use Auth;
use Hash;
use Mail;
use App\Notification;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Admin;

class RegisterController extends Controller
{
    public function index()
    {

        return view('pages.register');

    }

    public function postRegister(Request $request)
    {
        $response = array();

        $userValidationData = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
        ];

        $userValidationRules = [
            'username' => 'required|unique:users|alpha_dash',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed:password_confirmation',

        ];


        $messages = array(
            'password.required' => 'Bitte ausfüllen',
        );

        $validator = Validator::make($userValidationData, $userValidationRules, $messages);
        if ($request->ajax()) {

            if ($validator->fails()) {

                $response['error'] = true;

                if ($validator->errors()->has('email')) {
                    $response['errors']['emailError'] = true;
                    $response['errorsMessages']['emailError'] = $validator->errors()->first('email');
                } else {
                    $response['errors']['emailError'] = false;
                }
                if ($validator->errors()->has('username')) {
                    $response['errors']['usernameError'] = true;
                    $response['errorsMessages']['usernameError'] = $validator->errors()->first('username');
                } else {
                    $response['errors']['usernameError'] = false;
                }
                if ($validator->errors()->has('password')) {
                    $response['errors']['passwordError'] = true;
                    $response['errorsMessages']['passwordError'] = $validator->errors()->first('password');
                }

                /*if ($validator->errors()->has('agreeLicence')) {
                    $response['errors']['agreeLicenceError'] = true;
                    $response['errorsMessages']['agreeLicenceError'] = $validator->errors()->first('agreeLicence');
                }*/

                else {
                    $response['errors']['passwordError'] = false;
                }

                return Response::json($response);
            }

            $activationCode = str_random(60) . $request->input('email');
            $admin = Admin::where(['type' => 'admin'])->first();
            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->type = 'user';
            $user->activation_code = $activationCode;
            $user->newsletter = $request->input('newsletter');
            if ($user->save()) {

                $user_id = $user->id;

                $id = DB::table('user_info')->insertGetid(['user_id' => $user_id,'type' => 'user']);
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $not_id = Notification::sendNotification('', $admin->id, '<a href="'.route('registereduser',['userEmail' =>$user->email]).'?ref=notification">New User</a>');
                Notification::sendNotification('', $admin->id, '<a href="'.route('registereduser',['userEmail' => $user->email]).'?ref=notification&id='.$not_id.'">New User</a>');
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                if($id) {

                    $from = 'marketplace@4slash.com';
                    $sub = 'Registration';
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                    $data = [
                        'registered' => 'doneregister',
                        'user' => $user->username,
                        'activation_code' => $activationCode
                    ];
                    $message = view('UserConfirmedRegistraionEmail', $data)->render();
                    if (mail($request->input('email'), $sub, $message, $headers)) {
                        Auth::user()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'type' => 'user']);
                        echo true;

                    } else {
                        return false;
                    }
                }

                $response['error'] = false;

                //return Redirect::route('login')->with('successMessage', 'Registration successfull please verify your email to continue.');
            }


        } else {
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            $activationCode = str_random(60) . $request->input('email');

            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->type = 'user';
            $user->activation_code = $activationCode;
            $user->newsletter = $request->input('newsletter');
            if ($user->save()) {

                $user_id = $user->id;
                Session::put('successMessage', 'Activate User Account.');

                $id = DB::table('user_info')->insertGetid(['user_id' => $user_id]);

                    $from = 'marketplace@4slash.com';
                    $sub = 'Registration';
                    $message = 'Activate your user account and click on this link: ' . url('/') . '/activate/email?token=' . $activationCode;
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                    if (mail($request->input('email'), $sub, $message, $headers)) {
                        Auth::user()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'type' => 'user']);
                        echo true;

                    } else {
                        return false;
                    }
              //  }



            }



//            return Redirect::route('login')->with('successMessage', 'Activate User Account.');
            return Redirect::route('myorders')->with('successMessage', 'Activate User Account.');

        }

    }

}
