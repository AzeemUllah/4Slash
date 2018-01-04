<?php

namespace App\Http\Controllers;
use App\Order;
use App\Gig_addon;
use App\Package;
use App\PackageOption;
use App\PackageType;
use App\Gig_question;
use App\GigImages;
use App\Gigtype_Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Agency;
use App\Gig;
use Illuminate\Support\Facades\Input;
use App\Express_addons;
use App\Admin;
use App\Gigtype;
use App\CustomOrder;
use App\User;
use App\Message;
use App\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AgencyOrdersController extends Controller
{
    public function getOrdersList(Request $request)
    {
        $agency = Auth::agency()->get();
        $orders = DB::table('orders')
            ->join('gigs', 'gigs.id', '=', 'orders.gig_id')
            ->where(['orders.type' => 'gig', 'orders.assigned_to' => $agency->id, 'orders.status' => $request->input('status')])
            ->orwhere(['orders.type' => 'package', 'orders.assigned_to' => $agency->id, 'orders.status' => $request->input('status')])
            ->orWhere(['orders.type' => 'gig', 'orders.assigned_to' => $agency->id, 'orders.status' => 'jobdone'])
            ->orWhere(['orders.type' => 'gig', 'orders.assigned_to' => $agency->id, 'orders.status' => 'review'])
            ->orWhere(['orders.type' => 'gig', 'orders.assigned_to' => $agency->id, 'orders.status' => 'jobdonebyagency'])
            ->orWhere(['orders.type' => 'package', 'orders.assigned_to' => $agency->id, 'orders.status' => 'jobdone'])
            ->orWhere(['orders.type' => 'package', 'orders.assigned_to' => $agency->id, 'orders.status' => 'review'])
            ->orWhere(['orders.type' => 'package', 'orders.assigned_to' => $agency->id, 'orders.status' => 'jobdonebyagency'])
            ->select('orders.*', 'gigs.title')
            ->get();

        $completed_orders = DB::table('orders')
            ->leftjoin('gigs', 'gigs.id', '=', 'orders.gig_id')
            ->leftjoin('packages', 'packages.packages_id', '=', 'orders.packages_id')
            ->where(['orders.assigned_to' => $agency->id, 'orders.status' => $request->input('status')])
            ->select('orders.*', 'gigs.title as gigtitle', 'packages.title as packagetitle')
            ->get();

        $reviewed_orders = DB::table('orders')
            ->leftjoin('gigs', 'gigs.id', '=', 'orders.gig_id')
            ->leftjoin('packages', 'packages.packages_id', '=', 'orders.packages_id')
            ->where(['orders.assigned_to' => $agency->id, 'orders.status' => $request->input('status')])
            ->select('orders.*', 'gigs.title as gigtitle', 'packages.title as packagetitle')
            ->get();
        if ($request->input('status') == 'review') {
            $count_review_orders = count($reviewed_orders);
            $data['count_reviewdorders'] = $count_review_orders;
            $data['reviewdorders'] = $reviewed_orders;
        }
        if ($request->input('status') == 'complete') {
            $count_complete_orders = count($completed_orders);
            $data['count_completedorders'] = $count_complete_orders;
            $data['completedorders'] = $completed_orders;
        }
        $Packageorders = DB::table('orders')
            ->join('packages', 'packages.packages_id', '=', 'orders.packages_id')
            ->where(['orders.type' => 'package', 'orders.assigned_to' => $agency->id, 'orders.status' => $request->input('status')])
            ->orWhere(['orders.type' => 'package', 'orders.assigned_to' => $agency->id, 'orders.status' => 'review'])
            ->orWhere(['orders.type' => 'package', 'orders.assigned_to' => $agency->id, 'orders.status' => 'jobdonebyagency'])
            ->orWhere(['orders.type' => 'package', 'orders.assigned_to' => $agency->id, 'orders.status' => 'jobdone'])
            ->select('orders.*', 'packages.title')
            ->get();
        $customOrders = Order::where(['type' => 'custom', 'assigned_to' => $agency->id, 'status' => $request->input('status')])
            ->orWhere(['type' => 'custom', 'assigned_to' => $agency->id, 'status' => $request->input('status')])
            ->orWhere(['type' => 'custom', 'assigned_to' => $agency->id, 'status' => 'review'])
            ->orWhere(['type' => 'custom', 'assigned_to' => $agency->id, 'status' => 'jobdone'])
            ->orWhere(['type' => 'custom', 'assigned_to' => $agency->id, 'status' => 'jobdonebyagency'])->get();
        if ($request->input('status') == 'pending') {
            $count_pending_orders = count($orders);
            $count_package_ordrs = count($Packageorders);
            $count_custom_orders = count($customOrders);
            if ($count_package_ordrs > 0 || $count_custom_orders > 0 || $count_pending_orders > 0) {
                $data['total_pckage_ordres'] = $count_package_ordrs;
                $data['packagesOrder'] = $Packageorders;
                $data['pendingdorders'] = $count_pending_orders;
                $data['orders'] = $orders;
                $data['total_custom_orders'] = $count_custom_orders;
                $data['customorders'] = $customOrders;
            } elseif ($count_custom_orders > 0) {
                $data['total_custom_orders'] = $count_custom_orders;
                $data['customorders'] = $customOrders;
            } elseif ($count_pending_orders > 0) {
                $data['pendingdorders'] = $count_pending_orders;
                $data['orders'] = $orders;
            }

        $data['get_pending'] = Order::where(['assigned_to' => $agency->id, 'status' => 'pending'])->count();
        $data['get_finsihed'] = Order::where(['assigned_to' => $agency->id, 'status' => 'complete'])->count();
        $data['get_processed'] = Order::where(['assigned_to' => $agency->id, 'status' => 'jobdone'])
                                        ->orwhere(['assigned_to' => $agency->id, 'status' => 'jobdonebyagency'])
                                        ->count();
        }
        $agencyAmount = User::where(['id' => $agency->id])->first();
        //$orders = Order::where(['assigned_to' => $agency->id, 'status' => $request->input('status')])->get();
        $data['agencyAmount'] = $agencyAmount;
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages.agency.partials.orders_list')->with($data);
    }


    public function singleOrder($orderNo, $orderUUID)
    {

        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        $order_feedback = DB::table('order_feedback')->where('order_id',$orderNo)->first();
        if (!empty($order)) {
            if ($order->status != 'cancel') {
                if (isset($_GET['ref'])) {
                    if (isset($_GET['id'])) {
                        $notify = Notification::where('id', $_GET['id'])->first();
                        $notify->seen = 1;
                        $notify->save();
                    }


                }

                $agencies = Auth::agency()->get();

                if ($order->type != 'custom' AND $order->type != 'package') {

                    $gig = Gig::where(['id' => $order->gig_id])->first();
                    $gigType = Gigtype::where('id', $gig->gigtype_id)->first();
                    $data['gigtype'] = $gigType;
                    $data['gig'] = $gig;
                }else{
                    $package = Package::where(['packages_id' => $order->packages_id])->first();
                    $data['package'] = $package;
                }

                //$message_files = DB::table('message_files')->where(['order_id' => $order->id, 'user_id'=> $agencies->id])->get();

                $customOrder = CustomOrder::select('status', 'amount_offer', 'total_days')->where('order_id', $order->id)->first();
                $user = User::where(['id' => $order->user_id])->first();
                $agencyAmount = User::where(['id' => $order->assigned_to])->first();
                $messages = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->get();
                $count_cl_msgs = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->count();
                $agencyMessages = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->get();
                $count_agencyMessages = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->count();
                $order_questions = DB::table('order_questions_answers')->where(['order_id' => $order->id])->get();
                $order_addons = DB::table('order_addons')->where(['order_id' => $order->id])->get();

                foreach ($order_questions as $ques_ans) {
                    $ques_ans->question = Gig_question::where(['id' => $ques_ans->gig_question_id])->first()->question;
                }
                $data['customOrder'] = $customOrder;
                $data['agencies'] = $agencies;
                $data['order'] = $order;
                // $data['created_at'] = $created_at;
                //$data['message_files'] = $message_files;
                $data['messages'] = $messages;
                $data['agencyMessages'] = $agencyMessages;
                $data['count_agency_msgs'] = $count_agencyMessages;
                $data['count_cl_msgs'] = $count_cl_msgs;
                $data['order_questions'] = $order_questions;
                $data['order_addons'] = $order_addons;
                $data['user'] = $user;
                $data['aggencyamount'] = $agencyAmount;
                $data['order_feedback'] = $order_feedback;
                $data['vacation'] = $agency = Auth::agency()->get()->vacation;
                return view('pages.agency.agencyOrder')->with($data);
            }
            else{

               return redirect()->route('agencydashboard');
            }
        }else {

            return Redirect::back();
        }
    }


    public function get_admin_agency_chat($orderNo, $orderUUID)
    {

        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        //$check_new_msg = Notification::where(['order_id' => $order->id, 'seen' => '0'])->get();

        $agencyMessages = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->get();

        $output = $this->generate_chat_output($agencyMessages);

        echo $output;

    }


    public function get_admin_user_msgs($orderNo, $orderUUID){

        $order = Order::where( ['order_no' => $orderNo, 'uuid' => $orderUUID] )->first();

        $messages = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->get();

        $output = $this->generate_chat_output( $messages );

        echo $output;
    }

    function get_count_admin_user_msgs($orderNo, $orderUUID){

        $order = Order::where( ['order_no' => $orderNo, 'uuid' => $orderUUID] )->first();

        $count = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->count();

        return response()->json(['count' => $count]);
    }


    function countAgencyMsgs($orderNo, $orderUUID){

        $order = Order::where( ['order_no' => $orderNo, 'uuid' => $orderUUID] )->first();

        $count = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->count();

        return response()->json(['count' => $count]);

    }

    function generate_chat_output($messages){

        $output = '';

        if(count($messages) > 0 ) {
            foreach ($messages as $message) {

                
                if ($message->user_id == Auth::agency()->get()->id) {

                    $username = User::find($message->user_id)->username;

                    $output .= '<div class="direct-chat-msg">';
                    $output .= '<div class="direct-chat-info clearfix">';

                    $output .= '<span class="direct-chat-name pull-left">' . $username . '</span>';
                    $output .= '<span class="direct-chat-timestamp pull-right">' . date("d M y h:i a", strtotime($message->created_at)) . '</span>';
                    $output .= '</div>';

                    $profile_image = User::find($message->user_id)->profile_image;

                    if (!empty($profile_image)) {
                        $output .= '<img class="direct-chat-img" src="' . url('photos/mini') . '/'. $profile_image . '" alt="message user image ">';
                    } else {
                        $output .= '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img">';
                        $output .= '<span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">';
                        $output .= strtoupper(User::find($message->user_id)->username[0]);
                        $output .= '</span>';
                        $output .= '</div>';
                    }

                    $output .= '<div class="direct-chat-text">';
                    $output .= $message->body;
                    $output .= '</div>';
                    $output .= '</div>';

                } else {

                    $username = User::find($message->user_id)->username;

                    $output .= '<div class="direct-chat-msg right">';
                    $output .= '<div class="direct-chat-info clearfix">';
                    $output .= '<span class="direct-chat-name pull-right">' . $username . '</span>';
                    $output .= '<span class="direct-chat-timestamp pull-left">' . date("d M y h:i a", strtotime($message->created_at)) . '</span>';
                    $output .= '</div>';

                    $profile_image = User::find($message->user_id)->profile_image;

                    if (!empty($profile_image)) {

                        if(strpos($profile_image, 'http') === false) :
                            $output .= '<img class="direct-chat-img" src="' . url('photos/mini') . '/' . $profile_image . '" alt="message user image">';
                        else :
                            $output .= '<img class="direct-chat-img" src="' .  $profile_image . '" alt="message user image">';
                        endif;

                    } else {
                        $output .= '<div style="background-color:gray;color:white;position:relative;" class="direct-chat-img">';
                        $output .= '<span style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);font-size: 22px;">';
                        $output .= strtoupper(User::find($message->user_id)->username[0]);
                        $output .= '</span>';
                        $output .= '</div>';
                    }

                    $output .= '<div class="direct-chat-text">';
                    $output .= $message->body;
                    $output .= '</div>';
                    $output .= '</div>';

                }
            }

            return $output;

        } else {
            return false;
        }
    }


    public function jobDone($orderNo, $orderUUID)
    {

        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();

        $user = Admin::where(['type' => 'admin'])->first();
        $order_user = User::where(['type' => 'user', 'id' => $order->user_id])->first();
        $order->status = 'jobdone';
        $order->save();
        $from = 'marketplace@4slash.com';
        $sub = 'Auftrag "Fertig markiert" | Agency';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
        $data = [
            'type' => 'agency',
            'order_no'          => $order->order_no,
            'orderUUID'         => $order->uuid,
            'date'              => $order->created_at,
            'gig_amount'        => $order->amount,
            'user'              => $user->username,
            'user_email'        => $user->email
        ];
        $view = view('adminMail', $data)->render();
        mail('info@ad-print.de', $sub, $view, $headers);
        mail($data['user_email'], $sub, $view, $headers);

        if ($order) {
            /*Notification send to admin*/
            $not_id = Notification::sendNotification($order->id, $user->id, '<a href="' . route('adminorder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]) . '?ref=notification">Job done by agency </a>');
            Notification::where('id',$not_id)->update(['message' => '<a href="' . route('adminorder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">Job done by agency </a>']);
            /*Notification send to user*/
            $not_id = Notification::sendNotification($order->id, $order_user->id, '<a href="' . route('myorders', ['orderno' => $orderNo]) . '">Auftrag "Fertig markiert"</a>');
            Notification::where('id', $not_id)->update(['message' => '<a href="' . route('myorders', ['orderno' => $orderNo, 'id' => $not_id]) . '">Auftrag "Fertig markiert"</a>']);

        }
        return Redirect::back();
//        return redirect()->route('agencydashboard');
    }

    public function messageImages(Request $request, $orderNo, $orderUUID){

        if (!empty($_FILES)) {
            $agency_id = $_POST['session'];
            $agency = Agency::where(['type' => 'agency', 'id' => $agency_id])->first();
            $admin = Admin::where('type', 'admin')->first();
            $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
            $targetFolder = public_path() . '/files/orders/messages';
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath =  $targetFolder;
            $file = rand(0, 1000) . 'ok' . time().$_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath,'/') . '/' . $file;

            // Validate the file type
            $fileTypes = array('jpg','jpeg','png','pdf','zip','eps','ai'); // File extensions
            $fileParts = pathinfo($file);

            if (in_array($fileParts['extension'],$fileTypes)) {
                move_uploaded_file($tempFile,$targetFile);
                $file_url = '<a download class="drag_file" target="_blank" href="'. url() . '/files/orders/messages/' . $file .'">'.'<i class="fa fa-file" style="padding: 4px;"></i>'. $file .'</a>';
                $file_data =  [
                    'file_name' => $file_url,
                    'to_id' => $admin->id,
                    'user_id'   => $agency_id,
                    'order_id' => $order->id
                ];
                $message_file = DB::table('message_files')->insertGetId($file_data);

                return ['id' =>$message_file, 'username' => $agency->username, 'profile_image' => $agency->profile_image];

            } else {
                return ['error' =>'Invalid file type.'];
            }
        }

    }

    public function GetorderMessageFiles(Request $request){
        $agency = Auth::agency()->get();
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
        if ($message = Message::sendMessage($request, $agency, $order->uuid, '4slash', $message_input)) {
            $data = [
                'name' => $agency->username,
                'email' => $agency->email,
                'message' => $message->body
            ];
            $sub = 'Chat Nachricht | Partner';
            $view = view('AgencyMessageMail', $data)->render();
            $from = 'marketplace@4slash.com';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
            mail('marketplace@4slash.com', $sub, $view,$headers);
            if ($admin = Admin::where('type', 'admin')->first()) {
                Notification::sendNotification($order->id, $admin->id, '<a href="' . route('adminorder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">New message from agency ' . $agency->username . '</a>');
            }
            return ['user' => ['username' => $agency->username, 'profile_image' => $agency->profile_image], 'message' => $message->body,'last_id' => $message->id, 'created_at' => date("d M h:i a", strtotime($message->created_at))];

        }
        else {
            return 'error';
        }

    }
    function sendOrderMessage(Request $request, $orderNo, $orderUUID)
    {

        $files = $request->input('files');
        $agency_to_client = $request->input('agency-to-client');
        $new_file_name = explode(",",$files);
        $dropfiles = $request->input('dropfiles');
        $new_drop_files = explode(",",$dropfiles);
        $agency = Auth::agency()->get();
        $message_input = "<pre>".$request->input('message')."</pre>";
        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        /*if($request->input('agency-to-client')) {

            DB::table('messages')->insert(
                array('user_id' => $agency->id, 'body' => $message_input, 'order_id' => $order->id, 'to_id' => $order->user_id)
            );
        }*/
        $textMessage = '<pre class="font-family">' . $request->input('message') . '</pre>';
//        if(!empty($request->input('message'))) {
//            $message = new Message();
//            $message->body = $txtMessage;
//            $message->order_id = $order->id;
//            $message->user_id = $agency->id;
//            $message->to_id = 11;
//            $message->save();
//        }


            if(!empty($files)) {
                foreach ($new_file_name as $file) {
                    $file_url = '<a download class="drag_file" target="_blank" href="' . url() . '/files/orders/messages/' . $file . '">' . '<i class="fa fa-file" style="padding: 4px;"></i>' . $file . '</a>';
                    $file_data = [
                        'file_name' => $file_url,
                        'user_id' => $agency->id,
                        'order_id' => $order->id,
                        'to_id'   => 11
                    ];
                    $message_file = DB::table('message_files')->insertGetId($file_data);
                    $txtFileMessages[] = $file_url;

                }
            }



        if(!empty($dropfiles)) {
            foreach ($new_drop_files as $new_drop_file) {
                $file_url = '<a class="drag_file" target="_blank" href="' . $new_drop_file . '">' . '<i class="fa fa-file" style="padding: 4px;"></i>' . $new_drop_file . '</a>';
                $file_data = [
                    'file_name' => $file_url,
                    'user_id' => $agency->id,
                    'order_id' => $order->id,
                    'to_id'    => 11
                ];
                $message_file = DB::table('message_files')->insertGetId($file_data);
                $txtFileMessages[] = $file_url;
            }
        }

        if (!empty($textMessage) || !empty($txtFileMessages)) {

            if(!empty($textMessage)){
                $messages = $textMessage;
            } else {
                $messages = '';
            }
           if(!empty($txtFileMessages)) {
               $messages .= implode(', ', $txtFileMessages);
           }
            // $txtMessage = '<pre class="font-family">' . $request->input('message') . '</pre>';
            $user = Auth::user()->get();
            $admin = Admin::where('type', 'admin')->first();
            $message = new Message();
            $message->body = $messages;
            $message->order_id = $order->id;
            $message->user_id = $agency->id;
            $message->to_id = 11;
            $message->save();

            if($agency_to_client){
                $message = new Message();
                $message->body = $messages;
                $message->order_id = $order->id;
                $message->user_id = 11;
                $message->to_id = $order->user_id;
                $message->save();
            }

            $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
            $data = [
                'name' => $agency->username,
                'email' => $agency->email,
                'message' => $message->body
            ];
            $sub = 'Chat Nachricht | Partner';
            $view = view('AgencyMessageMail', $data)->render();
            $from = 'marketplace@4slash.com';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
            mail('marketplace@4slash.com', $sub, $view, $headers);
            if ($admin = Admin::where('type', 'admin')->first()) {
                Notification::sendNotification($order->id, $admin->id, '<a href="' . route('adminorder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]) . '?ref=notification">New message from agency ' . $agency->username . '</a>');
            }
            return ['user' => ['username' => $agency->username, 'profile_image' => $agency->profile_image], 'message' => $message->body, 'last_id' => $message->id, 'created_at' => date("d M h:i a", strtotime($message->created_at))];

        }
    }

    function delete_message(Request $request){
        $id = $request->input('id');
        $mes = Message::where(['id' => $id])->delete();
        return $mes;
    }

    function gigSuggestion(Request $request)
    {
        $update = false;
        if ($request->input('action')) {
            if ($request->input('action') == 'update') {

                $update = true;

                $gig = Gig::where(['uuid' => $request->input('gigUUID')])->first();
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
                $data['categories'] = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
                $data['subCategories'] = Gigtype_Subcategory::where(['gigtypes_id' => $gig->gigtype_id])->get();
                $data['gig'] = $gig;
                $data['gigAddons'] = Gig_addon::where(['gig_id' => $gig->id])->get();
                $data['gigQuestions'] = Gig_question::where(['gig_id' => $gig->id])->get();
                $data['gigImages'] = GigImages::where(['gig_id' => $gig->id])->get();
                $data['gigtype'] = Gigtype::where('id', $gig->gigtype_id)->first();
                //return view('pages.agency.suggest_gigs')->with($data);
            }
        }
        $categories = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
        // $data['subCategories'] = Gigtype_Subcategory::where(['gigtypes_id' => $gig->gigtype_id])->get();

        $data['categories'] = $categories;
        $data['update'] = $update;
        $data['type'] = 'gig';
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages.agency.suggest_gigs')->with($data);
    }

    function packageSuggestion(Request $request)
    {
        $data['update'] = false;
        if (isset($_POST['create-package'])) {
            echo isset($_POST['create-package']);
            $agency = Auth::agency()->get();
            $packageTypeId = $request->input('package-type');
            $packageTitle = $request->input('package-title');
            $packagePrice = $request->input('package-price');
            $packageOptions = $request->input('package-option');
            try {

                DB::transaction(function () use ($packageTypeId, $packageTitle, $packagePrice, $packageOptions, $agency) {
                    $package = Package::create([
                        'packages_id' => uniqid(),
                        'title' => $packageTitle,
                        'price' => $packagePrice,
                        'packages_types_id' => $packageTypeId,
                        'user_id' => $agency->id
                    ]);
                    if ($packageOptions != Null) {
                        foreach ($packageOptions as $packageOption) {
                            PackageOption::create([
                                'option' => $packageOption,
                                'packages_id' => $package->id
                            ]);
                        }
                    }
                });


                return redirect()->route('agencydashboard');
            } catch (\Exception $e) {
                dd($e);
            }
        }

        $agency_id = Auth::agency()->get()->id;
        $packagesTypes = PackageType::all();

        $data['packagestypes'] = $packagesTypes;
        $data['type'] = 'package';
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        $categories = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
        // $data['subCategories'] = Gigtype_Subcategory::where(['gigtypes_id' => $gig->gigtype_id])->get();

        $data['categories'] = $categories;
        $data['agency_favors'] = Gig::where(['suggested_by' => $agency_id,'active' => 1, 'status' => 'enabled','rejection' => 0 ,'vacation' => 0 ,'save' => 0])->get();
        return view('pages.agency.suggest_gigs')->with($data);

    }

    public function suggestionGigCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gig-title' => 'required|max:50',
            /*'gig-short-discription' => 'required|max:150',*/
            'gig-discription' => 'required|max:800',
            'gig-discription1' => 'required|max:800',
            /*'gig-discription2' => 'required|max:800',*/
            'gig-category' => 'required',
            'gig-sub-category' => 'required',
            'gig-price' => 'required',
        ]);

        if ($validator->fails()) {

            if (!$request->hasFile('gig-images')) {
                SESSION::put('gig-image', 'At least one image is required');
            }

            return Redirect::back()->withInput()->withErrors($validator);
        } else if (!$request->hasFile('gig-images')) {
            SESSION::put('gig-image', 'At least one image is required');
            return Redirect::back()->withInput()->withErrors($validator);
        }


        $user = Auth::agency()->get();
        $subcats_id = array();
        foreach($request->input('gig-sub-category') as $key=>$subcatId){
            $subcats_id[] = $subcatId;
        }

        $Subcat = implode(',',$subcats_id);
        DB::transaction(function () use ($request, $user, $Subcat) {

            $extraCharachters = array(' ', '/', '.');
        if($request->input('save_only')){
            $gig = Gig::create([

                'uuid' => \Webpatser\Uuid\Uuid::generate(4),
                'user_id' => $user->id,
                'suggested_by' => $user->id,
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
                'auto_assign' => 1,
                'status' => 'saved'

            ]);
        }else {
            $gig = Gig::create([

                'uuid' => \Webpatser\Uuid\Uuid::generate(4),
                'user_id' => $user->id,
                'suggested_by' => $user->id,
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
                'auto_assign' => 1,
                'status' => 'disabled'

            ]);
        }
            $images = $request->file('gig-images');
            if (count($images) > 0) {

                foreach ($images as $image) {
                    if (!empty($image)) {
                        list($width, $height) = getimagesize($image);
                        if ($width == 750 && $height == 350) {
                            $length = 2;
                            $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                            $file_ext = '.' . $image->getClientOriginalExtension();
                            $new_name = $image->getClientOriginalName() . md5($randomString) . $file_ext;
                            $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);

                            $gigImage = new GigImages();
                            $gigImage->image = $new_name;
                            $gigImage->gig_id = $gig->id;
                            $gigImage->save();
                        } else {
                            continue;
                        }
                    }
                }
            }

            if (count($request->input('gig-addon')) > 0) {
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

            if (count($request->input('gig-choice-question')) > 0) {
                foreach ($request->input('gig-choice-question') as $gig_choice_quest) {

                    Gig_question::create([

                        'gig_id' => $gig->id,
                        'question' => $gig_choice_quest['question'],
                        'answers' => implode(',', $gig_choice_quest['answers']),
                        'type' => 'check',

                    ]);
                }
            }

            if(!$request->input('save_only')) {
                $admin = User::where('type', 'admin')->first();
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('agenciesSuggestion') . '?ref=notification">New suggestion | gig | Agency</a>');
//            Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('agenciesSuggestion') . '?ref=notification&id=' . $notify_id . '">Neu Vorschlag | F | Agency</a>']);
                Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('gigcreate') . '?ref=notification&id=' . $notify_id . '&action=update&funnel=' . $gig->uuid . '">New suggestion | gig | Agency</a>']);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                $from = 'marketplace@4slash.com';
                $sub = '„New suggestion | gig | Agency“';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                $data = [
                    'type' => 'gig',
                    'status' => 'offered',
                    'user' => $user->username,
                    'gig' => $gig->title,
                    'gig_disc' => $gig->short_discription,
                    'gig_uuid' => $gig->uuid
                ];
                $to = 'marketplace@4slash.com';
                $body = view('gigssuggestionMale', $data)->render();
                mail($to, $sub, $body, $headers);
            }

        });
        if($request->input('save_only')){
            return redirect()->route('suggestedgigs');
        }else {
            return redirect()->route('suggestedgigs')->with('succ_msg', 'Thank you for your favor! We will check your offer!');
        }
    }

    public function suggestionPackageCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package-title' => 'required|min:5|max:50',
            'package-discription' => 'required|min:5|max:800',
            'platinum_package_name' => 'required|min:5|max:35',
            'silver_package_name' => 'required|min:5|max:35',
            'gold_package_name' => 'required|min:5|max:35',
            'platinum_package_text' => 'required|min:5|max:800',
            'silver_package_text' => 'required|min:5|max:800',
            'gold_package_text' => 'required|min:5|max:800',
            'platinum_days' => 'required|max:10',
            'silver_days' => 'required|max:10',
            'gold_days' => 'required|max:10',
            'platinum_package_price' => 'required|max:10',
            'silver_package_price' => 'required|max:10',
            'gold_package_price' => 'required|max:10',
            'association' => 'required'
        ]);

        if ($validator->fails()) {

            if (!$request->hasFile('gig-images')) {
                SESSION::put('gig-image', 'At least one image is required');
            }

            return Redirect::back()->withInput()->withErrors($validator);
        } else if (!$request->hasFile('gig-images')) {
            SESSION::put('gig-image', 'At least one image is required');
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $suggest = $request->input('create_package');

            $agency = Auth::agency()->get();
            $packageTypeId = $request->input('package-type');
            $packageTitle = $request->input('package-title');
            $packagedesc = $request->input('package-discription');
            $packagePrice = 10;
            $packageOptions = $request->input('package-option');
            $unique_id = uniqid();
            $images = $request->file('gig-images');
            if(!empty($request->input('package-category'))) {
                $cat = $request->input('package-category');
                if($request->input('gig-sub-category')) {
                    $subcats_id = array();
                    foreach ($request->input('gig-sub-category') as $key => $subcatId) {
                        $subcats_id[] = $subcatId;
                    }
                    $favor_id = '';
                    $Subcat = implode(',', $subcats_id);
                }else{
                    $favor_id = $request->input('favor_associate');
                    $cat = '';
                    $Subcat = '';
                }
            }else{
                $favor_id = $request->input('favor_associate');
                $gig = Gig::where('id',$request->input('favor_associate'))->first();
                $cat = $gig->gigtype_id;
                $Subcat = $gig->gigtypes_subcategories_id;
            }

            try {

                DB::transaction(function () use ($request,$suggest,$unique_id,$packageTitle,$packagedesc, $packagePrice,$cat,$Subcat,$favor_id, $agency,$images,$packageOptions) {
                    if($suggest){
                    $package = Package::create([
                        'packages_id' => $unique_id,
                        'title' => $packageTitle,
                        'pack_desc' => $packagedesc,
                        'price' => $packagePrice,
                        'packages_types_id' => $cat,
                        'packages_subtypes_id' => $Subcat,
                        'favor_id' => $favor_id,
                        'user_id' => $agency->id,
                        'suggested_by' => $agency->id,
                        'status' => 'disabled',
                    ]);
                    }else{
                        $package = Package::create([
                            'packages_id' => $unique_id,
                            'title' => $packageTitle,
                            'pack_desc' => $packagedesc,
                            'price' => $packagePrice,
                            'packages_types_id' => $cat,
                            'packages_subtypes_id' => $Subcat,
                            'favor_id' => $favor_id,
                            'user_id' => $agency->id,
                            'suggested_by' => $agency->id,
                            'status' => 'disabled',
                            'save'  => 1
                        ]);
                    }
                    $silver_package_name = $request->input('silver_package_name');
                    $gold_package_name = $request->input('gold_package_name');
                    $platinum_package_name = $request->input('platinum_package_name');
                    $silver_package_text = $request->input('silver_package_text');
                    $gold_package_text = $request->input('gold_package_text');
                    $platinum_package_text = $request->input('platinum_package_text');
                    $silver_days = $request->input('silver_days');
                    $gold_days = $request->input('gold_days');
                    $platinum_days = $request->input('platinum_days');
                    $silver_source = $request->input('silver_source');
                    $gold_source = $request->input('gold_source');
                    $platinum_source = $request->input('platinum_source');
                    $silver_revision = $request->input('silver_revision');
                    $gold_revision = $request->input('gold_revision');
                    $platinum_revision = $request->input('platinum_revision');
                    $silver_package_price = $request->input('silver_package_price');
                    $gold_package_price = $request->input('gold_package_price');
                    $platinum_package_price = $request->input('platinum_package_price');
                    DB::table('package_silver')->insert(['package_name' => $silver_package_name,'desc' => $silver_package_text,'delivery_days' => $silver_days ,'source_file' =>$silver_source ,'revisions' => $silver_revision,'price' => $silver_package_price,'package_id' => $unique_id]);
                    DB::table('package_gold')->insert(['package_name' => $gold_package_name,'desc' => $gold_package_text,'delivery_days' => $gold_days ,'source_file' =>$gold_source ,'revisions' => $gold_revision,'price' => $gold_package_price,'package_id' => $unique_id]);
                    DB::table('package_bronze')->insert(['package_name' => $platinum_package_name,'desc' => $platinum_package_text,'delivery_days' => $platinum_days ,'source_file' =>$platinum_source ,'revisions' => $platinum_revision,'price' => $platinum_package_price,'package_id' => $unique_id]);
                    if (count($images) > 0) {

                        foreach ($images as $image) {
                            if (!empty($image)) {
                                list($width, $height) = getimagesize($image);
                                if ($width == 750 && $height == 350) {
                                    $length = 2;
                                    $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                                    $file_ext = '.' . $image->getClientOriginalExtension();
                                    $new_name = $image->getClientOriginalName() . md5($randomString) . $file_ext;
                                    $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);

                                    $gigImage = new PackageOption();
                                    $gigImage->image = $new_name;
                                    $gigImage->package_id = $package->id;
                                    $gigImage->save();
                                } else {
                                    continue;
                                }
                            }
                        }
                    }
                    if ($packageOptions != Null) {
                        $package_option_namesilver = $request->input('package_option_namesilver');
                        $package_option_namebronze = $request->input('package_option_namebronze');
                        $package_option_namegold = $request->input('package_option_namegold');
                        $reverse = array_reverse($packageOptions);
                        foreach ($reverse as $key=>$packageOption) {

                            $silver = (array_key_exists($key,$package_option_namesilver))? '1' : '0';
                            $bronze = (array_key_exists($key,$package_option_namebronze))? '1' : '0';
                            $gold = (array_key_exists($key,$package_option_namegold))? '1' : '0';

//                            if(array_key_exists($key,$package_option_namebronze) || array_key_exists($key,$package_option_namesilver) || $package_option_namegold) {
                                DB::table('package_option')->insert([
                                    'option' => $packageOption,
                                    'bronze' => $bronze,
                                    'silver'=>$silver,
                                    'gold'=>$gold,
                                    'package_id' => $package->id
                                ]);

//                            }
                        }
                    }
                });
                if($suggest) {
                    $from = 'marketplace@4slash.com';
                    $sub = '„Neu Vorschlag | P | Agency“';
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                    $data = [
                        'type' => 'package',
                        'status' => 'offered',
                        'agency' => $agency->username,
                        'package' => $packageTitle
                    ];
                    $to = 'info@ad-print.de';
                    $body = view('gigssuggestionMale', $data)->render();
                    mail($to, $sub, $body, $headers);
                    $admin = User::where('type', 'admin')->first();
/*
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('packagesSuggestion') . '?ref=notification">Neu "P" Vorschlag | Agency</a>');
                    Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('packagesSuggestion') . '?ref=notification&id=' . $notify_id . '&&action=update&&funnel='.$unique_id.'">Neu "P" Vorschlag | Agency</a>']);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('admin.package.suggestion') . '?ref=notification">New "Package" suggestion | Agency</a>');
                    Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('admin.package.suggestion') . '?ref=notification&id=' . $notify_id . '&&action=update&&funnel='.$unique_id.'">New "Package" suggestion | Agency</a>']);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                    return redirect()->route('suggestedpackages')->with('succ_msg_pack', 'Thank you for your package suggestion! We will check your offer!');
                }else{
                    return redirect()->route('suggestedpackages')->with('succ_msg_pack', 'Saved!');
                }
            } catch (\Exception $e) {
                dd($e);
            }
    }

    public function SuggestedGigs()
    {

        $agency = Auth::agency()->get();
        $gigs = Gig::where(['suggested_by' => $agency->id])->orderBy('created_at', 'desc')->get();
        $data['get_saved'] = Gig::where(['suggested_by' => $agency->id,'status' => 'saved'])->count();
        $data['get_admin_approval_waiting'] = Gig::where(['suggested_by' => $agency->id,'status' => 'disabled','active' => 0,'featured' => 0])->count();
        $data['get_rejected'] = Gig::where(['suggested_by' => $agency->id,'status' => 'disabled','rejection' => 1])->count();
        $data['get_online_soon'] = Gig::where(['suggested_by' => $agency->id,'status' => 'enabled','active' => 0])->count();
        $data['get_activated'] = Gig::where(['suggested_by' => $agency->id,'status' => 'enabled','active' => 1])->count();
        /*var_dump($data['get_admin_approval_waiting']);
        exit;*/
        foreach($gigs as $gig){
            $gig['subcat'] = Gigtype_Subcategory::where('id', $gig->gigtypes_subcategories_id)->first();
        }
        foreach ($gigs as $gig){
            $gig['reason'] = DB::table('gig_reject_reason')->where('favor_id',$gig->id)->orderBy('created_at', 'desc')->first();
        }
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        $data['gigs'] = $gigs;
        return view('pages.agency.suggestedgigs')->with($data);
    }


    public function SuggestedPacakges()
    {
        if (isset($_GET['ref'])) {
            if (isset($_GET['id'])) {
                $notify = Notification::where('id', $_GET['id'])->first();
                $notify->seen = 1;
                $notify->save();
            }
        }

        $agency = Auth::agency()->get();
        $packages = Package::where('suggested_by', $agency->id)->orderBy('created_at', 'asc')->get();
        foreach ($packages as $package) {
            $package->type = PackageType::where(['id' => $package->packages_types_id])->first();
        }
        foreach ($packages as $package){
            $package['reason'] = DB::table('package_reject_reason')->where('package_id',$package->id)->orderBy('created_at', 'desc')->first();
        }
        $data['get_saved_package'] = Package::where(['suggested_by' => $agency->id,'save' => 1])->count();
        $data['get_admin_approval_waiting_package'] = Package::where(['suggested_by' => $agency->id,'status' => 'disabled','active' => 0,'featured' => 0])->count();
        $data['get_rejected_package'] = Package::where(['suggested_by' => $agency->id,'status' => 'rejected'])->count();
        $data['get_online_soon_package'] = Package::where(['suggested_by' => $agency->id,'status' => 'enabled','active' => 0])->count();
        $data['get_activated_package'] = Package::where(['suggested_by' => $agency->id,'status' => 'enabled','active' => 1])->count();
        $data['packages'] = $packages;
        $data['vacation'] = $agency = Auth::agency()->get()->vacation;
        return view('pages.agency.suggestedgigs')->with($data);
    }


    public function update(Request $request)
    {
        $update_by = Auth::agency()->get()->id;
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

        if (count($request->input('gig-choice-question')) > 0) {
            foreach ($request->input('gig-choice-question') as $gig_choice_quest) {

                if (!empty($gig_choice_quest['question_id'])) {
                    Gig_question::where('id', $gig_choice_quest['question_id'])->update([
                        'question' => $gig_choice_quest['question'],
                        'answers' => implode(',', $gig_choice_quest['answers']),
                        'type' => 'check',

                    ]);
                } else {
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
        $images_id = $request->input('gig_image_id');
        $images_name = $request->input('gig_image_name');
        /* echo count($images);
         exit;*/
        if(!empty($images_id) && !empty($images_name)) {
            foreach ($images_id as $item) {
                GigImages::removeImage($item);
            }
            foreach($images_name as $name){
                $gigImage = new GigImages();
                $gigImage->image = $name;
                $gigImage->gig_id = $request->input('gig-id');
                $gigImage->save();
            }
        }
        foreach ($images as $image) {
            if (!empty($image)) {
                list($width, $height) = getimagesize($image);
                if ($width == 750 && $height == 350) {
                    $length = 2;
                    $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                    $file_ext = '.' . $image->getClientOriginalExtension();
                    $new_name = $image->getClientOriginalName() . md5($randomString) . $file_ext;
                    $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);

                    $gigImage = new GigImages();
                    $gigImage->image = $new_name;
                    $gigImage->gig_id = $request->input('gig-id');
                    $gigImage->save();
                } else {
                    continue;
                }
            }
        }
        if($request->input('up_s')){
            $user = Auth::agency()->get();
            $gig_id = $request->input('gig-id');
            $gig = Gig::where(['id' => $gig_id])->first();
            $from = 'marketplace@4slash.com';
            $sub = '„Neu Vorschlag | F | Agency“';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
            $data = [
                'type' => 'gig',
                'status' => 'offered',
                'user' => $user->username,
                'gig' => $gig->title,
                'gig_disc' => $gig->short_discription,
                'gig_uuid' => $gig->uuid
            ];
            $to = 'marketplace@4slash.com';
            $body = view('gigssuggestionMale', $data)->render();
            mail($to, $sub, $body, $headers);
        }
        $id = Gig::where(['id'=>$request->input('gig-id')])->first();
        $admin = User::where('type', 'admin')->first();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('agenciesSuggestion') . '?ref=notification">New suggestion | gig | Agency</a>');
        Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('gigcreate') . '?ref=notification&id='.$notify_id.'&action=update&funnel=' . $id->uuid . '">New suggestion | gig | Agency</a>']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        if(Gig::gigUpdate($gigData, $request))
            return redirect()->route('suggestedgigs');
        else
            return redirect()->back();

    }


    function updateAutoAssign(Request $request)
    {


        $id = Gig::where('id', $request->input('gig_id'))->update(['auto_assign' => $request->input('auto_assign')]);
        if($request->input('auto_assign') == 1) {
            $id_active = Gig::where('id', $request->input('gig_id'))->update(['active' => 1]);
        }else{
            $id_active = Gig::where('id', $request->input('gig_id'))->update(['active' => 4]);
        }
        if ($id && $id_active)
            echo true;
        else
            echo false;
    }

    public function deleteGig(Request $request)
    {

        $check_pending_orders = Order::where(['gig_id' => $request->input('gig_id'), 'status' => 'pending'])->get();

        if (count($check_pending_orders) == 0) {
            $gig = Gig::destroy($request->input('gig_id'));
        } else {
            Session::put('gig_deletion_failed', 'gig is unable to delete, because it has pending orders');
            return redirect::back();
        }

        return $gig;

    }

    public function add_gig_to_trash(Request $request)
    {

        $gig_id = $request->input('gig_id');


        $affected_rows = Gig::where('id', $gig_id)->update(['status' => 'disabled']);

        if ($affected_rows)
            echo '1';
        else
            echo '0';
    }


    public function removeGigImages(Request $request)
    {
        return ['result' => GigImages::removeGigImage($request->input('gigimage_id'))];

    }

    public function packageUpdate(Request $request, $packageId)
    {

                $package = Package::where('packages_id' ,$packageId)->first();
                $data['update'] = true;
                $data['packages'] = $package;
                $categories = Gigtype::where(['active'=>1,'status'=>'enabled'])->get();
                $agency_favors = Gig::where(['suggested_by' => $package->suggested_by,'active' => 1, 'status' => 'enabled'])->get();
                $subcats_id = array();
                $id = $package->packages_subtypes_id;
                $explo = explode(',',$id);
                foreach($explo as $key=>$subcatId){
                    $subcats = Gigtype_Subcategory::where('id', $subcatId)->first();
                    if(!empty($subcats))
                        $subcats_id[] = $subcats;
                }
                $data['subcategory'] = $subcats_id;
                $data['agency_favors'] = $agency_favors;
                $data['categories'] = $categories;
                $data['packageimages'] = PackageOption::where(['package_id' => $package->id])->get();
                $data['package_bronze'] = DB::table('package_bronze')->where('package_id',$package->packages_id)->first();
                $data['package_silver'] = DB::table('package_silver')->where('package_id',$package->packages_id)->first();
                $data['package_gold'] = DB::table('package_gold')->where('package_id',$package->packages_id)->first();
                $data['package_option'] = DB::table('package_option')->where('package_id',$package->id)->orderby('id','desc')->get();
                $data['vacation'] = $agency = Auth::agency()->get()->vacation;
                return view('pages.agency.packages_create')->with($data);

    }
    public function putPackageUpdate(Request $request) {
        if($request->input('action')){
            if($request->input('action') == "update"){
                $suggest = $request->input('update-package');
        $package_id = $request->input('package_id');
        $agency = Auth::agency()->get();
        $packageTitle = $request->input('package-title');
        $packagdesc = $request->input('package-discription');
        $packagePrice = 10;
        $packageOptions = $request->input('package-option');
        $unique_id = uniqid();
        $images = $request->file('gig-images');
        $pack_number = $request->input('package_number');
        $cat = $request->input('package-category');
        if($request->input('gig-sub-category')) {
            $subcats_id = array();
            foreach ($request->input('gig-sub-category') as $key => $subcatId) {
                $subcats_id[] = $subcatId;
            }
            $favor_id = '';
            $Subcat = implode(',', $subcats_id);
        }else{
            $favor_id = $request->input('favor_associate');
            $cat = '';
            $Subcat = '';
        }
                $validator = Validator::make($request->all(), [
                    'package-title' => 'required|max:50',
                    'package-discription' => 'required|min:5|max:800',
                    'platinum_package_name' => 'required|max:50',
                    'silver_package_name' => 'required|max:50',
                    'gold_package_name' => 'required|max:50',
                    'platinum_package_text' => 'required|max:300',
                    'silver_package_text' => 'required|max:300',
                    'gold_package_text' => 'required|max:300',
                    'platinum_days' => 'required|max:10',
                    'silver_days' => 'required|max:10',
                    'gold_days' => 'required|max:10',
                    'platinum_package_price' => 'required|max:10',
                    'silver_package_price' => 'required|max:10',
                    'gold_package_price' => 'required|max:10',
                    'association' => 'required'
                ]);

        try {

            DB::transaction(function () use ($request,$suggest,$pack_number,$packagdesc,$package_id,$unique_id,$packageTitle, $packagePrice,$cat,$Subcat,$favor_id, $agency,$images,$packageOptions) {
                if($suggest) {
                    $package_update = DB::table('packages')->where('id', $package_id)->update([
                        'title' => $packageTitle,
                        'pack_desc' => $packagdesc,
                        'price' => $packagePrice,
                        'packages_types_id' => $cat,
                        'packages_subtypes_id' => $Subcat,
                        'favor_id' => $favor_id,
                        'user_id' => $agency->id,
                        'suggested_by' => $agency->id,
                        'status' => 'disabled',
                        'save'   => 0
                    ]);
                }else{
                    $package_update = DB::table('packages')->where('id', $package_id)->update([
                        'title' => $packageTitle,
                        'pack_desc' => $packagdesc,
                        'price' => $packagePrice,
                        'packages_types_id' => $cat,
                        'packages_subtypes_id' => $Subcat,
                        'favor_id' => $favor_id,
                        'user_id' => $agency->id,
                        'suggested_by' => $agency->id,
                        'status' => 'disabled',
                        'save'   => 1
                    ]);
                }
                $silver_package_name = $request->input('silver_package_name');
                $gold_package_name = $request->input('gold_package_name');
                $platinum_package_name = $request->input('platinum_package_name');
                $silver_package_text = $request->input('silver_package_text');
                $gold_package_text = $request->input('gold_package_text');
                $platinum_package_text = $request->input('platinum_package_text');
                $silver_days = $request->input('silver_days');
                $gold_days = $request->input('gold_days');
                $platinum_days = $request->input('platinum_days');
                $silver_source = $request->input('silver_source');
                $gold_source = $request->input('gold_source');
                $platinum_source = $request->input('platinum_source');
                $silver_revision = $request->input('silver_revision');
                $gold_revision = $request->input('gold_revision');
                $platinum_revision = $request->input('platinum_revision');
                $silver_package_price = $request->input('silver_package_price');
                $gold_package_price = $request->input('gold_package_price');
                $platinum_package_price = $request->input('platinum_package_price');
                DB::table('package_silver')->where('package_id',$pack_number)->update(['package_name' => $silver_package_name,'desc' => $silver_package_text,'delivery_days' => $silver_days ,'source_file' =>$silver_source ,'revisions' => $silver_revision,'price' => $silver_package_price]);
                DB::table('package_gold')->where('package_id',$pack_number)->update(['package_name' => $gold_package_name,'desc' => $gold_package_text,'delivery_days' => $gold_days ,'source_file' =>$gold_source ,'revisions' => $gold_revision,'price' => $gold_package_price]);
                DB::table('package_bronze')->where('package_id',$pack_number)->update(['package_name' => $platinum_package_name,'desc' => $platinum_package_text,'delivery_days' => $platinum_days ,'source_file' =>$platinum_source ,'revisions' => $platinum_revision,'price' => $platinum_package_price]);
                if (count($images) > 0) {

                    foreach ($images as $image) {
                        if (!empty($image)) {
                            list($width, $height) = getimagesize($image);
                            if ($width == 750 && $height == 350) {
                                $length = 2;
                                $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

                                $file_ext = '.' . $image->getClientOriginalExtension();
                                $new_name = $image->getClientOriginalName() . md5($randomString) . $file_ext;
                                $movedImage = $image->move(public_path('files/gigs/images/'), $new_name);

                                $gigImage = new PackageOption();
                                $gigImage->image = $new_name;
                                $gigImage->package_id = $package_id;
                                $gigImage->save();
                            } else {
                                continue;
                            }
                        }
                    }
                }
                if ($packageOptions != Null) {
                    $package_option_namesilver = $request->input('package_option_namesilver');
                    $package_option_namebronze = $request->input('package_option_namebronze');
                    $package_option_namegold = $request->input('package_option_namegold');
                    $reverse = array_reverse($packageOptions);
                    foreach ($reverse as $key=>$packageOption) {
                        /*var_dump($request->input('option_id'));*/

                        $silver = (array_key_exists($key,$package_option_namesilver))? '1' : '0';
                        $bronze = (array_key_exists($key,$package_option_namebronze))? '1' : '0';
                        $gold = (array_key_exists($key,$package_option_namegold))? '1' : '0';

//                            if(array_key_exists($key,$package_option_namebronze) || array_key_exists($key,$package_option_namesilver) || $package_option_namegold) {
                        DB::table('package_option')->where('package_id',$package_id)->update([
                            'option' => $packageOption,
                            'bronze' => $bronze,
                            'silver'=>$silver,
                            'gold'=>$gold,
                        ]);
//                            }
                    }
                    /*exit;*/
                }
                $images = $request->file('gig-images');
                $images_id = $request->input('gig_image_id');
                $images_name = $request->input('gig_image_name');
                /* echo count($images);
                 exit;*/
                if(!empty($images_id) && !empty($images_name)) {
                    foreach ($images_id as $item) {
                        PackageOption::removeImage($item);
                    }
                    foreach($images_name as $name){
                        $gigImage = new PackageOption();
                        $gigImage->image = $name;
                        $gigImage->package_id = $package_id;
                        $gigImage->save();
                    }
                }
            });
            if($suggest) {
                $from = 'marketplace@4slash.com';
                $sub = '„New suggestion | Package | Agency“';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                $data = [
                    'type' => 'package',
                    'status' => 'offered',
                    'agency' => $agency->username,
                    'package' => $packageTitle
                ];
                $to = 'info@ad-print.de';
                $body = view('gigssuggestionMale', $data)->render();
                mail($to, $sub, $body, $headers);
                $admin = User::where('type', 'admin')->first();
                /*
                                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                                    $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('packagesSuggestion') . '?ref=notification">Neu "P" Vorschlag | Agency</a>');
                                    Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('packagesSuggestion') . '?ref=notification&id=' . $notify_id . '&&action=update&&funnel='.$unique_id.'">Neu "P" Vorschlag | Agency</a>']);
                                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $notify_id = Notification::sendnotification('', $admin->id, '<a href="' . route('admin.package.suggestion') . '?ref=notification">New "Package" suggestion | Agency</a>');
                Notification::where('id', $notify_id)->update(['message' => '<a href="' . route('admin.package.suggestion') . '?ref=notification&id=' . $notify_id . '&&action=update&&funnel='.$pack_number.'">New "Package" suggestion | Agency</a>']);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return redirect()->route('suggestedpackages')->with('succ_msg_pack', 'Thank you for your package suggestion! We will check your offer!');
            }else{
                return redirect()->route('suggestedpackages')->with('succ_msg_pack', 'Saved!');
            }
//            return redirect()->route('suggestedpackages')->with('succ_msg_pack', 'Vielen Dank für Ihren package Vorschlag! Wir werden Ihr Angebot prüfen!');
        } catch (\Exception $e) {
            dd($e);
        }
            }
        }

    }
    public function agencypackageoption(Request $request)
    {

        $PackageOption = PackageOption::where('id',$request->input('gigoptionid'))->delete();
        //$gigAddon->delete;
        return ['result' => $PackageOption];

    }

    public function send_problem_email(){
        $sub = 'Problems 4slash';
        $view = view('agency_problem')->render();
        $from = 'marketplace@4slash.com';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
        mail('marketplace@4slash.com', $sub, $view,$headers);
    }


    function checkGigsStatus(Request $request) {

        $getGigsStatus = Gig::select('id', 'title', 'status')->where('suggested_by', Auth::agency()->get()->id)->get();

        if($getGigsStatus) {

            return response()->json($getGigsStatus);
        }
    }

    function checkPackagesStatus(Request $request) {

        $getPackagesStatus = Package::select('id', 'title', 'status')->where('suggested_by', Auth::agency()->get()->id)->get();

        if($getPackagesStatus) {

            return response()->json($getPackagesStatus);
        }
    }
    public function singleGig(Request $request){


        $gig = Gig::where('id', $request->input('gig_id'))->first();

        return response()->json($gig);
        //json_encode($gig);
    }

    public function delete(Request $request)
    {
        $pakage = Package::destroy($request->input('package_id'));
        if($pakage){
            return 1;
        }else{
            return 0;
        }

    }

    public function removepackageImages(Request $request)
    {
        return ['result' => PackageOption::removePackageImage($request->input('packageimage_id'))];

    }

    public function postMessageFiles(Request $request){
        $order_no = Session::get('order_no');
        if(Input::hasFile('files')) {
            $files = Input::file('files');
            // Making counting of uploaded images
            // start count how many uploaded
            $uploadcount = 0;
            foreach($files as $file) {
                $destinationPath = public_path() . '/files/orders/messages/';
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
}