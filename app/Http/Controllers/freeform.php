<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Freemodel;
use App\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use bcrypt;



use Illuminate\Support\Facades\Input;




class freeform extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {

    }



    public function delete(Request $request)
    {

    }

    public function free(Request $request)
    {
//        $allapps = Input::get('apps');
//        var_dump($allapps);
//        exit;
        return view("pages.free_package_form");
    }




    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'admin_email' => 'required|email|unique:freeform',
            'full_name' => 'required',
            'password' => 'required|min:4',
            'companyname' => 'required',
            'country' => 'required',
            'phonenumber' => 'required',
            'primaryinterest' => 'required',
            'companysize' => 'required',
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $application = implode(",",Input::get('apps') );

        $user = Auth::user()->get();


        $freemodel = new Freemodel;
        $freemodel->user_id = $user->id;
        $freemodel->full_name = Input::get('full_name');
        $freemodel->admin_email = Input::get('admin_email');
        $freemodel->company_name = Input::get('companyname');
        $freemodel->Country = Input::get('country');
        $freemodel->phone_number = Input::get('phonenumber');
        $freemodel->company_size = Input::get('companysize');
        $freemodel->primary_interest = Input::get('primaryinterest');
        $freemodel->password = Input::get('password');
        $freemodel->apps = $application;

        $freemodel->save();



        return('form saved');

    }


    public function datapost(Request $request){



        $full_name = Input::get('full_name');
        $admin_email = Input::get('admin_email');
        $company_name = Input::get('companyname');
        $Country = Input::get('country');
        $phone_number = Input::get('phonenumber');
        $password = bcrypt(Input::get('password'));
        $pushapps = array('setting','notes','welcome');
        $app = Input::get('apps');
        array_push($app,'settings','notes','dashboard');
        $created_at = date('Y-m-d H:i:s');



        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'sprout.4slash.com:3000/connect-4slash',[

                'headers' =>[
                    'Content-Type' => 'application/x-www-form-urlencoded'

                ],
                'form_params' =>[
                    'full_name' => $full_name,
                    'password' => $password,
                    'admin_email' => $admin_email,
                    'company_name' => $company_name,
                    'country' => $Country,
                    'phone_number' => $phone_number,
                    'created_at' => $created_at,
                    'allowed_apps' => $app,
                ]

            ]);


            echo $res->getStatusCode();
            echo $res->getHeaderLine('content-type');
            echo $res->getBody();



        }catch (Exception $e) {
            print_r($e->getResponse());
        }



    }

}