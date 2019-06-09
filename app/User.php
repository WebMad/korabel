<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'surname', 'name', 'patronymic', 'email', 'phone', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

    static public function search($string){
        $string = explode(' ', $string);

        $select = DB::table('users');

        if(isset($string[0])){
            $select->where('surname', 'LIKE', "%$string[0]%");
        }
        if(isset($string[1])){
            $select->where('name', 'LIKE', "%$string[1]%");
        }
        if(isset($string[2])){
            $select->where('patronymic', 'LIKE', "%$string[2]%");
        }

        return $select;

    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

}
