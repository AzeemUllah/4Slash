<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Auth\Passwords\CanResetPassword;
use Kbwebs\MultiAuth\PasswordResets\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kbwebs\MultiAuth\PasswordResets\Contracts\CanResetPassword as CanResetPasswordContract;

class UserDetails extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'password', 'type', 'speaks'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * @param $orderuuid
     * @param $agencyId
     * @return bool
     */


    public function getPendingOrders() {

        $pendingOrders = Order::where(['status' => 'pending', 'type' => 'gig'])->get();

        foreach($pendingOrders as $pendingOrder) {
            $pendingOrder->gig = Gig::where(['id' => $pendingOrder->gig_id])->first();
        }

        return $pendingOrders;

    }

    public function getCompletedOrders() {

        $completedOrders = Order::where(['status' => 'complete', 'type' => 'gig'])->get();

        foreach($completedOrders as $completedOrder) {
            $completedOrder->gig = Gig::where(['id' => $completedOrder->gig_id])->first();
        }

        return $completedOrders;

    }


}