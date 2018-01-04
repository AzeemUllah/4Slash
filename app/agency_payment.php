<?php

namespace app;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class agency_pay extends model{

    use Authenticatable;

    protected $table = 'agency_payment_details';

    protected $fillable = 'bank_name';

    public $timestamps = false;
}
