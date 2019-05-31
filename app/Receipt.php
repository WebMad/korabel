<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'stead_id',
        'file',
        'date_receipt',
    ];
}
