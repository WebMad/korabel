<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
    protected $table = 'UsersRole';
    protected $fillable = ['id_user', 'id_role'];
    public $timestamps = false;
}
