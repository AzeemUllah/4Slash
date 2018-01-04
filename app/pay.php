<?php
/**
 * Created by PhpStorm.
 * User: Osama
 * Date: 6/30/2016
 * Time: 3:33 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class pay extends Model
{
    protected $table = 'agency_payment_details';

    protected $fillable = array(
        'bank_name',
        'acct_number',
        'acct_type',
        'bank_address',
        'city',
        'country',
        'postal_code',
        'paypal_acct',
        'iban_number',
        'swiss_code',
        'withdraw_status',
        'agency_id'
    );
}