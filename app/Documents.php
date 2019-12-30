<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $fillable = [
        'name',
        'file',
        'file_id',
        'img',
        'type',
    ];

    public function file()
    {
        return $this->hasOne('App\Files', 'id', 'file_id');
    }
}
