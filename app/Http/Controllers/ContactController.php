<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Response;
use Auth;
use Hash;
use Mail;
use App\Order;
use App\User;

class ContactController extends Controller
{

    public function contactUs(Request $request)
    {


        if($request->has('submit')) {
            $userValidationData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'betreff' => $request->input('betreff'),
                'msg' => $request->input('msg'),
            ];

            $userValidationRules = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'betreff' => 'required|max:255',
                'msg' => 'required|max:500',
            ];

            $validator = Validator::make($userValidationData, $userValidationRules);

            if ($validator->fails()) {

                return Redirect::back()->withErrors($validator);
            } else {

//                $to = 'osamasheikh791@gmail.com';
                $to = "marketplace@4slash.com";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                $message = $request->input('name') . ' has sent you the following message from your contact form<br>
                        <p><strong>Subject: </strong>' . $request->input('betreff') . '</p>
                        <p><strong>Email address: </strong>'. $request->input('email'). '</p>
                        <p><strong>Message: </strong>' . $request->input('msg') . '</p>';

                if($request->has('gig_title')){
                    $subject = 'Gig inquiry: '.$request->input('gig_title');
                    $gig_title = ucfirst(str_replace('_', ' ', $request->input('gig_title')));
                    $message .= '<p><strong>Gig Anfrage: </strong>' . $gig_title . '</p>';
                } else{
                    $subject = 'Message sent using your contact form about';
                }

                $message .= '<br><br>Regards,
                             <h3>4slash.com</h3><p></p>';

                // More headers
                $headers .= 'From: ' . $request->input('name') . '<' . $request->input('email') . '>' . "\r\n";
              //  $headers .= "CC: ". $cc. "\r\n";

                if (mail($to, $subject, $message, $headers)) {

                    return Redirect::back()->with('successMessage', 'Thank you for your message! We will be back soon');
                } else {
                    return Redirect::back()->with('errorMessage', 'Sorry! Please try again, some errors occured');
                }

            }
        }

        return view('pages.contactForm');
    }
    public function agency_contact_form(){
        $data['email']  = Auth::agency()->get()->email;
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages.agency.contact',$data);
    }
    public function Agencycontact(Request $request)
    {
        if($request->has('submit')) {
            /*$email  = Auth::agency()->get()->email;*/
            $email = $request->input('email');
            $userValidationData = [
                'name' => $request->input('name'),
                'email' => $email,
                'betreff' => $request->input('betreff'),
                'msg' => $request->input('msg'),
            ];

            $userValidationRules = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'betreff' => 'required|max:255',
                'msg' => 'required|max:500',
            ];

            $validator = Validator::make($userValidationData, $userValidationRules);

            if ($validator->fails()) {

                return Redirect::back()->withErrors($validator)->withInput();
            } else {

                $activation_code = str_random(40). $request->input('email');

                DB::table('agency_inquires')->insert([
                    'name' => $request->input('name'),
                    'email' => $email,
                    'subject' => $request->input('betreff'),
                    'message' => $request->input('msg'),
                    'activation_code' => $activation_code
                ]);

                $users = array('admin','agency');
                for($i = 0; $i <= 1; $i++){
                    $from='marketplace@4slash.com';
                    $sub='Agency Inquiry';
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
                    if($users[$i] == 'admin'){
                        $data = [
                            'type'  => 'inquiry',
                            'user'   => 'admin',
                            'agency' => $request->input('name'),
                        ];
                        $to = 'marketplace@4slash.com';
                        $message = view('NewAgencyEmail', $data)->render();

                        mail($to, $sub, $message, $headers);
                    }
                    elseif($users[$i] == 'agency'){

                        $data = [
                            'type'  => 'inquiry',
                            'user'   => 'agency',
                            'agency' => $request->input('name')
                        ];
                        $to = $email;
                        $message = view('NewAgencyEmail', $data)->render();

                        if (mail($to, $sub, $message, $headers)) {
                            if($request->input('sel_lang') == 'ger') {
                                return Redirect::back()->with('successMessage', 'Thank you for your message! We\'ll be back soon');
                            }else{
                                return Redirect::back()->with('successMessage', 'Thank you for your message! We will get back shortly');
                            }
                            } else {
                            return Redirect::back()->with('errorMessage', 'Sorry! Please try again, some errors occured');
                        }

                    }
                }

            }
        }
    }

    public function thankuPage(Request $request){
        if(Session::all())
        {
        return view('pages.thanku_page');
        }
        else
        {
            return redirect()->back();
        }
    }
    public function pay_method(){ 
        echo "4slash";
    }
}



