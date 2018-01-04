<?php

namespace App\Http\Controllers;

use App\Gig;
use App\Gig_addon;
use App\OrderAddon;
use App\Notification;
use App\Agency;
use App\Admin;
use App\AgencyInvoice;
use App\Message;
use App\Order;
use App\User;
use App\Agency_details;
use App\Gigtype_Subcategory;
use Illuminate\Support\Facades\Input;
use App\Gigtype;
use Illuminate\Http\Request;
use App\Gig_question;
use Redirect;
use Illuminate\Support\Facades\Auth;
use App\CustomOrder;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use File;

class AdminOrderController extends Controller
{
    use LogTrait;

    public function index($orderNo, $orderUUID)
    {
        $admin = Auth::admin()->get();
        $message = 'open order page';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        $order_block = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->update(['user_active' => $admin->id]);
        $order_feedback = DB::table('order_feedback')->where('order_id',$orderNo)->first();
        $order_message = "Enter order page";
        $this->InsertNeworderLog($remote_addr,$request_uri,$admin->id,$order_message,$order->id);
        if (!empty($order)) {
            if (isset($_GET['id'])) {
                $notify = Notification::where('id', $_GET['id'])->first();
                $notify->seen = 1;
                $notify->save();
            }
            /* $agencies         = Agency::where('type', 'agency')->get();*/
            if ($order->type != 'custom' && $order->type != 'package') {
                $gig = Gig::where(['id' => $order->gig_id])->first();
                $gigType = Gigtype::where('id', $gig->gigtype_id)->first();
                $gig_suggested_by_user_type = User::where('id', $gig->suggested_by)->value('type');
                $gig_suggested_by_user_type2 = User::where('id', $gig->suggested_by)->first();

                if (!empty($gig_suggested_by_user_type))
                    $gig->user_type = $gig_suggested_by_user_type;

                $gigSubcat = Gigtype_Subcategory::where('gigtypes_id', $gigType->id)->first();
                $gigAddon = OrderAddon::where('order_id', $order->id)->get();
                $dataAgencies = DB::table('agency_additional')->get();


                /*$agencies = array();*/
                foreach ($dataAgencies as $agency) {
                    if (!empty($agency->skills)) {
                        $skills = explode(',', $agency->skills);

                        for ($i = 0; $i < count($skills); $i++) {
                            if ($skills[$i] === $gigSubcat->name) {
                                $agencies[] = Agency::where('id', $agency->agency_id)->first();
                            } else {
                                $no_agencies = '';
                            }
                        }

                        /*$pendingOrders = $agencies->getPendingOrders();*/
                        /*$completedOrders = $agencies->getCompletedOrders();*/

                    }
                }

                if (!empty($agencies)) {
                    foreach ($agencies as $agency) {
                        $agency['pendingOrders'] = $agency->getPendingOrders();
                        $agency['completedOrders'] = $agency->getCompletedOrders();
                    }
                }

                if (!empty($agencies))
                    $data['agencies'] = $agencies;
                $data['gig_suggested_by_user_name'] = $gig_suggested_by_user_type2;
                $data['gigtype'] = $gigType;
                $data['subCat'] = $gigSubcat;
                $data['gig'] = $gig;
                $data['gigAddons'] = $gigAddon;

            } else {
                $agencies = Agency::where('type', 'agency')->get();
                foreach ($agencies as $agency) {
                    $agency['pendingOrders'] = $agency->getPendingOrders();
                    $agency['completedOrders'] = $agency->getCompletedOrders();
                }

                $data['agencies'] = $agencies;

            }


            $customOrder = CustomOrder::select('status', 'amount_offer', 'total_days')->where('order_id', $order->id)->first();

            $user = User::where(['id' => $order->user_id])->first();
            $agency_details = Agency_details::where(['agency_id' => $order->assigned_to])->first();
            $agencyAmount = User::where(['id' => $order->assigned_to])->first();
            $messages = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->get();
            $count_client_messages = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->count();
            $agencyMessages = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->get();
            $count_agency_msgs = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->count();
            $order_questions = DB::table('order_questions_answers')->where(['order_id' => $order->id])->get();

            foreach ($order_questions as $ques_ans) {
                $ques_ans->question = Gig_question::where(['id' => $ques_ans->gig_question_id])->first()->question;
            }
            $query = DB::table('order_log')->select('*')->where(['order_id'=>$order->id])->get();
            $data['order_log'] = $query;
            $data['logs'] = $query;
            $data['customOrder'] = $customOrder;
            $data['order'] = $order;
            /* var_dump($order);
             exit;*/
            $data['messages'] = $messages;
            $data['agencyMessages'] = $agencyMessages;
            $data['order_questions'] = $order_questions;
            $data['user'] = $user;
            $data['agency_details'] = $agency_details;
            $data['aggencyamount'] = $agencyAmount;
            $data['count_cl_msgs'] = $count_client_messages;
            $data['count_agency_msgs'] = $count_agency_msgs;
            $data['order_feedback'] = $order_feedback;
//            $data['gig_suggested_by_user_name'] = $gig_suggested_by_user_type2;

            return view('pages.admin.order')->with($data);

        } else {

            return Redirect::back();
        }
    }

    public function ajax_order(Request $request)
    {
        $orderNo = $request->input('orderno');
        $orderUUID = $request->input('uuid');
        $admin = Auth::admin()->get();
        $message = 'open order page';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        $order_block = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->update(['user_active' => $admin->id]);
        $order_feedback = DB::table('order_feedback')->where('order_id',$orderNo)->first();
        $order_message = "Enter order page";
        $this->InsertNeworderLog($remote_addr,$request_uri,$admin->id,$order_message,$order->id);
        if (!empty($order)) {
            if (isset($_GET['id'])) {
                $notify = Notification::where('id', $_GET['id'])->first();
                $notify->seen = 1;
                $notify->save();
            }
            /* $agencies         = Agency::where('type', 'agency')->get();*/
            if ($order->type != 'custom' && $order->type != 'package') {
                $gig = Gig::where(['id' => $order->gig_id])->first();
                $gigType = Gigtype::where('id', $gig->gigtype_id)->first();
                $gig_suggested_by_user_type = User::where('id', $gig->suggested_by)->value('type');
                $gig_suggested_by_user_type2 = User::where('id', $gig->suggested_by)->first();

                if (!empty($gig_suggested_by_user_type))
                    $gig->user_type = $gig_suggested_by_user_type;

                $gigSubcat = Gigtype_Subcategory::where('gigtypes_id', $gigType->id)->first();
                $gigAddon = OrderAddon::where('order_id', $order->id)->get();
                $dataAgencies = DB::table('agency_additional')->get();


                /*$agencies = array();*/
                foreach ($dataAgencies as $agency) {
                    if (!empty($agency->skills)) {
                        $skills = explode(',', $agency->skills);

                        for ($i = 0; $i < count($skills); $i++) {
                            if ($skills[$i] === $gigSubcat->name) {
                                $agencies[] = Agency::where('id', $agency->agency_id)->first();
                            } else {
                                $no_agencies = '';
                            }
                        }

                        /*$pendingOrders = $agencies->getPendingOrders();*/
                        /*$completedOrders = $agencies->getCompletedOrders();*/

                    }
                }

                if (!empty($agencies)) {
                    foreach ($agencies as $agency) {
                        $agency['pendingOrders'] = $agency->getPendingOrders();
                        $agency['completedOrders'] = $agency->getCompletedOrders();
                    }
                }

                if (!empty($agencies))
                    $data['agencies'] = $agencies;
                $data['gig_suggested_by_user_name'] = $gig_suggested_by_user_type2;
                $data['gigtype'] = $gigType;
                $data['subCat'] = $gigSubcat;
                $data['gig'] = $gig;
                $data['gigAddons'] = $gigAddon;

            } else {
                $agencies = Agency::where('type', 'agency')->get();
                foreach ($agencies as $agency) {
                    $agency['pendingOrders'] = $agency->getPendingOrders();
                    $agency['completedOrders'] = $agency->getCompletedOrders();
                }

                $data['agencies'] = $agencies;

            }


            $customOrder = CustomOrder::select('status', 'amount_offer', 'total_days')->where('order_id', $order->id)->first();

            $user = User::where(['id' => $order->user_id])->first();
            $agency_details = Agency_details::where(['agency_id' => $order->assigned_to])->first();
            $agencyAmount = User::where(['id' => $order->assigned_to])->first();
            $messages = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->get();
            $count_client_messages = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->count();
            $agencyMessages = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->get();
            $count_agency_msgs = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->count();
            $order_questions = DB::table('order_questions_answers')->where(['order_id' => $order->id])->get();

            foreach ($order_questions as $ques_ans) {
                $ques_ans->question = Gig_question::where(['id' => $ques_ans->gig_question_id])->first()->question;
            }
            $query = DB::table('order_log')->select('*')->where(['order_id'=>$order->id])->get();
            $data['order_log'] = $query;
            $data['logs'] = $query;
            $data['customOrder'] = $customOrder;
            $data['order'] = $order;
            /* var_dump($order);
             exit;*/
            $data['messages'] = $messages;
            $data['agencyMessages'] = $agencyMessages;
            $data['order_questions'] = $order_questions;
            $data['user'] = $user;
            $data['agency_details'] = $agency_details;
            $data['aggencyamount'] = $agencyAmount;
            $data['count_cl_msgs'] = $count_client_messages;
            $data['count_agency_msgs'] = $count_agency_msgs;
            $data['order_feedback'] = $order_feedback;
//            $data['gig_suggested_by_user_name'] = $gig_suggested_by_user_type2;

            return view('pages.admin.order')->with($data);

        } else {

            return Redirect::back();
        }
    }

    public function get_recent_messages($orderNo, $orderUUID)
    {

        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        //$check_new_msg = Notification::where(['order_id' => $order->id, 'seen' => '0'])->get();

        $agencyMessages = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->get();

        $output = $this->generate_chat_output($agencyMessages);

        echo $output;

    }


    public function get_admin_user_msgs($orderNo, $orderUUID){

        $order = Order::where( ['order_no' => $orderNo, 'uuid' => $orderUUID] )->first();

        $messages = Message::where( ['order_id' => $order->id, 'to_id' => $order->user_id] )->orWhere( ['order_id' => $order->id, 'user_id' => $order->user_id])->get();

        $output = $this->generate_chat_output( $messages );

        echo $output;
    }

    function getCountClientMsgs($orderNo, $orderUUID){

        $order = Order::where( ['order_no' => $orderNo, 'uuid' => $orderUUID] )->first();

        $count_client_messages = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->count();

        return response()->json(['count' => $count_client_messages]);
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

                if ($message->user_id == Auth::admin()->get()->id) {

                    $username = User::find($message->user_id)->username;

                    $output .= '<div class="direct-chat-msg">';
                    $output .= '<div class="direct-chat-info clearfix">';

                    $output .= '<span class="direct-chat-name pull-left">' . $username . '</span>';
                    $output .= '<span class="direct-chat-timestamp pull-right">' . date("d M y h:i a", strtotime($message->created_at)) . '</span>';
                    $output .= '</div>';

                    $profile_image = User::find($message->user_id)->profile_image;

                    if (!empty($profile_image)) {
                        $output .= '<img class="direct-chat-img" src="' . $profile_image . '" alt="message user image ">';
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
                                $output .= '<img class="direct-chat-img" src="' . $profile_image . '" alt="message user image">';
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

    function isValidURL($url)
    {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*
        (:[0-9]+)?(/.*)?$|i', $url);
    }

    public function assignJobTo(Request $request)
    {
        $admin = Auth::admin()->get();
        $message = 'Assign job';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $orderuuid = $request->input('orderuuid');
        $agencyId = $request->input('agency');

        $assign = Agency::assignJob($orderuuid, $agencyId);
        $order = Order::where(['uuid' => $orderuuid])->first();
        $order_message = "Assign job";
        $this->InsertNeworderLog($remote_addr,$request_uri,$admin->id,$order_message,$order->id);
//        $this->InsertNeworderLog($remote_addr, $request_uri,$admin->id,$message,$order->order_no);
        $agency = User::where(['type' => 'agency', 'id' => $agencyId])->first();
        $from = 'marketplace@4slash.com';
        $sub = 'Agency | New Order | 4slash';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
        $data = [
            'user' => $agency->username,
            'order_no' => $order->order_no,
            'orderuuid' => $order->uuid
        ];
        $to = $agency->email;
        $body = view('agencyEmail', $data)->render();
        //$body = 'Admin Assigned a new Order <a href="'.route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]).'">Click here to see </a>';
        mail($to, $sub, $body, $headers);
        if ($assign) {

            $not_id = Notification::sendNotification($order->id, $agency->id, '<a href="' . route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">Admin Assigned a new Order</a>');
            Notification::where('id', $not_id)->update(['message' => '<a href="' . route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">Admin Assigned a new Order</a>']);
        }

        return redirect()->back();
    }

    public function jobDone($orderNo, $orderUUID)
    {
        $admin = Auth::admin()->get();
        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        $user = User::where(['type' => 'user', 'id' => $order->user_id])->first();
        $order->status = 'jobdone';
        $order->save();
        $message = 'Job done by admin';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $this->InsertNeworderLog($remote_addr, $request_uri,$admin->id,$message,$order->id);
        $from = 'marketplace@4slash.com';
        $sub = 'Job done | 4slash';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
        $data = [
            'adminJobDone' => 'adminDone',
            'user' => $user->username,
            'order_no' => $order->order_no,
        ];
        $body = view('jobDoneMail', $data)->render();
        mail($user->email, $sub, $body, $headers);
        if ($order) {
            $not_id = Notification::sendNotification($order->id, $user->id, '<a href="' . route('myorders', ['orderno' => $orderNo]) . '">Order done"</a>');
            Notification::where('id', $not_id)->update(['message' => '<a href="' . route('myorders', ['orderno' => $orderNo, 'id' => $not_id]) . '">Order done"</a>']);

        }
        return Redirect::back();
    }


    public function jobCancel($orderNo, $orderUUID)
    {
        $admin = Auth::admin()->get();
        $message = 'cancel order';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $this->InsertNewLog($remote_addr, $request_uri,$admin->id,$message);
        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        $user = User::where(['type' => 'user', 'id' => $order->user_id])->first();
        $agency = User::where(['type' => 'agency', 'id' => $order->assigned_to])->first();
        $users = array('user', 'admin', 'agency');
        $data['admin'] = User::where('type', 'admin')->first();
        $data['user'] = $agency;
        $order->status = 'cancel';
        $order->assigned_to = 0;
        $order->save();
        $this->InsertNeworderLog($remote_addr, $request_uri,$admin->id,$message,$order->id);
        for ($i = 0; $i <= 2; $i++) {

            $from = 'marketplace@4slash.com';
            $sub = 'cancel job | 4slash';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
            if ($users[$i] == 'user') {
                $data = [
                    'type' => 'user',
                    'order_no' => $order->order_no,
                    'gig' => $order->custom_order_products,
                    'date' => $order->created_at,
                    'user' => $user->username,
                ];
                $to = $user->email;
                $view = View('canceledOrdermail', $data)->render();
                $mailbody = $view;
                // $to = $user->email;

                mail($to, $sub, $mailbody, $headers);


            } else if ($users[$i] == 'admin') {
                $data_admin = [
                    'type' => 'admin',
                    'order_no' => $order->order_no,
                    'orderUUID' => $order->uuid,
                    'gig' => $order->custom_order_products,
                    'date' => $order->created_at,
                    'gig_amount' => $order->amount,
                    'user' => $user->username,
                    'user_email' => $user->email

                ];

                $view = View('canceledOrdermail', $data_admin)->render();
                $to = 'marketplace@4slash.com';
                $subAdmin = 'job cancel | 4slash';

                mail($to, $subAdmin, $view, $headers);
            }
//            else if ($users[$i] == 'agency') {
//                $data_agency = [
//                    'type' => 'agency',
//                    'order_no' => $order->order_no,
//                    'orderUUID' => $order->uuid,
//                    'gig' => $order->custom_order_products,
//                    'date' => $order->created_at,
//                    'gig_amount' => $order->amount,
//                    'user' => $user->username,
//                    'user_email' => $user->email,
//                    'agency' => $agency->username
//
//                ];
//
//                $view = View('canceledOrdermail', $data_agency)->render();
//                $to = $agency->email;
//                $subAdmin = 'job cancel | 4slash';
//
//                mail($to, $subAdmin, $view, $headers);
//            }


        }

        return Redirect::back();

    }


    public function messageImages(Request $request, $orderNo, $orderUUID, $user){
        if (!empty($_FILES)) {
            $admin_id = $_POST['session'];
            $admin = Admin::where(['type' => 'admin', 'id' => $admin_id])->first();
            $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
            $targetFolder = public_path() . '/files/orders/messages';
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath =  $targetFolder;
            $file = rand(0, 1000) . 'ok' . time().$_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath,'/') . '/' . $file;

            // Validate the file type
            $fileTypes = array('jpg','jpeg','png','doc','pdf','zip','ai'); // File extensions
            $fileParts = pathinfo($file);
            if($user == 'client'){
                $to_id = $order->user_id;

            }
            else{
                $to_id = $order->assigned_to;
            }

            if (in_array($fileParts['extension'],$fileTypes)) {
                move_uploaded_file($tempFile,$targetFile);
                $file_url = '<a download class="drag_file" target="_blank" href="'. url() . '/files/orders/messages/' . $file .'"><i class="fa fa-file" style="padding: 4px;"></i>'. $file .'</a>';
                $file_data =  [
                    'file_name' => $file_url,
                    'to_id' => $to_id,
                    'user_id'   => $admin->id,
                    'order_id' => $order->id
                ];
                $message_file = DB::table('message_files')->insertGetId($file_data);
                /*$created_at = date("Y-m-d H:m:s");
                $files = DB::table('message_files')->where('created_at',$created_at)->get();
                $name = '';
                $created_at = '';
                $last_id = '';
                foreach($files as $file){
                    $name = $file->name;
                    $created_at = $file->created_at;
                    $last_id = $file->id;
                }*/

                return ['id' =>$message_file, 'username' => $admin->username, 'profile_image' => $admin->profile_image];
                //  header('Content-Type: application/json');
                //  echo json_encode();

            } else {
                echo 'Invalid file type.';
            }
        }

    }


    public function GetorderMessageFiles(Request $request){
        $admin = Auth::admin()->get();
        $ids = $request->input('data');
        $message_files = new \stdClass();
        $message_input = '';
        if($request->input('message') != ''){
            $message_input .='<pre class="font-family">'.$request->input('message').'</pre>'.'<br><br>';
        }
        if(is_array($ids)){
            foreach($ids as $id){
                $message_files = DB::table('message_files')->where('id',$id)->first();
                $message_input .= $message_files->file_name.'<br>';
            }

        }


        $order = Order::where('id', $request->input('order_id'))->first();
        if ($message = Message::sendMessage($request, $admin, $order->uuid, '4slash', $message_input)) {
            $users = User::where(['type' => 'user', 'id' => $order->user_id])->first();
            $agency = Agency::where(['type' => 'agency', 'id' => $order->assigned_to])->first();
            if ($request->input('receiver') == 'agency') {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $not_id = Notification::sendNotification($order->id, $agency->id, '<a href="' . route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification">New message from admin </a>');
                Notification::where('id', $not_id)->update(['message' => '<a href="' . route('agencySingleOrder', ['orderno' => $order->order_no, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">New message from admin </a>']);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            } elseif ($request->input('receiver') == 'client') {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                //  Notification::sendNotification($order->id,$users->id,'<a href="'.route('myorders', ['orderno' => $orderNo]).'">New message from admin </a>');
                $not_id = Notification::sendNotification($order->id, $users->id, '<a href="' . route('myorders', ['orderno' => $order->order_no]) . '">You have a new message. </a>');
                Notification::where('id', $not_id)->update(['message' => '<a href="' . route('myorders', ['orderno' => $order->order_no, 'id' => $not_id]) . '">You have a new message. </a>']);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }
            return ['user' => ['username' => $admin->username, 'profile_image' => $admin->profile_image], 'message' => $message->body, 'created_at' => date("d M h:i a", strtotime($message->created_at))];


        } else {
            return 'error';
        }

    }

    function sendOrderMessage(Request $request, $orderNo, $orderUUID)
    {


        $admin = Auth::admin()->get();
        $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        $m = Message::where(['message_status' => 'offered', 'order_id' => $order->id])->first();
        $message_input = $request->input('message');
        $dropfiles = $request->input('dropfiles');
        $new_drop_files = explode(",",$dropfiles);
       

        if (!empty($m)) {
            if ($message = Message::sendcustomMessage($request, $admin, $orderUUID, '4slash', $message_input)) {

                $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
                $users = User::where(['type' => 'user', 'id' => $order->user_id])->first();
                if (($request->input('receiver') == 'client') && $request->input('custom_amount')) {
                    $order->custom_offer_status = 'offered';
                    $order->save();
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    $not_id = Notification::sendNotification($order->id, $users->id, '<a href="' . route('myorders', ['orderno' => $orderNo]) . '">Custom offer inquiry</a>');
                    Notification::where('id', $not_id)->update(['message' => '<a href="' . route('myorders', ['orderno' => $orderNo, 'id' => $not_id]) . '">Custom offer inquiry</a>']);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                }
                $order_message = 'Send order message';
                $remote_addr = $_SERVER['REMOTE_ADDR'];
                $request_uri = url().$_SERVER['REQUEST_URI'];
                $this->InsertNeworderLog($remote_addr,$request_uri,$admin->id,$order_message,$order->id);
                return ['user' => ['username' => $admin->username, 'profile_image' => $admin->profile_image], 'message' => $message->body, 'created_at' => date("d M h:i a", strtotime($message->created_at))];
            }

        } else {
            if ($message = Message::sendMessage($request, $admin, $orderUUID, '4slash',$message_input)) {

                $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
                $users = User::where(['type' => 'user', 'id' => $order->user_id])->first();
                $agency = Agency::where(['type' => 'agency', 'id' => $order->assigned_to])->first();
                if ($request->input('receiver') == 'agency') {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    $not_id = Notification::sendNotification($order->id, $agency->id, '<a href="' . route('agencySingleOrder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]) . '?ref=notification">New message from admin </a>');
                    Notification::where('id', $not_id)->update(['message' => '<a href="' . route('agencySingleOrder', ['orderno' => $orderNo, 'orderuuid' => $order->uuid]) . '?ref=notification&id=' . $not_id . '">New message from admin </a>']);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                } elseif ($request->input('receiver') == 'client') {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    //  Notification::sendNotification($order->id,$users->id,'<a href="'.route('myorders', ['orderno' => $orderNo]).'">New message from admin </a>');
                    $not_id = Notification::sendNotification($order->id, $users->id, '<a href="' . route('myorders', ['orderno' => $orderNo]) . '">You have a new message. </a>');
                    Notification::where('id', $not_id)->update(['message' => '<a href="' . route('myorders', ['orderno' => $orderNo, 'id' => $not_id]) . '">You have a new message. </a>']);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                }
                $order_message = 'Send custom offer';
                $remote_addr = $_SERVER['REMOTE_ADDR'];
                $request_uri = url().$_SERVER['REQUEST_URI'];
                $this->InsertNeworderLog($remote_addr,$request_uri,$admin->id,$order_message,$order->id);
                return ['user' => ['username' => $admin->username, 'profile_image' => $admin->profile_image], 'message' => $message->body, 'created_at' => date("d M h:i a", strtotime($message->created_at))];


            } else {
                return 'error';
            }

        }
    }

    public function get_orders_block($status){
        if(!empty($status)){
            $order_block = DB::table('orders')
                ->join('users','orders.assigned_to','=','users.id')
                ->orderBy('id','desc')
                ->select('orders.*','users.username')
                ->where(['orders.type' => 'custom','orders.status'=> $status])
                ->orwhere(['orders.type' => 'custom','orders.status'=> 'review'])
                ->orwhere(['orders.type' => 'custom','orders.status'=> 'jobdone'])
                ->get();
            return $order_block;
        }{
            return "error";
        }
    }

    public function get_gig_orders_block($status){
        if(!empty($status)){
            $order_block = DB::table('orders')
                ->join('gigs','orders.gig_id','=','gigs.id')
                ->join('users','orders.assigned_to','=','users.id')
                ->orderBy('id','desc')
                ->select('orders.*','users.username','gigs.title')
                ->where(['orders.type' => 'gig','orders.status'=> $status])
                ->orwhere(['orders.type' => 'gig','orders.status' => 'review'])
                ->orwhere(['orders.type' => 'gig','orders.status' => 'jobdone'])
                ->get();
            return $order_block;
        }{
            return "error";
        }
    }

    public function open_order(Request $request){
        $admin = Auth::admin()->get();
        $order_message = 'Left order at';
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $request_uri = url().$_SERVER['REQUEST_URI'];
        $order_no = $request->input('order_no');
        $funnel = $request->input('funnel');
        $status = "pending";
        $order_block = Order::where(['order_no' => $order_no, 'uuid' => $funnel])->update(['user_active' => null,'leave_request' => 0]);
        $order = Order::where(['order_no' => $order_no, 'uuid' => $funnel])->get();


        foreach ($order as $type){
            /*var_dump($order->id);
            exit;*/
            if($type->type == "custom") {
                $this->InsertNeworderLog($remote_addr,$request_uri,$admin->id,$order_message,$type->id);
                $url = url('/') . "/admin/orders/custom?status=pending";
                if ($order_block) {
                    return redirect($url);
                } else {
                    return Redirect::back();
                }
            }else{
                $this->InsertNeworderLog($remote_addr,$request_uri,$admin->id,$order_message,$type->id);
                $url = url('/') . "/admin/orders?status=pending";
                if ($order_block) {
                    return redirect($url);
                } else {
                    return Redirect::back();
                }
            }
        }
    }

    public function leave_request(Request $request){
        $order_no = $request->input('order_no');
        $funnel = $request->input('funnel');
        $update = Order::where(['uuid' => $funnel,'order_no' => $order_no])->update(['leave_request' => 1]);
        if($update){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function check_leave_request($order_no,$funnel){
        $order = Order::where(['order_no' => $order_no, 'uuid' => $funnel])->get();
        if($order){
            return $order;
        }else{
            return false;
        }
    }

    public function cancel_leave(Request $request){
        $order_no = $request->input('order_no');
        $funnel = $request->input('funnel');
        $update = Order::where(['uuid' => $funnel,'order_no' => $order_no])->update(['leave_request' => 0]);
        if($update){
            echo 1;
        }else{
            echo 0;
        }
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
