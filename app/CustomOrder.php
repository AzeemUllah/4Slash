<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    protected $table = 'custom_orders';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'extra_notes',
        'amount_offer',
        'status',
        'total_days'

    ];

    /**
     * @param array $dataArray
     * @return bool
     */
    public static function createCustomOrder(array $dataArray)
    {
        $customOrder = new CustomOrder();
        $customOrder->name = $dataArray['name'];
        $customOrder->email = $dataArray['email'];
        $customOrder->phone = $dataArray['phone'];
        $customOrder->website = $dataArray['website'];
        $customOrder->extra_notes = $dataArray['extra_notes'];
        $customOrder->amount_offer = $dataArray['amount_offer'];
        $customOrder->status = $dataArray['status'];
        $customOrder->total_days = $dataArray['total_days'];
        $saved = $customOrder->save();

        if($saved)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

   
}