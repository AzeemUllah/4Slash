<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_company_info extends Model
{
    protected $table = 'client_company_info';
    protected $fillable = ['name', 'tagline', 'industry', 'discription'];
}
