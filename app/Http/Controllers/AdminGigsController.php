<?php

namespace App\Http\Controllers;

use App\Gig;
use App\Agency;
use App\Gig_addon;
use App\Gig_question;
use App\GigImages;
use App\Gigtype;
use App\Order;
use App\Gigtype_Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Redirect;
use App\Notification;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Session;

class AdminGigsController extends Controller
{
    use LogTrait;
    public function index()
    {
        $admin = Auth::admin()->get();
        $gigs = Gig::where('status', 'enabled')->orderBy('created_at', 'asc')->get();
        $created_by = array();
        //$check_arr = array();

        foreach ($gigs as $gig) {
            $user = User::select('type', 'username')->where('id', $gig->user_id)->first();
            $created = User::select('type', 'username')->where('id', $gig->suggested_by)->first();
            $created_by[$gig->id] = ucfirst($created['type']) . ': ' . $created['username'];
        }
        $agent = DB::table('users')->where('type', 'agency')->get();
        $data['gigs'] = $gigs;
        $data['created_by'] = $created_by;
        $data['agent'] = $agent;
        $data['get_activated'] = Gig::where(['active' => 1,'status' => 'enabled'])->count();
        $data['get_deactivated'] = Gig::where(['active' => 0,'featured' => 0, 'status' => 'enabled'])->orwhere(['active' => 0,'featured' => 1, 'status' => 'enabled'])->count();
        $data['get_featured'] = Gig::where(['active' => 1,'featured' => 1, 'status' => 'enabled'])
            ->orwhere(['active' => 0,'featured' => 1, 'status' => 'disabled'])
            ->orwhere(['active' => 1,'featured' => 1, 'status' => 'disabled'])
            ->orwhere(['active' => 0,'featured' => 1, 'status' => 'enabled'])
            ->count();
        $message = 'Opened Favors Page';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        return view('pages.admin.gigs')->with($data);
    }


    public function suggestedGigs()
    {

        if (isset($_GET['id'])) {
            $notify = Notification::where('id', $_GET['id'])->first();
            $notify->seen = 1;
            $notify->save();
        }

        $gigs = Gig::where(['active'=> 0,'rejection'=>0,'status' => 'disabled'])->orderBy('created_at', 'desc')->get();
        foreach ($gigs as $gig) {
            if($gig->gigtype_id != null){
                $gigtype = Gigtype::where(['id'=>$gig->gigtype_id])->first();
                $gig['type'] = $gigtype;
                /*var_dump($gigtype->name);*/

            }
            if($gig->gigtypes_subcategories_id != null){
                $gigsubtype = Gigtype_Subcategory::where(['id'=>$gig->gigtypes_subcategories_id])->first();
                $gig['subtype'] = $gigsubtype;
            }
            if ($gig->suggested_by != null) {
                $agency = Agency::where('id', $gig->suggested_by)->first();
                $gig['agency'] = $agency;
            }
        }
        $agent = DB::table('users')->where('type', 'agency')->get();
        $data['gigs'] = $gigs;
        $data['agent'] = $agent;
        return view('pages.admin.gigssuggestion')->with($data);
    }


    public function create(Request $request)
    {
        $admin = Auth::admin()->get();
        if (isset($_GET['id'])) {
            $notify = Notification::where('id', $_GET['id'])->first();
            $notify->seen = 1;
            $notify->save();
        }
        $update = false;
        if ($request->input('action')) {
            if ($request->input('action') == 'update') {
                $message = 'Edit Favor';
                $remote_addr = $_SERVER['REMOTE_ADDR'];
                $request_uri = url().$_SERVER['REQUEST_URI'];
                $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
                $update = true;
                $favor = $request->input('favors');
                $gig = Gig::where(['uuid' => $request->input('funnel')])->first();
                if(!empty($gig)) {
                    $data['category'] = Gigtype::where('id', $gig->gigtype_id)->first();
                    $subcats_id = array();
                    $id = $gig->gigtypes_subcategories_id;
                    $explo = explode(',',$id);
                    foreach($explo as $key=>$subcatId){
                        $subcats = Gigtype_Subcategory::where('id', $subcatId)->first();
                        if(!empty($subcats))
                            $subcats_id[] = $subcats;
                    }

                    $data['subcategory'] = $subcats_id;
                    $data['update'] = $update;
//                $data['categories'] = Gigtype::all();
                    $data['categories'] = Gigtype::where(['active' => 1, 'status' => 'enabled'])->get();
                    $data['subCategories'] = Gigtype_Subcategory::where(['gigtypes_id' => $gig->gigtype_id])->get();
                    $data['gig'] = $gig;
                    $data['user'] = User::select('type', 'username')->where('id', $gig->user_id)->first();

                    $data['gigAddons'] = Gig_addon::where(['gig_id' => $gig->id])->get();
                    $data['gigQuestions'] = Gig_question::where(['gig_id' => $gig->id])->get();
                    $data['gigImages'] = GigImages::where(['gig_id' => $gig->id])->get();
                    $data['favor'] = $favor;
                    return view('pages.admin.gigs_create')->with($data);
                }else{
                    SESSION::put('gig-empty','This favor was deleted');
                    return redirect()->route('admingigs');
                }


            }
        }
        $categories = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();

        $data['update'] = $update;
        $data['categories'] = $categories;
        return view('pages.admin.gigs_create')->with($data);
    }

    public function createGig(Request $request) {
        if(isset($_GET['id']))
        {
            $notify = Notification::where('id',$_GET['id'])->first();
            $notify->seen = 1;
            $notify->save();
        }
        $user = Auth::admin()->get();
        $subcats_id = array();
        foreach($request->input('gig-sub-category') as $key=>$subcatId){
            $subcats_id[] = $subcatId;
        }

        $Subcat = implode(',',$subcats_id);
        DB::transaction(function() use($request, $user, $Subcat) {

            $extraCharachters = array(' ', '/', '.');


            $gig = Gig::create([

                'uuid' => \Webpatser\Uuid\Uuid::generate(4),
                'user_id' => $user->id,
                'gigtype_id' => $request->input('gig-category'),
                'gigtypes_subcategories_id' => $Subcat,
                'slug' => str_replace($extraCharachters, '_', strtolower($request->input('gig-title'))),
                'title' => $request->input('gig-title'),
                'short_discription' => $request->input('gig-short-discription'),
                'discription' => $request->input('gig-discription'),
                'discription2' => $request->input('gig-discription1'),
                'discription3' => $request->input('gig-discription2'),
                'gig_videos' => $request->input('videos'),
                'delivery_days' => $request->input('gig-delivery-days'),
                'price' => $request->input('gig-price'),
                'status' => 'enabled',
                'suggested_by' => Auth::admin()->get()->id
            ]);

            $images = $request->file('gig-images');
            if(count($images) > 0)
            {
                foreach($images as $image)
                {
                    $length = 2;

                    $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                    $file_ext = '.'.$image->getClientOriginalExtension();
                    $new_name = $image->getClientOriginalName().md5($randomString).$file_ext;
                    $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);

                    $gigImage = new GigImages();
                    $gigImage->image = $new_name;
                    $gigImage->gig_id = $gig->id;
                    $gigImage->save();

                    /*if(!empty($image)) {
                        list($width, $height) = getimagesize($image);
                        if($width == 750 && $height == 350){
                            $length = 2;
                            $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                            $file_ext = '.'.$image->getClientOriginalExtension();
                            $new_name = $image->getClientOriginalName().md5($randomString).$file_ext;
                            $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);

                            $gigImage = new GigImages();
                            $gigImage->image = $new_name;
                            $gigImage->gig_id = $gig->id;
                            $gigImage->save();
                        }else{
                            continue;
                        }
                    }*/
                }
            }

            if(count($request->input('gig-addon')) > 0) {
                foreach ($request->input('gig-addon') as $gig_add) {
                    if(!empty($gig_add['delivery_day'])) {
                        Gig_addon::create([

                            'gig_id' => $gig->id,
                            'addon' => $gig_add['discription'],
                            'day' => $gig_add['delivery_day'],
                            'amount' => $gig_add['price'],

                        ]);
                    }else{
                        Gig_addon::create([

                            'gig_id' => $gig->id,
                            'addon' => $gig_add['discription'],
                            'amount' => $gig_add['price'],

                        ]);
                    }
                }
            }

            if(count($request->input('gig-choice-question')) > 0) {
                foreach ($request->input('gig-choice-question') as $gig_choice_quest) {

                    Gig_question::create([

                        'gig_id' => $gig->id,
                        'question' => $gig_choice_quest['question'],
                        'answers' => implode(',', $gig_choice_quest['answers']),
                        'type' => 'check',

                    ]);
                }
            }

        });

        return redirect()->route('admingigs');

    }

    public function singleGig(Request $request){


        $gig = Gig::where('id', $request->input('gig_id'))->first();

        return response()->json($gig);
        //json_encode($gig);
    }

   

    public function catSingleGig(Request $request){


        $gigTypes = Gigtype::where('id', $request->input('gig_id'))->first();

        return response()->json($gigTypes);
        //json_encode($gig);
    }

    public function deleteGig(Request $request) {

        $gig = Gig::destroy($request->input('gig_id'));

        return $gig;

    }

    public function add_gig_to_trash(Request $request){
        $admin = Auth::admin()->get();
        $message = 'delete favor';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $gig_id = $request->input('gig_id');
        $check_pending_orders = Order::where(['gig_id' => $gig_id, 'status' => 'pending'])->get();
        if(count($check_pending_orders) > 0){
            return ['has_pending' => 'Sorry this favor has pending orders to complete!'];
        }
        else{
            $affected_rows = Gig::where('id', $gig_id)->update(['status' => 'disabled','active'=> 0]);

            if($affected_rows)
                echo '1';
            else
                echo '0';
        }

    }

    public function add_gigtype_to_trash(Request $request){

        $gig_id = $request->input('gig_id');

        $affected_rows = Gigtype::where('id', $gig_id)->update(['status' => 'disabled']);

        if($affected_rows)
            echo '1';
        else
            echo '0';
    }

    public function trashGigs(Request $request){

        $gigs = Gig::where(['status' => 'disabled','active'=> 0])->orderBy('created_at', 'desc')->get();

        $data['gigs'] = $gigs;
        return view('pages.admin.trashGigs')->with($data);
    }

    public function catTrashGigs(){

        $gigstypes = Gigtype::where('status', 'disabled')->orderBy('created_at', 'desc')->get();

        $data['gigstypes'] = $gigstypes;
        return view('pages.admin.catTrashGigs')->with($data);
    }




    public function undoGig(Request $request){

        $gig_id = $request->input('gig_id');

        $affected_rows = Gig::where('id', $gig_id)->update(['status' => 'enabled']);

        if($affected_rows)
            echo '1';
        else
            echo '0';

    }


    public function catUndoGig(Request $request){

        $gig_id = $request->input('gig_id');

        $affected_rows = Gigtype::where('id', $gig_id)->update(['status' => 'enabled']);

        if($affected_rows)
            echo '1';
        else
            echo '0';

    }


    function deleteQuestion(Request $request){

        $question_id = $request->input('question_id');
        $data = Gig_question::where('id', $question_id)->delete();

        if($data)
            return true;
        else
            return false;

    }

    public function reject_suggestion(Request $request){
        $admin = Auth::admin()->get();
        $message = 'Reject Favor';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $gig_id = $request->input('gig_id');
        $reject_reason = $request->input('reject_reason');
        $user = Gig::where(['id'=>$gig_id])->first();
        $user_details = DB::table('users')->where('id',$user->user_id)->first();
        $reject_data = DB::table('gig_reject_reason')->insert([
           'reason' => $reject_reason,
            'created_at' => date('y-m-d H:i:s'),
            'favor_id'   => $gig_id
        ]);
        $email = $user_details->email;
        $uuid = $user->uuid;
        $link = "https://4slash.com/agency/gig-suggestion?action=update&gigUUID=$uuid";
        $data = [
            'gig_id'        => $gig_id,
            'reject_reason' => $reject_reason,
            'agency_name'   => $user_details->username,
            'link'          => $link
        ];
        $from = 'marketplace@4slash.com';
        $sub = 'gig "rejection" | Agency';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
        $view = view('RejectionMail', $data)->render();
//        /*$body = 'Agency has done the job <a href="'.route('adminorder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]).'?ref=notification">Job done by agency </a>';*/
        $mail = mail($email, $sub, $view, $headers);
        $status = Gig::where(['id'=> $gig_id])->update(['rejection'=> 1]);
        if($status){
            return 1;
        }else{
            return 0 ;
        }

    }

    public function filter_search(Request $request){
        $gig_id = $request->input('gig-id');
//        $gigs = Gig::where(['suggested_by' => $gig_id])->orderBy('created_at', 'desc')->get();
        if($gig_id != "all") {
            $gigs = DB::table('gigs')
                ->join('users', 'gigs.suggested_by', '=', 'users.id')
                ->join('gigtypes', 'gigs.gigtype_id', '=', 'gigtypes.id')
                ->select('users.*', 'gigs.*', 'gigtypes.name')
                ->orderBy('gigs.created_at', 'desc')
                ->where(['gigs.suggested_by' => $gig_id, 'gigs.rejection' => 0, 'gigs.active' => 0,'gigs.status'=>'disabled'])
                ->get();
        }else{
            $gigs = DB::table('gigs')
                ->join('users', 'gigs.suggested_by', '=', 'users.id')
                ->join('gigtypes', 'gigs.gigtype_id', '=', 'gigtypes.id')
                ->select('users.*', 'gigs.*', 'gigtypes.name')
                ->orderBy('gigs.created_at', 'desc')
                ->where(['gigs.rejection' => 0, 'gigs.active' => 0,'gigs.status'=>'disabled'])
                ->get();
        }
        header("Content-Type : application/json");
        return $gigs;
    }

    public function filter_search_all(Request $request){
        $gig_id = $request->input('gig-id');
//        $gigs = Gig::where(['suggested_by' => $gig_id])->orderBy('created_at', 'desc')->get();
        if($gig_id != "all") {
            $gigs = DB::table('gigs')
                ->join('users', 'gigs.update_by', '=', 'users.id')
                ->join('gigtypes', 'gigs.gigtype_id', '=', 'gigtypes.id')
                ->join('agency_additional', 'gigs.suggested_by', '=', 'agency_additional.agency_id')
                ->select('users.username', 'gigs.*', 'gigtypes.name','agency_additional.agency_name')
                ->orderBy('gigs.created_at', 'desc')
                ->where(['gigs.status' => 'enabled', 'gigs.suggested_by' => $gig_id])
                ->get();
        }else{
            $gigs = DB::table('gigs')
                ->join('users', 'gigs.update_by', '=', 'users.id')
                ->join('gigtypes', 'gigs.gigtype_id', '=', 'gigtypes.id')
                ->join('agency_additional', 'gigs.suggested_by', '=', 'agency_additional.agency_id')
                ->select('users.username', 'gigs.*', 'gigtypes.name','agency_additional.agency_name')
                ->orderBy('gigs.created_at', 'desc')
                ->where(['gigs.status' => 'enabled'])
                ->get();
        }
        /*header("Content-Type : application/json");*/
        return $gigs;
    }
}