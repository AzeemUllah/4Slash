<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    protected static $instance = null;

    protected $fillable = [
        'user_id',
        'message',
        'seen',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'updated_at',
    ];

    public static function getInstance()
    {
        if(is_null(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

    /**
     * @param $userId
     * @param $message
     * @return bool
     */
    public static function sendNotification($orderid, $userId, $message)
    {

        $notification = self::getInstance();
        $notification->user_id = $userId;
        $notification->message = $message;
        $notification->order_id = $orderid;
        $notification->save();

        return $notification->id;



    }

    public static function sendNotification_agency($orderid, $userId, $message)
    {

        $notification = self::getInstance();
        $notification->user_id = $userId;
        $notification->message = $message;
        $notification->order_id = $orderid;
        $notification->save();

        return $notification->id;



    }

    public static function hasNotifications()
    {
        $admin = Auth::admin()->get();
        $user = Auth::user()->get();
        $agency = Auth::agency()->get();
        if($admin)
        {
          $totalNotifications = self::where(['user_id' => $admin->id, 'seen' => 0])->count();

           if($totalNotifications > 0) {
                return true;
            } else {
                return false;
            }
        }
        elseif($user){

            $tnotifications = self::where(['user_id' => $user->id, 'seen' => 0])->count();
            if($tnotifications > 0)
            {
                return true;
            }
            elseif($agency)
            {
                $tnotifications = self::where(['user_id' => $agency->id, 'seen' => 0])->count();
                if($tnotifications > 0)
                {
                    return true;
                }

            }
            else{

                return false;
            }
        }
    }

    public static function totalNotifications()
    {
        $user = Auth::admin()->get();
        return $totalNotifications = self::where(['user_id' => $user->id, 'seen' => 0])->count();
    }

    public static function complaintNotifications()
    {
        return $totalcomplaintNotifications = DB::table('order_complaints')->where('status',0)->count();
    }

    public static function getNotifications()
    {
        $user = Auth::admin()->get();
        return $notifications = self::where(['user_id' => $user->id])->orderBy('created_at', 'desc')->get();
    }

    public static function getAgencyNotifications()
    {

        $agency = Auth::agency()->get();
        $notifications= self::where(['user_id' => $agency->id])->orderBy('created_at','desc')->get();
        return $notifications;

    }

    public static function getuserNotification($offset)

    {

        $user = Auth::user()->get();
        $notifications= self::where(['user_id' => $user->id])->orderBy('created_at','desc')->take(4)->offset($offset);
        return  $notifications;

    }

    public static function usertotalNotifications()
    {
        $user = Auth::user()->get();
        return $usertotalNotifications = self::where(['user_id' => $user->id, 'seen' => 0])->count();

    }
    public static function agencytotalNotifications()
    {
        $agency = Auth::agency()->get();
        return $usertotalNotifications = self::where(['user_id' => $agency->id, 'seen' => 0])->count();



    }
}
