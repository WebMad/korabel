<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    static public $information_types = [
        'site_name',
        'site_subname',
        'contact_phone',
        'contact_email',
        'contact_address',
        'legal_address',
        'latitude',
        'longitude',
    ];

    protected $fillable = [
        'name', 'content',
    ];

    public $timestamps = false;
}
