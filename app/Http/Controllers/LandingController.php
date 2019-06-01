<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Documents;
use App\Receipt;
use App\Stead;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public $months = [
        'январь',
        'февраль',
        'март',
        'апрель',
        'май',
        'июнь',
        'июль',
        'август',
        'сентябрь',
        'октябрь',
        'ноябрь',
        'декабрь'
    ];

    public function index(Request $request) {
        return view('landing.index', ['news' => News::get()]);
    }
    public function contacts(){
        return view('contacts', ['info' => InfoController::getInfo()]);
    }
    public function documents(){
        return view('documents', [
            'documents' => Documents::get()->where('type','default'),
            'patterns' => Documents::get()->where('type','pattern'),
            'protocols' => Documents::get()->where('type','protocol'),
        ]);
    }

    public function cabinet(){
        $steads = Stead::with('receipts')->where('user_id', Auth::user()->id)->get();
        return view('cabinet', [
            'user' => Auth::user(),
            'steads' => $steads,
            'months' => $this->months,
        ]);
    }
}
