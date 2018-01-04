<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class AgencyInvoice extends Model
{
    protected $table = 'agency_invoices';

    public $timestamps = false;


    public function setDetail($detail) {

        $this->detail = $detail;

    }

    public function setPayable($payable) {

        $this->payable = $payable;

    }

    public function setPaid($paid) {

        $this->paid = $paid;

    }

    public function setBalance($balance) {

        $this->balance = $balance;

    }

    public function setAgencyId($agencyId) {

        $this->agency_id = $agencyId;

    }
    public function setRefer_agencyId($agencyId) {

        $this->refer_agency_id = $agencyId;

    }
    public function setRefer_agencyAmount($agencyAmount) {

        $this->refer_agency_amount = $agencyAmount;

    }

    public function setRefer_agencyBalance($agencyBalance) {

        $this->refer_agency_bal = $agencyBalance;

    }

    public function setOrder_no($order_no) {

        $this->order_no = $order_no;

    }
    public function setMethod($method){
        $this->method = $method;
    }
}