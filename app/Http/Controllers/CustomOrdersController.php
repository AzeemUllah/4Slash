<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\CustomOrder;
use App\Http\Controllers;

class CustomOrdersController extends Controller
{
    public function index()
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        if(CustomOrder::createCustomOrder($request->input()))
        {
            if($request->isXmlHttpRequest())
            {
                return response()->json(['status' => true]);
            }
        }
        else
        {
            if($request->isXmlHttpRequest())
            {
                return response()->json(['status' => false]);
            }
        }
    }
}