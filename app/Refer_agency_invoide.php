<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Refer_agency_invoice extends Model
{
    protected $table = 'referr_agency_invoice';

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

    public function setreferr_agency_id($agencyId) {

        $this->referr_agency_id = $agencyId;

    }

}