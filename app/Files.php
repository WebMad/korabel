<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = ['name', 'url', 'img', 'file_type_id'];

    public function imagesNew()
    {
        return $this->hasMany('App\ImagesNew', 'img_id', 'id');
    }

    public function fileType()
    {
        return $this->hasOne('App\FileType', 'id', 'file_type_id');
    }
}
