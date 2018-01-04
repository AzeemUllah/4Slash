<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Message;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Gig_question;
use Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{

    public function index($orderNo, $orderUUID)
    {
        $agencies           = Agency::where('type', 'agency')->get();
        $order              = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
        $user               = User::where(['id' => $order->user_id])->first();
        $messages           = Message::where(['order_id' => $order->id, 'to_id' => $order->user_id])->orWhere(['order_id' => $order->id, 'user_id' => $order->user_id])->get();
        $agencyMessages     = Message::where(['order_id' => $order->id, 'to_id' => $order->assigned_to])->orWhere(['order_id' => $order->id, 'user_id' => $order->assigned_to])->get();
        $order_questions    = DB::table('order_questions_answers')->where(['order_id' => $order->id])->get();
        foreach($order_questions as $ques_ans) {
            $ques_ans->question = Gig_question::where(['id' => $ques_ans->gig_question_id])->first()->question;
        }

        $data['agencies']           = $agencies;
        $data['order']              = $order;
        $data['messages']           = $messages;
        $data['agencyMessages']     = $agencyMessages;
        $data['order_questions']    = $order_questions;
        $data['user']               = $user;

        return view('pages.admin.order')->with($data);
    }

    public function assignJobTo(Request $request)
    {
        $orderuuid = $request->input('orderuuid');
        $agencyId = $request->input('agency');

        Agency::assignJob($orderuuid, $agencyId);

        return redirect()->back();
    }
    
    public function jobDone($orderNo, $orderUUID)
    {
            $order = Order::where(['order_no' => $orderNo, 'uuid' => $orderUUID])->first();
            $order->status = 'jobdone';
            $order->save();
            
            return Redirect::back();
    }

    function sendOrderMessage(Request $request, $orderNo, $orderUUID) {

        $user = Auth::admin()->get();

        if($message = Message::sendMessage($request, $user, $orderUUID, 'Cnerr')) {
            return ['user' => ['username' => $user->username, 'profile_image' => $user->profile_image], 'message' => $message->body, 'created_at' => date("d M h:i a", strtotime($message->created_at))];
        } else {
            return 'error';
        }

    }


}
