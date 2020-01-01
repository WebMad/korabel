<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteInfo;

class SiteInfoController extends Controller
{


    public function index(){
        return view('admin.index', ['info' => self::getInfo()]);
    }

    public function update(Request $request){

        foreach (SiteInfo::$information_types as $type){
            SiteInfo::updateOrCreate(['name' => $type], [
                'name' => $type,
                'content' => $request->input($type),
            ]);
        }

        return back();
    }

    static public function getInfo(){

        $information = [];
        foreach(SiteInfo::all() as $info){
            $information[$info['name']] = $info['content'];
        }
        return $information;
    }
}
