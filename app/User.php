<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Auth\Passwords\CanResetPassword;
use Kbwebs\MultiAuth\PasswordResets\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kbwebs\MultiAuth\PasswordResets\Contracts\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
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
    protected $fillable = ['name', 'username', 'email', 'password','master_percent','agency_percentage', 'type', 'speaks', 'activation_code','newsletter'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function addWalletAmount($amount)
    {
        $this->wallet += $amount;
        $this->save();
    }

    public static function userActivate($userId)
    {
        $user = self::find($userId);

        if($user->active)
        {
            $user->active = 0;
        }
        else
        {
            $user->active = 1;
        }
        $user->save();

        return $user->active;

    }


}
