<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use App\Agency;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Hash;


class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    public function sendagencyPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'forgot_email' => 'required|email',
        ]);

        if($validator->fails()){
            return redirect::back()->withErrors(['auth' => 'Email is required']);
        } else {
            $agency = Agency::where('email', $request->input('forgot_email'))->first();

            $reset_token = str_random(20);

            $id = DB::table('forgot_password')->insertGetId(['email' => $agency->email, 'token' => $reset_token]);

            if(count($id) > 0) {
                $from = 'marketplace@4slash.com';
                $sub = 'Agency | Inquiry ';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                $to = $agency->email;

                $data = [
                    'agency' => $agency,
                    'token' => $reset_token
                ];

                $message = view('emails.forgotPassword', $data)->render();
//            $message .= '<a href="'.url().'/reset_link?email='.$agency->email.'&token='.$reset_token.'>"Reset Link</a>';

                // $message = view('NewAgencyEmail', $data)->render();

                if(mail($to, $sub, $message, $headers)){
                    Session::put('success', 'A reset password link has sent to your email.');
                    return redirect::back();
                }
            }


        }
    }


    public function resetPasswordForm($email, $token){

        $data = DB::table('forgot_password')->where(['email' => $email, 'token' => $token, 'expire' => 0])->first();

        if(count($data) > 0){

            return view('pages.agency.reset_password');
        }
        else {
            echo '<h2>Bad Request! Link has expired</h2>';
        }
    }


    public function resetAgencyPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);



        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        } else {

            $agency = Agency::where(['email' => $request->input('email')])->first();
            $agency->password = Hash::make($request->input('password'));
            $id = $agency->save();

            DB::table('forgot_password')->where('email', $request->input('email'))->update(['expire' => 1]);

            if($id){
                Session::put('success', 'Password reset successfully');
                return redirect()->route('agencylogin');

            }
        }

    }
}
