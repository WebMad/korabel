<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
    protected $table = 'users_roles';
    protected $fillable = ['user_id', 'role_id'];
    public $timestamps = false;
}
