<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stead extends Model
{
    protected $fillable = [
        'number',
        'user_id',
    ];

    public function receipts(){
        return $this->hasMany('App\Receipt', 'stead_id', 'id');
    }
}
