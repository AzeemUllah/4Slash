<?php
namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait LogTrait{

    function InsertNewLog($remote_addr,$request_uri,$user,$message){

        DB::table('cnerr_log')->insert([
            'remote_addr' => $remote_addr,
            'request_uri' => $request_uri,
            'user_id' => $user,
            'message' => $message
        ]);
        return true;

    }

    function InsertNeworderLog($remote_addr,$request_uri,$user,$message,$order_id){
        DB::table('order_log')->insert([
            'remote_addr' => $remote_addr,
            'request_uri' => $request_uri,
            'user_id' => $user,
            'message' => $message,
            'order_id' => $order_id
        ]);
        return true;

    }
}