<?php

namespace App\Http\Controllers;

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
        return view('admin.index');
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
}
