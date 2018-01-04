<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use PhpSpec\Exception\Exception;
use Validator;
use Response;
use Hash;
use App\User;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user()->get();
        $userDetail = DB::table('user_info')->where('user_id',$user->id)->first();
        $data['user'] = $user;
        $data['userDetail'] = $userDetail;

        return view('pages.profile')->with($data);
    }


    public function updateUser()
    {
        $user = Auth::user()->get();
        $userDetail = DB::table('user_info')->where('user_id',$user->id)->first();
        $data['user'] = $user;
        /*$data['update'] = true;*/
        $data['userDetail'] = $userDetail;
        return view('pages.user_Details_edit',$data);
    }


    public function putUpdateUser(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'phone' => 'required',
                'surname' => 'required|max:10',
                'post_add' => 'required|max:150',
                'mobile' => 'required',
                'zip' => 'required',
                'name' => 'required|max:20',
                /*'country' => 'required|max:255',*/
                'company' => 'required',
                'gender' => 'required'
            ]

        );



        $data =[
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'country' => $request->input('country'),
            'postal_address' => $request->input('post_add'),
            'gender' => $request->input('gender'),
            'company' => $request->input('company'),
            'zip' => $request->input('zip'),
            'surname' => $request->input('surname'),
        ];

        if(!$validator->fails())
        {
           DB::beginTransaction();
           DB::table('user_info')->where('user_id',Auth::user()->get()->id)->update($data);
           $user = User::where('id',Auth::user()->get()->id)->update(['name' => $request->input('name'),'email' => $request->input('email')]);
            if($request->file('profile-img')) {
                $user_info = Auth::user()->get();
                if(file_exists(public_path('photos/mini/' . basename($user_info->profile_image))))
                {
                    try {
                        unlink(public_path('photos/mini/' . basename($user_info->profile_image)));
                    } catch(\Exception $e) {

                    }
                }
                $image = $request->file('profile-img');

                $absolute_path = 'photos/mini/' . $user_info->username . '.' . time() . '.' . $image->getClientOriginalExtension();
                $relative_path = public_path($absolute_path);

                Image::make($image->getRealPath())->resize(100, 100)->save($relative_path);

                $user_info->profile_image = url() . '/' . $absolute_path;
                $user_info->save();
            }
           DB::commit();




                Session::flash('success', 'Profile has been updated successfully');
                return redirect()->route('profile');


        }
        else{
            return Redirect::back()->withErrors($validator)->withInput();
        }

    }



    public function editUser()
    {
        $user = Auth::user()->get();
        $data['user'] = $user;
        $data['update'] = false;
        $userDetail = DB::table('user_info')->where('user_id',$user->id)->first();
        $data['userDetail'] = $userDetail;
        return view('pages.user_Details_edit',$data);
    }
    
    public function change_profile_image(Request $request)
    {
        if(Input::file())
        {
            $user = Auth::user()->get();
            if(file_exists(public_path('photos/mini/' . basename($user->profile_image))))
            {
                try {
                    unlink(public_path('photos/mini/' . basename($user->profile_image)));
                } catch(\Exception $e) {

                }
            }
            $image = Input::file('profile-img');
            $absolute_path = 'photos/mini/' . $user->username . '.' . time() . '.' . $image->getClientOriginalExtension();
            $relative_path = public_path($absolute_path);

            Image::make($image->getRealPath())->resize(100, 100)->save($relative_path);

            $user->profile_image = url() . '/' . $absolute_path;
            $user->save();
            return url() . '/' . $absolute_path;
        }

    }

    
    public function change_profile_cover_image(Request $request)
    {
        if(Input::file())
        {
            $user = Auth::user()->get();
            if($user->cover_image != NULL)
            {
                if(file_exists(public_path('photos/cover/' . basename($user->cover_image))))
                {
                    unlink(public_path('photos/cover/' . basename($user->cover_image)));
                } 
            }
            
            $image = Input::file('profile-cover-img');
            $absolute_path = '/photos/cover/' . $user->username . '.cover.' . time() . '.' . $image->getClientOriginalExtension();
            $relative_path = public_path($absolute_path);
            Image::make($image->getRealPath())->resize(1140,250)->save($relative_path);
            $user->cover_image = url() . $absolute_path;
            $user->save();
            return url() . $absolute_path;
        }
        else
        {
            return 'no';
        }
    }

    public function agency_profile_change(Request $request){
        $user = Auth::user()->get();
        $image = Input::file('profile-img');
        $absolute_path = 'photos/mini/' . $user->username . '.' . time() . '.' . $image->getClientOriginalExtension();
        $relative_path = public_path($absolute_path);

        Image::make($image->getRealPath())->resize(100, 100)->save($relative_path);

        $user->profile_image = url() . '/' . $absolute_path;
        $user->save();
        return url() . '/' . $absolute_path;
    }
}
