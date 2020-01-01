<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'header',
        'content',
    ];


    public function imagesNew()
    {
        return $this->hasMany('App\ImagesNew', 'new_id', 'id');
    }
}