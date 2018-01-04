<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class SettingsController extends Controller
{
    
    public function index()
    {
        $data['user'] = Auth::get();
        return view('pages.settings')->with($data);
    }

    public function notify_settings(Request $request){
        $id = Auth::get()->id;
        $email = $request->input('email_notify');
        $order = $request->input('order_notify');
        $update = User::where('id',$id)->update(['email_notify' => $email, 'order_notify'=> $order]);
        if($update){
            /*Session::flash('success_settins','Settings saved successfully');*/
            $request->session()->flash('success_settins', 'Settings saved successfully');
            return redirect()->route('mysettings');
        }else{
            return redirect()->back();
        }
    }

    public function agency_notify_settings(Request $request){
        $id = Auth::get()->id;
        $email = $request->input('email_notify');
        $order = $request->input('order_notify');
        $update = User::where('id',$id)->update(['email_notify' => $email, 'order_notify'=> $order]);
        if($update){
            /*Session::flash('success_settins','Settings saved successfully');*/
            $request->session()->flash('success_settins', 'Settings saved successfully');
            return redirect()->route('agencyprofile');
        }else{
            return redirect()->back();
        }
    }

    
}
