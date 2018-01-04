<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Auth\Passwords\CanResetPassword;
use Kbwebs\MultiAuth\PasswordResets\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kbwebs\MultiAuth\PasswordResets\Contracts\CanResetPassword as CanResetPasswordContract;

class Agency extends Model implements AuthenticatableContract, CanResetPasswordContract
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
    protected $fillable = ['name', 'username', 'email', 'password', 'type', 'speaks','master_percent'];

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
    public static function assignJob($orderuuid, $agencyId)
    {
        $order = Order::where('uuid', $orderuuid)->first();
        $order->assigned_to = $agencyId;
        $saved = $order->save();

        return $saved;
    }

    public function getPendingOrders() {

        $pendingOrders = Order::where(['assigned_to' => $this->id, 'status' => 'pending', 'type' => 'gig'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'pending', 'type' => 'package'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'pending', 'type' => 'custom'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'jobdone', 'type' => 'gig'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'jobdone', 'type' => 'package'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'jobdone', 'type' => 'custom'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'jobdonebyagency', 'type' => 'gig'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'jobdonebyagency', 'type' => 'package'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'jobdonebyagency', 'type' => 'custom'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'review', 'type' => 'gig'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'review', 'type' => 'package'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'review', 'type' => 'custom'])
                                ->get();


        foreach($pendingOrders as $pendingOrder) {
            $pendingOrder->gig = Gig::where(['id' => $pendingOrder->gig_id])->first();
            $pendingOrder->gig = Package::where(['packages_id' => $pendingOrder->packages_id])->first();
            $pendingOrder->custom = $pendingOrder->type;
        }

        return $pendingOrders;

    }

    public function getCompletedOrders() {

        $completedOrders = Order::where(['assigned_to' => $this->id, 'status' => 'complete', 'type' => 'gig'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'complete', 'type' => 'package'])
                                ->orWhere(['assigned_to' => $this->id, 'status' => 'complete', 'type' => 'custom'])
                                ->get();

        foreach($completedOrders as $completedOrder) {
            $completedOrder->gig = Gig::where(['id' => $completedOrder->gig_id])->first();
            $completedOrder->gig = Package::where(['packages_id' => $completedOrder->packages_id])->first();
            $completedOrder->custom = $completedOrder->type;
        }

        return $completedOrders;

    }

    public static function agencyActivate($agencyid) {
        $agency = self::find($agencyid);

        if($agency->active) {
            $agency->active = 0;
        } else {
            $agency->active = 1;
        }

        $agency->save();

        return $agency->active;
    }


}