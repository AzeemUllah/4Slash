<?php

namespace App\Http\Controllers;
use App\Notification;
use App\Gig_question;
use App\Order;
use App\Gig;
use App\Package;
use App\PackageOption;
use App\GigImages;
use App\FavouriteGigs;
use App\Admin;
use App\User;
use App\Message;
use App\Gigtype;
use App\OrderAddon;
use App\PackageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Gig_addon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\CustomOrder;

use Exception;

class MyOrdersController extends Controller
{
    private function askForOrderModification($orderNo)
    {
        $order = Order::where(['order_no' => $orderNo])->first();

        if(!is_object($order))
        {
            return ("Something went wrong please try again later.");
        }

        $order->status = 'pending';
        $order->save();
    }

    public function index(Request $request)
    {
        $show_rating22=0;
        $show_rating23=0;

        $user = Auth::user()->get();

        $data['user'] = $user;
        $featuredGigs = Gig::where(['active' => 1,'status' => 'enabled','vacation' => 0])->orderByRaw("RAND()")->take(3)->get();
        foreach ($featuredGigs as $featuredGig) {

            $featuredGig['gigtype_slug'] = Gigtype::where(['id' => $featuredGig->gigtype_id])->first()->slug;
            $featuredGig['thumbnail'] = GigImages::getGigThumbnail($featuredGig->id);
            $featuredGig['sale_count'] = Order::where(['gig_id'=>$featuredGig->id])->count();

            if($user){
                $favouriteGig = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $featuredGig->id])->first();

                if(is_object($favouriteGig)) {
                    $featuredGig['favourite'] = ' collected';
                    $featuredGig['my_fav'] = true;
                } else {
                    $featuredGig['favourite'] = '';
                    $featuredGig['my_fav'] = false;
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredGig->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating22 = $avg_rate/$count_avg_rows;
                    $gig['show_rating22'] = round($show_rating22,1) ;
                }
                else{
                    $gig['show_rating22'] = 0;
                }
            }

        }

        $featuredpackages = Package::where(['active' => 1,'status' => 'enabled' ,'vacation' => 0])->orderByRaw("RAND()")->take(3)->get();
        foreach ($featuredpackages as $featuredpackage){
            $featuredpackage['thumbnail'] = PackageOption::getPackageThumbnail($featuredpackage->id);
            $featuredpackage['package_bronze'] = DB::table('package_bronze')->where('package_id',$featuredpackage->packages_id)->first();
            $featuredpackage['package_silver'] = DB::table('package_silver')->where('package_id',$featuredpackage->packages_id)->first();
            $featuredpackage['package_gold'] = DB::table('package_gold')->where('package_id',$featuredpackage->packages_id)->first();
            if($user){
                $favouriteGig = FavouriteGigs::where(['user_id' => $user->id, 'gig_id' => $featuredpackage->id])->first();

                if(is_object($favouriteGig)) {
                    $featuredpackage['favourite'] = ' collected';
                    $featuredpackage['my_fav'] = true;
                } else {
                    $featuredpackage['favourite'] = '';
                    $featuredpackage['my_fav'] = false;
                }
                $rating = DB::table('order_feedback')->where('gig_id',$featuredpackage->id)->get();
                $count_avg_rows = count($rating);
                $avg_rate = 0;


                foreach($rating as $rate){
                    $avg_rate += $rate->order_feedback;
                }
                if($avg_rate>0)
                {
                    $show_rating23 = $avg_rate/$count_avg_rows;
                    $gig['show_rating23'] = round($show_rating23,1) ;
                }
                else{
                    $gig['show_rating23'] = 0;
                }
            }

        }

        $status = $request->input('status');

        if(isset($_GET['id']))
            Notification::where('id', $_GET['id'])->update(['seen' => 1]);

        $pendingOrders = Order::where(['user_id' => $user->id, 'status' => 'pending', 'type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'pending', 'type' => 'package'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdone', 'type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdone', 'type' => 'package'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdonebyagency', 'type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdonebyagency', 'type' => 'package'])
                                 ->orWhere(['user_id'=>$user->id, 'status' => 'review', 'type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'review', 'type' => 'package'])
                                ->orderby('created_at', 'desc')->get();
        $pendingsingleorder = Order::where(['user_id' => $user->id, 'status' => 'pending','type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'review', 'type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdonebyagency', 'type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'pending','type' => 'package'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'review', 'type' => 'package'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdonebyagency', 'type' => 'package'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdone', 'type' => 'package'])
                                ->orderby('created_at','desc')->first();
        $completedOrders = Order::where(['user_id' => $user->id, 'status' => 'complete', 'type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'complete', 'type' => 'package'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'complete', 'type' => 'custom'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdone', 'type' => 'gig'])
                                ->orderby('created_at', 'desc')->get();
        $canceledOrders = Order::where(['user_id' => $user->id, 'status' => $status, 'type' => 'gig'])
                                ->orWhere(['user_id' => $user->id, 'status' => $status, 'type' => 'package'])
                                ->orWhere(['user_id' => $user->id, 'status' => $status, 'type' => 'custom'])
                                ->orderby('created_at', 'desc')->get();
        $customOrders = Order::where(['user_id' => $user->id, 'status' => 'pending', 'type' => 'custom'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdone', 'type' => 'custom'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'jobdonebyagency', 'type' => 'custom'])
                                ->orWhere(['user_id' => $user->id, 'status' => 'review', 'type' => 'custom'])
                               ->orderby('created_at', 'desc')->get();
        foreach($customOrders as $order){
            $total_custom_orders = count($customOrders);
            if($total_custom_orders > 0) {
                $order['orderStatus'] = CustomOrder::where(['order_id' => $order->id])->first();
            }
        }

        if($status == 'cancel'){
           $total_cancled_orders = count($canceledOrders);
        if( $total_cancled_orders > 0) {
            foreach ($canceledOrders as $order) {
                if($order->type == 'gig') {
                    $order['gig'] = Gig::where(['id' => $order->gig_id])->first();

                } else if($order->type == 'package') {
                    $order['package'] = Package::where(['packages_id' => $order->packages_id])->first();

                }
            }
        }
        }
        else{
        if(count($pendingOrders) > 0) {
            foreach ($pendingOrders as $order) {
                if($order->type == 'gig') {
                    $order['gig'] = Gig::where(['id' => $order->gig_id])->first();
                } else if($order->type == 'package') {
                    $order['package'] = Package::where(['packages_id' => $order->packages_id])->first();

                }
            }
        }

        if(count($completedOrders) > 0) {
            foreach ($completedOrders as $order) {
                if($order->type == 'gig') {
                    $order['gig'] = Gig::where(['id' => $order->gig_id])->first();

                } else if($order->type == 'package') {
                    $order['package'] = Package::where(['packages_id' => $order->packages_id])->first();

                }
                else if($order->type == 'custom') {
                    $order['custom'] = CustomOrder::where(['order_id' => $order->id])->first();

                }
            }
        }

        }
        $count_pending = Order::where(['user_id'=> $user->id,'status'=>'pending'])->get()->count();
        $count_review = Order::where(['user_id'=> $user->id,'status'=>'review'])->get()->count();
        $count_complete = Order::where(['user_id'=> $user->id,'status'=>'complete'])->get()->count();
        $data['count_pending'] = $count_pending;
        $data['count_complete'] = $count_complete;
        $data['count_review'] = $count_review;
        $data['status'] = $status;
        $data['canceledOrders'] = $canceledOrders;
        $data['pendingOrders'] = $pendingOrders;
        $data['show_rating22']=$show_rating22;
        $data['show_rating23']=$show_rating23;
        $data['completedOrders'] = $completedOrders;
        $data['featuredGigs'] = $featuredGigs;
        $data['featuredPackages'] = $featuredpackages;
        $data['customOrders'] = $customOrders;
        if(!empty($pendingsingleorder)) {
            $data['singleorder'] = $pendingsingleorder->order_no;
        }else{
            $data['singleorder'] = '';
        }
       /* $data['customOrdersStatus'] = $customorderStatus;*/
        return view('pages.myorders')->with($data);
    }

    public function searchOrders(Request $request){

        $keyword =  $request->input('keyword');

        $type =  $request->input('type');
        if($type == '#home') {
            $status = 'pending';
            $jobDone = 'jobDone';
            $data = Order::where(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => $status])
                          ->orWhere(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => $jobDone])
                          ->orWhere(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => 'review'])
                          ->orWhere(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => 'jobdonebyagency'])->get();
            if(!empty($data))
                return response()->json($data);
            else
                return response()->json(['result' => 2]);
        }
        else if($type == '#custom') {
            $status = 'complete';
            $jobDone = '';
            $data = Order::where(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => $status])->orWhere(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => $jobDone])->get();
        }
        else if($type == '#profile') {
            $status = 'pending';
            $jobDone = 'jobDone';
            $order_type = 'custom';
            $data = Order::where(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => $status, 'type' => $order_type])
                            ->orWhere(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => 'review','type' => $order_type])
                            ->orWhere(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => 'jobdonebyagency','type' => $order_type])->get();
        }
        elseif($type == 'Cancel')
        {
            $status = 'cancel';
            $data = Order::where(['order_no' => $keyword, 'user_id' => Auth::user()->get()->id, 'status' => $status])->get();
            if(!empty($data))
                return response()->json($data);
            else
                return response()->json(['result' => 0]);
        }


        if(!empty($data))
            return response()->json($data);
        else
            return response()->json(['result' => 0]);
    }


    public function selectedOrders(Request $request){

        $type =  trim($request->input('type'));


        if($type == 'in Bearbeitung') {
            $status = 'pending';
            $jobDone = 'jobDone';
            $type = 'gig';
            $data = Order::where(['user_id' => Auth::user()->get()->id, 'status' => $status, 'type' => 'gig'])
                         ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => $jobDone, 'type' => 'gig'])
                        ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => 'review', 'type' => 'gig'])
                        ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => 'jobdonebyagency', 'type' => 'gig'])
                        ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => $jobDone, 'type' => 'package'])
                        ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => $status, 'type' => 'package'])
                        ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => 'review', 'type' => 'package'])
                        ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => 'jobdonebyagency', 'type' => 'package'])->get();
            if(!empty($data))
                return response()->json($data);
            else
                return response()->json(['result' => 0]);
        }
        else if($type == 'Fertig') {
            $status = 'complete';
            $jobDone = '';
            $type = 'gig';

            $data = Order::where(['user_id' => Auth::user()->get()->id, 'status' => $status, 'type' => $type])
                          ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => $status, 'type' => $type])->get();
            if(!empty($data))
                return response()->json($data);
            else
                return response()->json(['result' => 0]);
        }
        else if($type == 'Individuell') {
            $status = 'pending';
            $jobDone = '';
            $order_type = 'custom';
            $data = Order::where(['user_id' => Auth::user()->get()->id, 'status' => $status, 'type' => $order_type])
                ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => 'review','type' => $order_type])
                ->orWhere(['user_id' => Auth::user()->get()->id, 'status' => 'jobdonebyagency','type' => $order_type])->get();
            if(!empty($data))
                return response()->json($data);
            else
                return response()->json(['result' => 0]);
        }
        elseif($type == 'Cancel')
        {
            $status = 'cancel';
            $data = Order::where(['user_id' => Auth::user()->get()->id, 'status' => $status])->get();
            if(!empty($data))
                return response()->json($data);
            else
                return response()->json(['result' => 0]);
        }

    }

    function get_messages($orderno){

        $user = Auth::user()->get();
        $admin = Admin::where('type','admin')->first();
        $order = Order::where(['user_id' => $user->id,'order_no' => $orderno])->first();
        $messages = Message::where(['order_id' => $order->id, 'user_id' => $user->id])->orWhere(['order_id' => $order->id, 'to_id' => $user->id])->orderby('created_at', 'desc')->get();

        $count = Message::where(['order_id' => $order->id, 'user_id' => $user->id])->orWhere(['order_id' => $order->id, 'to_id' => $user->id])->orderby('created_at', 'desc')->count();
        foreach ($messages as $message) {

            if ($message->user_id == $user->id) {
                if ($user){
                    $message['from'] = 'me';
                    $message['from_user_name_first_char'] = strtoupper($user->username[0]);
                    $message['profile_image'] = $user->profile_image;
                }
            } else if ($message->to_id == $user->id) {
                if($admin){
                    $message['from'] = 'him';
                    $message['from_user_name_first_char'] = strtoupper($admin->username[0]);
                    $message['profile_image'] = $admin->profile_image;
                }

            }

            unset($message->user_id);
        }

        $data['messages'] = $messages;
        $data['count'] = $count;

        return $data;

    }


    function count_msgs($orderno){

        $user = Auth::user()->get();
        $order = Order::where(['user_id' => $user->id,'order_no' => $orderno])->first();
        $count = Message::where(['order_id' => $order->id, 'user_id' => $user->id])->orWhere(['order_id' => $order->id, 'to_id' => $user->id])->orderby('created_at', 'desc')->count();

        return $count;

    }
    
    public function getMyOrder($orderno) {

        Session::put('order_no', $orderno);
        $user = Auth::user()->get();
        $order = Order::where(['user_id' => $user->id,'order_no' => $orderno])->first();
        $order_details = DB::table('orders')
            ->leftJoin('order_feedback', 'orders.order_no', '=', 'order_feedback.order_id')
            ->select('order_feedback.order_feedback')
            ->where('order_feedback.order_id',$orderno)
            ->first();
        $admin = Admin::where('type','admin')->first();
        $order['date']= date('d.m.Y', strtotime($order->created_at));
        if($order->type != 'custom' && $order->type != 'package'){

            $gigs = Gig::where(['id' => $order->gig_id])->first();
            $orderAddons = OrderAddon::where('order_id', $order->id)->get();
            foreach ($orderAddons as $orderaddon){
                $order['gigAddon'] = Gig_addon::where('id',$orderaddon->addon_id)->get();
            }
            $order['gig'] = $gigs;
            $order['orderAddon'] = $orderAddons;
        }

        if($order->type == 'package'){

            $package = Package::where('packages_id',$order->packages_id)->first();
            $order['package'] = $package;


        }

        if(!empty($order)) {
            
            $customAmount = CustomOrder::select('status','amount_offer', 'total_days')->where(['order_id' => $order->id])->first();
            $messages = Message::where(['order_id' => $order->id, 'user_id' => $user->id])->orWhere(['order_id' => $order->id, 'to_id' => $user->id])->orderby('created_at', 'desc')->get();
            $count_user_messages = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->count();

            $questions_answers = DB::table('order_questions_answers')->select('gig_question_id', 'answers')->where(['order_id' => $order->id])->get();

            foreach ($questions_answers as $ques_ans) {
                $ques_ans->question = Gig_question::where(['id' => $ques_ans->gig_question_id])->first()->question;
                unset($ques_ans->gig_question_id);
            }

            foreach ($messages as $message) {
                if ($message->user_id == $user->id) {
                    if ($user){
                        $message['from'] = 'me';
                    $message['from_user_name_first_char'] = strtoupper($user->username[0]);
                    $message['profile_image'] = $user->profile_image;
                }
                } else if ($message->to_id == $user->id) {
                    if($admin){
                    $message['from'] = 'him';
                    $message['from_user_name_first_char'] = strtoupper($admin->username[0]);
                     $message['profile_image'] = $admin->profile_image;
                    }

                }

                unset($message->user_id);
            }


            unset($order->gig_id);
            unset($order->gig_owner_id);
            unset($order->user_id);
            unset($order->id);

            $order['ques_ans'] = $questions_answers;
            $order['messages'] = $messages;
            $order['customOrder'] = $customAmount;
            $order['user'] = $user->username;
            $order['admin'] = $admin->username;
            $order['order_details'] = $order_details;
            $order['message_count'] = $count_user_messages;
            return $order;
        }

    }

    public function postMessage(Request $request)
    {
        $files = $request->input('files');
        $new_file_name = explode(",",$files);
        $dropfiles = $request->input('dropfiles');
        $new_drop_files = explode(",",$dropfiles);
        $user = Auth::user()->get();
        $admin = Admin::where('type', 'admin')->first();

        $orderNo = $request->input('order-no');
        $order = Order::where(['order_no' => $orderNo])->first();
            $txtMessage = '<pre class="font-family">' . $request->input('message') . '</pre>';
            if(!empty($request->input('message'))) {
                $message = new Message();
                $message->body = $txtMessage;
                $message->order_id = $order->id;
                $message->user_id = $user->id;
                $message->to_id = $admin->id;
                $message->save();
            }
            if(!empty($request->input('files'))) {
                foreach ($new_file_name as $file) {
                    $file_url = '<a download class="drag_file" target="_blank" href="' . url() . '/files/orders/messages/' . $file . '">' . '<i class="fa fa-file" style="padding: 4px;"></i>' . $file . '</a>';
                    $file_data = [
                        'file_name' => $file_url,
                        'to_id' => $admin->id,
                        'user_id' => $user->id,
                        'order_id' => $order->id
                    ];
                    $message_file = DB::table('message_files')->insertGetId($file_data);
                    if ($message_file) {
                        $txtMessage = '<pre class="font-family">' . $request->input('message') . '</pre>';
                        $user = Auth::user()->get();
                        $admin = Admin::where('type', 'admin')->first();
                        $message = new Message();
                        $message->body = $file_url;
                        $message->order_id = $order->id;
                        $message->user_id = $user->id;
                        $message->to_id = $admin->id;
                        $message->save();
                    }
                }
            }

        if(!empty($dropfiles)) {
            foreach ($new_drop_files as $new_drop_file) {
                $file_url = '<a class="drag_file" target="_blank" href="' . $new_drop_file . '">' . '<i class="fa fa-file" style="padding: 4px;"></i>' . $new_drop_file . '</a>';
                $file_data = [
                    'file_name' => $file_url,
                    'to_id' => $admin->id,
                    'user_id' => $user->id,
                    'order_id' => $order->id
                ];
                $message_file = DB::table('message_files')->insertGetId($file_data);
                if ($message_file) {
                    $txtMessage = '<pre class="font-family">' . $request->input('message') . '</pre>';
                    $user = Auth::user()->get();
                    $admin = Admin::where('type', 'admin')->first();
                    $message = new Message();
                    $message->body = $file_url;
                    $message->order_id = $order->id;
                    $message->user_id = $user->id;
                    $message->to_id = $admin->id;
                    $message->save();
                }
            }
        }


            //send Notification
            $not_id = Notification::sendNotification($order->id, $admin->id, '<a href="'.route('adminorder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]).'?ref=notification">You have a new message.</a>');
            Notification::where('id', $not_id)->update(['message' => '<a href="'.route('adminorder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]).'?ref=notification&id='.$not_id.'">You have a new message.</a>']);

            //send Mail
            if($message->save())
            {
                $num = md5(time());
                $num = "_001_".$num."_";
                $from=$user->email;
                $data = [
                    'name' => $user->username,
                    'email' => $user->email,
                    'message' => $txtMessage,
                ];
                $sub='Chat message user';
                // $cc=$_POST['cc'];
                // $bcc=$_POST['bcc'];
//        $mailbody = "You have a new message: "."\n" .$txtMessage;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                // $headers .= 'Cc: '.$cc. "\r\n";
                //$headers .= 'Bcc: '.$bcc. "\r\n";
                $view = view('usermessageemail', $data)->render();
                mail('marketplace@4slash.com',$sub,$view,$headers);
            }

            return [

                'message' => $message->body,
                'user'    => $user->username,
                'username' => $user->username, 'profile_image' => $user->profile_image
            ];

    }

    public function postMessageFiles(Request $request){
        $order_no = Session::get('order_no');
        if(Input::hasFile('files')) {
            $files = Input::file('files');
            // Making counting of uploaded images
            // start count how many uploaded
            $uploadcount = 0;
            foreach($files as $file) {
                    $destinationPath = public_path().'/files/orders/messages/';
                    $filename = $file->getClientOriginalName();
                    $name = rand(0, 1000) . 'ok' . time().$filename;
                    $upload_success = $file->move($destinationPath, $filename);
                    $uploadcount ++;
            }
            return response()->json(true, 200);
        } else {
            return response()->json(false, 200);
        }

    }

    public function GetorderMessageFiles(Request $request){
        $ids = $request->input('data');
        $message_files = new \stdClass();
        $message_input = '';
        if($request->input('message') != ''){
            $message_input .='<pre class="font-family">'.$request->input('message').'</pre>'.'<br>';
        }
        if(is_array($ids)){
            foreach($ids as $id){
                $message_files = DB::table('message_files')->where('id',$id)->first();
                $message_input .= $message_files->file_name.'<br>';
            }

        }


        $order = Order::where('id', $message_files->order_id)->first();
        $user = Auth::user()->get();
        $admin = Admin::where('type','admin')->first();
        $message = new Message();
        $message->body = $message_input;
        $message->order_id = $order->id;
        $message->user_id = $user->id;
        $message->to_id = $admin->id;
        $message->save();
        //send Notification
        $not_id = Notification::sendNotification($order->id, $admin->id, '<a href="'.route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]).'?ref=notification">You have a new message.</a>');
        Notification::where('id', $not_id)->update(['message' => '<a href="'.route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]).'?ref=notification&id='.$not_id.'">You have a new message.</a>']);

        //send Mail
        if($message->save())
        {
            $num = md5(time());
            $num = "_001_".$num."_";
            $from=$user->email;
            $data = [
                'name' => $user->username,
                'email' => $user->email,
                'message' => $message_input,
            ];
            $sub='Chat message user';
            // $cc=$_POST['cc'];
            // $bcc=$_POST['bcc'];
//        $mailbody = "You have a new message: "."\n" .$txtMessage;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
            // $headers .= 'Cc: '.$cc. "\r\n";
            //$headers .= 'Bcc: '.$bcc. "\r\n";
            $view = view('usermessageemail', $data)->render();
            mail('marketplace@4slash.com',$sub,$view,$headers);
        }

        return [

            'message' => $message->body,
            'input'  => $request->input('message'),
            'user'   => $user->username
        ];

    }

    public function orderAcknowledge(Request $request)
    {
        $orderNo = $request->input('order-no');
        $admin = Admin::where('type','admin')->first();
        $user = Auth::user()->get();
        try {
            $order = Order::where(['order_no' => $orderNo])->first();
            $agency = User::where(['type'=>'agency', 'id' => $order->assigned_to])->first();
            $users = array('user','admin','agency');
            $data['user'] = $user;
            $data['agency'] = $agency;
            $data['admin'] = $admin;
            $order->acknowledge();
            for($i = 0; $i<= 2; $i++)
            {

                $from='marketplace@4slash.com';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
                if($users[$i]=='user')
                {
                    $data = [
                        'mail' => 'acknowledge',
                        'type'      => 'user',
                        'order_no' => $order->order_no,
                        'gig'      => $order->custom_order_products,
                        'date'     => $order->created_at,
                        'user'     => $user->username,
                    ];
                    $to = $user->email;
                    $sub = 'Order "ready" | 4slash';
                    $body = view('jobDoneMail', $data)->render();
                    mail($to, $sub, $body, $headers);


                }
                else if($users[$i]=='agency')
                {

                    $data_agency=[
                        'mail' => 'acknowledge',
                        'type'               => 'agency',
                        'order_no'           => $order->order_no,
                        'orderUUID'          => $order->uuid,
                        'date'               => $order->created_at,
                        'gig_amount'         => $order->amount,
                        'user'               => $user->username,
                        'agency'             => $agency->username,
                        'user_email'         => $user->email

                    ];
                    $view = View('jobDoneMail',$data_agency)->render();
                    $to = $agency->email;
                    $subAgency = 'Order "ready" | 4slash';

                    mail($to, $subAgency, $view, $headers);

                }
                else if($users[$i]=='admin')
                {
                    $data_admin =[
                        'mail'               => 'acknowledge',
                        'type'               => 'admin',
                        'order_no'           => $order->order_no,
                        'orderUUID'          => $order->uuid,
                        'date'               => $order->created_at,
                        'gig_amount'         => $order->amount,
                        'user'               => $user->username,
                        'agency'             => $agency->username,
                        'user_email'         => $user->email

                    ];

                    $view = View('jobDoneMail',$data_admin)->render();
                    $to = 'info@ad-print.de';
                    $subAdmin = 'Order completed | 4slash';

                    mail($to, $subAdmin, $view, $headers);
                }


            }

            /* Send Notification to the Agency*/
            $not_id = DB::table('notifications')->insertGetId([
                'order_id' => $order->id,
                'user_id'  => $agency->id,
                'message'  => '<a href="'.route('agencySingleOrder',['orderno' => $orderNo, 'orderuuid' => $order->uuid]).'?ref=notification">User has acknowledged the order</a>'
            ]);

            DB::table('notifications')->where('id', $not_id)->update([
                'message' => '<a href="'.route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]).'?ref=notification&id='.$not_id.'">User has acknowledge the order</a>'
            ]);

            /* Send notification to the admin*/
            $not_id_admin = Notification::sendNotification($order->id, $admin->id, '<a href="'.route('adminorder',['orderno' => $orderNo, 'orderuuid' => $order->uuid]).'?ref=notification">User has acknowledge the order');
            Notification::where('id', $not_id_admin)->update(['message' => '<a href="'.route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]).'?ref=notification&id='.$not_id_admin.'">User has acknowledge the order</a>']);

            $data = [
                'success' => $request->session()->flash('complete', 'Dear 4slash customer, '.$user->username.','),
                'order_no' => $request->session()->flash('ordercomplete','your order '. $order->order_no. ' has been successfully completed.')

            ];
            return redirect()->route('myorders', ['orderno' => $order->order_no])->with($data);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['msg' => 'Cannot acknowledge your order please try again.']);
        }
    }

    public function orderAskForModification(Request $request) {

        $orderNo = $request->input('order-no');
        $order = Order::where('order_no', $orderNo)->first();
        $old_review = $order->order_review;
        $new_review = $old_review+1;
        $user = Auth::user()->get();

        if($request->ajax())
        {
            try
            {
                $this->askForOrderModification($orderNo);
                $order->status = 'review';
                $order->order_review = $new_review;
                $order->save();
                $admin = Admin::where('type','admin')->first();
                $agency = User::where(['type' => 'agency', 'id' => $order->assigned_to])->first();

                /* SEND NOTIFICATION TO THE ADMIN*/
                $not_id_admin = Notification::sendNotification($order->id, $admin->id, '<a href="'.route('adminorder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]).'?ref=notification">Order modification</a>');
                Notification::where('id', $not_id_admin)->update(['message' => '<a href="'.route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]).'?ref=notification&id='.$not_id_admin.'">Order modification</a>']);

//                /* SEND NOTIFICATION TO THE AGENCY*/
//                $id_agency = Notification::sendNotification($order->id, $agency->id, '<a href="'.route('agencySingleOrder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]).'?ref=notification">User asked for modification</a>');
//                Notification::where('id', $id_agency)->update(['message' => '<a href="'.route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]).'?ref=notification&id='.$id_agency.'">User asked for modification</a>']);
                $not_id = DB::table('notifications')->insertGetId([
                    'order_id' => $order->id,
                    'user_id'  => $agency->id,
                    'message'  => '<a href="'.route('agencySingleOrder',['orderno' => $orderNo, 'orderuuid' => $order->uuid]).'?ref=notification">Order modification</a>'
                ]);

                DB::table('notifications')->where('id', $not_id)->update([
                    'message' => '<a href="'.route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]).'?ref=notification&id='.$not_id.'">Order modification</a>'
                ]);


                $email_data =[
                    'mail_status'        => 'modification',
                    'order_no'           => $order->order_no,
                    'orderUUID'          => $order->uuid,
                    'date'               => $order->created_at,
                    'gig_amount'         => $order->amount,
                    'user'               => $user->username,
                    'agency'             => $agency->username,
                    'agency_email'       => $agency->email,
                    'user_email'         => $user->email,
                ];

               
                $this->send_email($to = $user->email, $email_data, $type = 'admin');
                $this->send_email($to = $agency->email, $email_data, $type = 'agency');

                return ['status' => true, 'msg' => 'Your order has been marked for modification.'];
            }
            catch(\Exception $e)
            {
                return ['status' => false, 'msg' => $e];
            }
        }

        try
        {
            $this->askForOrderModification($orderNo);

            return Redirect::back();
        }
        catch(\Exception $e)
        {
            return Redirect::back()->withErrors(['msg' => $e]);
        }

    }


    public function send_email($to, $data, $type = ''){

        $from   ='marketplace@4slash.com';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";

        if($type == 'admin')
            $subj = 'Order completed| 4slash';
        elseif($type = 'agency')
            $subj = '"Change desired" | 4slash';

        $data['type'] = $type;
        /* Render Email View */
        $msg = View('pages.emails.ordersModification', $data)->render();

        $response = mail($to, $subj, $msg, $headers);

        if($response)
            return true;
        else
            return false;


    }

    public function order_feedback(Request $request){
        $feed_id = $request->input('feed_id');
        $order_id = $request->input('order_id');
        $gig_id=$request->input('gig_id');
        $order = Order::where('order_no',$order_id)->first();
        $feedback = DB::table('order_feedback')->insert([
            'user_id'        => $order->user_id,
            'agency_id'      => $order->assigned_to,
            'order_id'       => $order->order_no,
            'gig_id'         =>$gig_id,
            'order_feedback' => $feed_id,
        ]);
        if($feedback){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function complaint(Request $request){
        $complaint = $request->input('complt_txt');
        $ordernumber = $request->input('order_no');
        $complaint_data = DB::table('order_complaints')->insert([
            'order_no'      => $ordernumber,
            'complaint'       => $complaint,
        ]);
        $data = [
            'order_no'      => $ordernumber,
            'complaint'       => $complaint,
        ];
        $to = "marketplace@4slash.com";
        $from   ='marketplace@4slash.com';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
        $subj = "complaint | Order Number";
        /* Render Email View */
        $msg = View('complaint_mail',$data)->render();
        mail($to, $subj, $msg, $headers);
    }

}
