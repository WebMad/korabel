<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Info;

class InfoController extends Controller
{
    public $information_types = [
        'site_name',
        'site_subname',
        'site_phone',
        'contact_phone',
        'contact_email',
        'contact_address',
        'legal_address',
        'contact_email',
        'latitude',
        'longitude',
    ];

    public function index(){
        return view('admin.index', ['info' => self::getInfo()]);
    }

    public function update(Request $request){

        foreach ($this->information_types as $type){
            Info::updateOrCreate(['name' => $type], [
                'name' => $type,
                'content' => $request->input($type),
            ]);
        }

        return back();
    }

    static public function getInfo(){

        $information = [];
        foreach(Info::get() as $info){
            $information[$info['name']] = $info['content'];
        }
        return $information;
    }
}
