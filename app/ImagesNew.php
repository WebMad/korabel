<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagesNew extends Model
{
    protected $fillable = ['new_id', 'img_id'];

    public function file()
    {
        return $this->hasOne('App\Files', 'id', 'img_id');
    }
}
