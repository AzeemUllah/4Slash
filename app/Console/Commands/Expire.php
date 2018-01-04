<?php

namespace App\Console\Commands;

use App\User;
use App\Order;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class Expire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check expire orders and send email';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date("Y-m-d H:i:s");
        $agencies = User::where(['type' => 'agency'])->get();
        foreach ($agencies as $agency){
            $orders = Order::where(['assigned_to' => $agency])->get();
            foreach ($orders as $order){
                if($order->expiry == $date){
                    $from = 'no-reply@cnerr.de';
                    $sub = 'Bestellung | cnerr.de';
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";
                        $data = [
                            'user' => $agency->username,
                            'order_no' => $order->order_no,
                            'orderuuid' => $order->uuid
                        ];
                        $to = $agency->email;
                        $body = view('pages/email/order_expire', $data)->render();
                        $sub = 'Agency | Order Expire | Cnerr';
                        mail($to, $sub, $body, $headers);
                }
            }
        }


    }
}
