<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Essentialmodel;
use App\Http\Requests;
use Validator;
use Response;


use Illuminate\Support\Facades\Input;




class Post_Receiver extends Controller
{


    public function posting(Request $request)
    {

        var_dump($request->all());

    }








}