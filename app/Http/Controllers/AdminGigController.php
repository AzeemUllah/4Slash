<?php

namespace App\Http\Controllers;


use App\Gig;
use App\User;
use App\Gig_addon;
use App\Gig_question;
use App\GigImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminGigController extends Controller
{
    use LogTrait;

    public function removeGigImage(Request $request)
    {

        GigImages::removeGigImage($request->input('gig-image-id'));
        return redirect()->route('admingigs');

    }

    public function removeGigImages(Request $request)
    {
        return ['result' => GigImages::removeGigImage($request->input('gigimage_id'))];

    }

    public function removeGigAddon(Request $request)
    {

    $gigAddon = Gig_addon::where('id',$request->input('gigadonid'))->delete();
     //$gigAddon->delete;
    return ['result' => $gigAddon];

    }

    public function update(Request $request)
    {
        $admin = Auth::admin()->get();
        $message = 'updated favor';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $update_by = Auth::admin()->get()->id;
        $subcats_id = array();
        foreach($request->input('gig-sub-category') as $key=>$subcatId){
            $subcats_id[] = $subcatId;
        }

        $Subcat = implode(',',$subcats_id);

        $gigData['gig']['id'] = $request->input('gig-id');
        $gigData['gig']['gig-category-id'] = $request->input('gig-category');
        $gigData['gig']['gig-sub-category-id'] = $Subcat;
        $gigData['gig']['gig-slug'] = str_replace(' ', '_', strtolower($request->input('gig-title')));
        $gigData['gig']['gig-title'] = $request->input('gig-title');
        $gigData['gig']['gig-short-discription'] = $request->input('gig-short-discription');
        $gigData['gig']['gig-discription'] = $request->input('gig-discription');
        $gigData['gig']['gig-discription1'] = $request->input('gig-discription1');
        $gigData['gig']['gig-discription2'] = $request->input('gig-discription2');
        $gigData['gig']['gig_videos'] = $request->input('videos');
        $gigData['gig']['gig-delivery-days'] = $request->input('gig-delivery-days');
        $gigData['gig']['gig-price'] = $request->input('gig-price');
        $gigData['gig']['gig-images'] = $request->file('gig-images');
        $gigData['gig']['gig_addon'] = $request->input('gig-addon');
        $gigData['gig']['update_by'] = $update_by;
        $gigData['gig']['gig-choice-question'] = $request->input('gig-choice-question');


        if (count($request->input('gig-addon')) > 0) {
            foreach ($request->input('gig-addon') as $gig_add) {


                if (!empty($gig_add['addon_id'])) {
                    if(!empty($gig_add['delivery_day'])) {
                        $res = Gig_addon::where('id', $gig_add['addon_id'])->update([
                            'addon' => $gig_add['discription'],
                            'day' => $gig_add['delivery_day'],
                            'amount' => $gig_add['price'],
                        ]);
                    }else{
                        $res = Gig_addon::where('id', $gig_add['addon_id'])->update([
                            'addon' => $gig_add['discription'],
                            'amount' => $gig_add['price'],
                        ]);
                    }
                } else {
                    if(!empty($gig_add['delivery_day'])) {
                        $res = Gig_addon::insert([
                            'addon' => $gig_add['discription'],
                            'day' => $gig_add['delivery_day'],
                            'amount' => $gig_add['price'],
                            'gig_id' => $gigData['gig']['id']
                        ]);
                    }else{
                        $res = Gig_addon::insert([
                            'addon' => $gig_add['discription'],
                            'amount' => $gig_add['price'],
                            'gig_id' => $gigData['gig']['id']
                        ]);
                    }
                }
            }
        }


        if(count($request->input('gig-choice-question')) > 0) {
            foreach ($request->input('gig-choice-question') as $gig_choice_quest) {

                if(!empty($gig_choice_quest['question_id'])) {
                    Gig_question::where('id', $gig_choice_quest['question_id'])->update([
                        'question' => $gig_choice_quest['question'],
                        'answers' => implode(',', $gig_choice_quest['answers']),
                        'type' => 'check',

                    ]);
                }
                else{
                    Gig_question::insert([
                        'question' => $gig_choice_quest['question'],
                        'answers' => implode(',', $gig_choice_quest['answers']),
                        'type' => 'check',
                        'gig_id' => $gigData['gig']['id'],

                    ]);

                }
            }
        }


        $images = $request->file('gig-images');

        if (count($images) > 0) {
            foreach ($images as $image) {
                if (!empty($image)) {
                    list($width, $height) = getimagesize($image);
                    if($width == 750 && $height == 350){
                        $length = 2;
                        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                        $file_ext = $image->getClientOriginalExtension();
                        $new_name = md5($randomString).$image->getClientOriginalName();
                        $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);
                        $gigImage = new GigImages();
                        $gigImage->image = $new_name;
                        $gigImage->gig_id = $request->input('gig-id');
                        $gigImage->save();
                    }else{
                        continue;
                    }
                }
            }
        }


        if (Gig::admingigUpdate($gigData, $request)) {
            if($request->input('upd-fav') == 'favors') {
                if($request->input('save-btn')){
                    return redirect()->back();
                }else {
                    return redirect()->route('admingigs');
                }
            }else{
                if($request->input('save-btn')){
                    return redirect()->back();
                }else {
                    return redirect()->route('agenciesSuggestion');
                }
            }
//           return redirect()->back();
        }
//        return redirect()->route('agenciesSuggestion');
        //return redirect()->back();
    }

    public function gigActivate(Request $request)
    {
        $admin = Auth::admin()->get();
        $message = 'Change favor status';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $gigId = $request->input('gig-id');

        return ['status' => Gig::gigActivate($gigId)];
    }

    public function gigAccepted(Request $request){
        $admin = Auth::admin()->get();
        $message = 'Accept Favor';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $gigId = $request->input('gig-id');
        $gig = Gig::where('id', $gigId)->first();
        $agency = User::where('id', $gig->suggested_by)->first();
        $agency_id  = $gig->suggested_by;
        $accepted =  Gig::gigAccept($gigId,$agency_id);
        if($accepted){
            $from='marketplace@4slash.com';
            $sub='gig suggestion | Agency | 4slash';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
            $data = [
                'status'  => 'accepted',
                'user'     => $agency->username,
                'gig'      => $gig->title,
                'gig_disc' => $gig->short_discription,
                'type'    => 'gig'
            ];
            $to = $agency->email;
            $body = view('gigssuggestionMale', $data)->render();
            mail($to,$sub,$body,$headers);
        }
        return ['status' => $accepted];

    }
    public function gigFeatured(Request $request) {
        $admin = Auth::admin()->get();
        $message = 'set favor featured';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $gigId = $request->input('gig-id');

        return ['status' => Gig::gigFeatured($gigId)];
    }

}

