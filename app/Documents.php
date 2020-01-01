<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $fillable = ['file_id'];

    public function file()
    {
        return $this->hasOne('App\Files', 'id', 'file_id');
    }
}
