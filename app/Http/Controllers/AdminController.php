<?php

namespace App\Http\Controllers;

use App\FileType;
use App\Http\Requests\File\StoreImageRequest;
use App\Services\FileService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\News;
use App\Documents;
use App\User;

class AdminController extends Controller
{
    public function index(){

    }
    public function users(Request $request){
        $users = ($request->get('search')) ? User::search($request->get('search'))->paginate(30) : User::paginate(30);
        return view('admin.users.view', [
            'users' => $users
        ]);
    }
    public function news(Request $request){

        $news = $request->input('search') ? News::where('header', 'LIKE', '%'. $request->input('search') . '%')->paginate(30) : News::paginate(30);

        return view('admin.news.view', ['news' => $news]);
    }
    public function documents(Request $request){

        $documents = $request->input('search') ? Documents::where('name', 'LIKE', '%'. $request->input('search') . '%')->paginate(30) : Documents::paginate(30);

        return view('admin.documents.view', [
            'documents' => $documents
        ]);
    }
}
