<?php

namespace App\Http\Controllers;

use App\Order;
use App\Notification;

class NotificationsController extends Controller
{
    public function index()
    {


    }

    public function getNotifications()
    {
        $notifications = Notification::getNotifications();
        foreach($notifications as $notification){
            $notification->time = $notification->created_at->diffForHumans();
            $date_time = explode(' ', $notification->created_at);
            $date_time = explode('-', $date_time[0]);
            $date_time = $date_time[2].'.'.$date_time[1].'.'.$date_time[0];
            $notification->date = $date_time;

        }

        return $notifications;
    }

    public function getUserNotification()
    {
        if(isset($_GET['offset'])){
            $offset = $_GET['offset'];
        }else{
            $offset = 0;
        }
        $notify = Notification::getuserNotification($offset)->get();

        foreach($notify as $notification){
            $notification->time = $notification->created_at->diffForHumans();
            $date_time = explode(' ', $notification->created_at);
            $date_time = explode('-', $date_time[0]);
            $date_time = $date_time[2].'.'.$date_time[1].'.'.$date_time[0];
            $notification->date = $date_time;

            $notification->not_id = $notification->id;


        }

        return $notify;
    }
   public function readUserNotification(){

          $readAll = Notification::getuserNotification();
          var_dump($readAll);
          exit;
           foreach($readAll as $read){
             $read->seen = 1;

           $read->save();
       }
        return $readAll;
    }
    public function getAgencyNotification()
    {
        if(isset($_GET['id']))
            Notification::where('id', $_GET['id'])->update(['seen' => 1]);

        $notification = Notification::getAgencyNotifications();
        foreach($notification as $not){
            $not->time = $not->created_at->diffForHumans();
            $date_time = explode(' ', $not->created_at);
            $date_time = explode('-', $date_time[0]);
            $date_time = $date_time[2].'.'.$date_time[1].'.'.$date_time[0];
            $not->date = $date_time;
            $order = Order::where('id', $not->order_id)->first();
            $not->order = $order;

        }
        return $notification;

    }







}
