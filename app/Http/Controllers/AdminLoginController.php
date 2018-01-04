<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class AdminLoginController extends Controller
{
    use LogTrait;
    public function index()
    {
        if(Auth::admin()->check())
        {
            $user = Auth::admin()->get();
            $message = 'Opened Dashboard';
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $request_uri = url().$_SERVER['REQUEST_URI'];
            $this->InsertNewLog($remote_addr, $request_uri,$user->id,$message);
            return redirect()->route('admindashboard');
        }

        return view('pages.admin.login');

    }


}
