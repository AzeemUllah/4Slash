<?php

namespace App\Http\Controllers;

use App\Gig;
use App\Gigtype;
use App\GigImages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ImpressumController extends Controller
{
    public function index()
    {


        return view('pages.impressum');

    }

    public function datum(){
        return view('pages.date-page');
    }

    public function agb(){
        return view('pages.agb');
    }


}



?>