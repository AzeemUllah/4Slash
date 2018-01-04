<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\CustomOrder;
use App\Order;
use DB;

class Message extends Model
{
    protected $table = 'messages';
    protected static $instance = null;

    protected $fillable = [
        'order_id',
        'user_id',
        'to_id',
        'body',
    ];

    public static function getInstance()
    {
        if(is_null(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

    public static function sendMessage($request, $user, $orderuuid = null, $from, $message)
    {

        $url = filter_var($message, FILTER_SANITIZE_URL);
        if(!filter_var($url, FILTER_VALIDATE_URL) === false){
            $file_name = $url;
            $message = '<pre class="font-family">'.'<i class="fa fa-file" style="padding: 4px; color:white;"></i><a href="'.$message.'">'.$file_name.'</a>'.'</pre>';
        }else{
            $message = '<pre class="font-family">'.$message.'</pre>';
        }

        $orderuuid = ($orderuuid) ? $orderuuid : $request->input('orderuuid');
        $order = Order::where(['uuid' => $orderuuid])->first();
        

        if($request->has('custom_offer') && $request->input('custom_offer') == '1')
           // $message .= '<br><button type="submit" id="pay-now" class="form-control">Pay Now</button>';
        if($request->has('custom_amount') && $request->has('custom_offer')) {
            CustomOrder::where('order_id', $order->id)->update(['amount_offer' => $request->input('custom_amount'), 'status' => 'offered','total_days' => $request->input('total_days')]);
          //  $updateAmount = Order::where('uuid', $orderuuid)->update(['amount' => $request->input('custom_amount'), 'type' => 'custom_offer']);
        }


        $messageInstance = self::getInstance();
        $messageInstance->order_id = $order->id;
        $messageInstance->user_id = $user->id;

        if($request->input('receiver')) {
            if($request->input('receiver') == 'client') {
                $messageInstance->to_id = $order->user_id;
            } else if($request->input('receiver') == 'agency') {
                $messageInstance->to_id = $order->assigned_to;
            }else{
                $messageInstance->to_id = $order->user_id;
            }
        }



        if($request->has('custom_amount'))
            $messageInstance->message_status = 'offered';

        $textMessage = (!empty($message) ? $message : '');
        if(!empty($request->input('files'))) {
            $files = explode(',', $request->input('files'));
            foreach ($files as $file) {

                $file_url = '<a download class="drag_file" target="_blank" href="' . url() . '/files/orders/messages/' . $file . '">' . '<i class="fa fa-file" style="padding: 4px;"></i>' . $file . '</a>';

                $file_data = [
                    'file_name' => $file_url,
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'to_id' => $order->user_id
                ];

                DB::table('message_files')->insertGetId($file_data);
                $txtFileMessages[] = $file_url;

            }
        }

        if(!empty($request->input('dropfiles'))) {
            $new_drop_files = explode(',', $request->input('dropfiles'));
            foreach ($new_drop_files as $new_drop_file) {
                $file_url = '<a class="drag_file" target="_blank" href="' . $new_drop_file . '">' . '<i class="fa fa-file" style="padding: 4px;"></i>' . $new_drop_file . '</a>';
                $file_data = [
                    'file_name' => $file_url,
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'to_id'    => $order->user_id
                ];
                $message_file = DB::table('message_files')->insertGetId($file_data);
                $txtFileMessages[] = $file_url;
            }
        }

        if(!empty($txtFileMessages)){
            $textMessage .= implode(',', $txtFileMessages);
        }

        $messageInstance->body = $textMessage;
        $saved = $messageInstance->save();



        if($saved) {
            return $messageInstance;
        } else {
            return false;
        }
    }

    public static function sendcustomMessage($request, $user, $orderuuid = null, $from, $message)
    {

        if(filter_var($message, FILTER_VALIDATE_URL)){
            $file_name = explode('/', $message);
            $file_name = end($file_name);
            $message = '<pre class="font-family">'.'<i class="fa fa-file" style="padding: 4px;"></i><a href="'.$message.'">'.$file_name.'</a>'.'</pre>';
        }

        $orderuuid = ($orderuuid) ? $orderuuid : $request->input('orderuuid');
        $order = Order::where(['uuid' => $orderuuid])->first();


        if($request->has('custom_offer') && $request->input('custom_offer') == '1')
            // $message .= '<br><button type="submit" id="pay-now" class="form-control">Pay Now</button>';
            if($request->has('custom_amount') && $request->has('custom_offer')) {
                CustomOrder::where('order_id', $order->id)->update(['amount_offer' => $request->input('custom_amount'), 'status' => 'offered','total_days' => $request->input('total_days')]);
                //  $updateAmount = Order::where('uuid', $orderuuid)->update(['amount' => $request->input('custom_amount'), 'type' => 'custom_offer']);
            }


        $messageInstance = self::getInstance();
        $messageInstance->order_id = $order->id;
        $messageInstance->user_id = $user->id;

        if($request->input('receiver')) {
            if($request->input('receiver') == 'client') {
                $messageInstance->to_id = $order->user_id;
            } else if($request->input('receiver') == 'agency') {
                $messageInstance->to_id = $order->assigned_to;
            }else{
                $messageInstance->to_id = $order->user_id;
            }
        }



        if($request->has('custom_amount'))
            $messageInstance->message_status = 'offered';


        $messageInstance->body = $message;
        $saved = $messageInstance->save();



        if($saved) {
            return $messageInstance;
        } else {
            return false;
        }
    }
    

    public function sendMail($to,$sub, $from, $body,$headers)
    {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
        return mail($to,$sub,$body,$headers);

    }
}
