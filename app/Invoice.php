<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Invoice extends Model
{
    protected $table = 'invoices';

    public function generate($orderId)
    {

        $last_invoice_no =  DB::table('invoices')->max("invoice_no");

        if(empty($last_invoice_no)) {
            $invoice_no = '32016001';
        }else{
            $invoice_no = ($last_invoice_no + 1);
        }

            $this->invoice_no = $invoice_no;
            //    $this->invoice_no = rand(0, 99) . date("dmy") . time();
            $this->order_id = $orderId;
            $this->save();

    }
}
