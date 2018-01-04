<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Gig_addon;
use Illuminate\Support\Facades\Session;

class OrderAddon extends Model
{
    protected $table = 'order_addons';

    protected $fillable = [
        'addon',
        'addon_id',
        'quantity',
        'amount',
        'total_amount',
        'order_id',
    ];

   // public $addon;
  //  public $amount;

    public static function getOrderAddons($addons) {
        $orderAddons = [];

        if(is_array($addons)) {
            foreach ($addons as $key => $value) {
                $gigAddon = Gig_addon::where('id', $key)->first();
                $orderAddon = new OrderAddon();
                $orderAddon->addon = $gigAddon->addon;
                $orderAddon->addon_id = $key;
                $orderAddon->amount = $gigAddon->amount;
                $orderAddon->quantity = $value;
                $orderAddon->total_amount = ((float)$gigAddon->amount * (float)$value);
                array_push($orderAddons, $orderAddon);
            }
        }

        return $orderAddons;
    }
    public static function insertOrderAddons($addons) {
        $orderAddons = [];
        $order_id = Session::get('order_id');
        $addon_quantity = Session::get('addon_quantity');
        $i = 0;
        if(is_array($addons)) {
            foreach ($addons as $key => $value) {
                $gigAddon = Gig_addon::where(['id'=> $value['id']])->first();
                $orderAddon = new OrderAddon();
                $orderAddon->addon = $value['addon'];
                $orderAddon->addon_id = $value['id'];
                $orderAddon->amount = $value['amount'];
                $orderAddon->quantity   = $addon_quantity[$i];
                $orderAddon->total_amount = Session::get('total_order_amount');
                $orderAddon->order_id = $order_id;
                $orderAddon->save();
                array_push($orderAddons, $orderAddon);
                $i++;
            }
        }

        return $orderAddons;
    }


}