<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\News;
use App\Documents;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        if(!UserController::hasRole('show-admin-panel')){
            return redirect('/');
        }
    }

    public function index(){

    }
    public function users(){
        return view('admin.users.view', ['users' => User::get()]);
    }
    public function news(){
        return view('admin.news.view', ['news' => News::get()]);
    }
    public function documents(){
        return view('admin.documents.view', ['documents' => Documents::get()]);
    }

    public function uploadImage(Request $request){
        $v = Validator::make($request->all(), [
            'upload' => 'required|image',
        ]);

        if ($v->fails()) {
            $data = [
                'uploaded' => 1,
                'message' => $v->errors()->first(),
            ];
            return response(
                //"<script>window.parent.CKEDITOR.tools.callFunction('1', '', '{$v->errors()->first()}');</script>"
            )->json($data);
        }

        $file = $request->file('upload');

        $destinationPath = 'uploads/news';
        $fileName = time();
        $filePath = $destinationPath.'/'.$fileName. '.' .$file->getClientOriginalExtension();
        $file->move($destinationPath,$filePath);

        $url = '/'.$filePath;

        $data = [
            'uploaded' => 1,
            'fileName' => $fileName. '.' .$file->getClientOriginalExtension(),
            'url' => $url,
        ];

        return response(
            //"<script>window.parent.CKEDITOR.tools.callFunction('1', '{$url}', 'Изображение успешно загружено');</script>"
        )->json($data);
    }
}
