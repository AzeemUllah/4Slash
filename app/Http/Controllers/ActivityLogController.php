<?php
namespace App\Http\Controllers;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Logtrait;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ActivityLogController extends Controller
{

  public function InsertNewLog($remote_addr, $request_uri,$user,$message){

      DB::table('cnerr_log')->insert([
          'remote_addr' => $remote_addr,
          'request_uri' => $request_uri,
          'user_id' => $user->id,
          'message' => $message
      ]);

  }
}