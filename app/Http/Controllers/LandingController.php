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

    public function index(Request $request)
    {
        return view('landing.index', [
            'news' => News::get(),
            'info' => SiteInfoController::getInfo(),
        ]);
    }

    public function news($id = null){
        if(isset($id)){
            $new = News::find($id);
            if(isset($new['id'])) {
                return view('news.more', ['new' => $new]);
            }
            return redirect(route('news'));
        }
        $news = News::orderBy('id', 'desc')->paginate(5);
        return view('news.view', ['news' => $news]);
    }

    public function contacts()
    {
        return view('contacts', ['info' => SiteInfoController::getInfo()]);
    }

    public function documents()
    {
        return view('documents', [
            'documents' => Documents::get()->where('type', 'default'),
            'patterns' => Documents::get()->where('type', 'pattern'),
            'protocols' => Documents::get()->where('type', 'protocol'),
        ]);
    }

    public function cabinet()
    {
        $steads = Stead::with('receipts')->where('user_id', Auth::user()->id)->get();
        return view('cabinet', [
            'user' => Auth::user(),
            'steads' => $steads,
            'months' => $this->months,
        ]);
    }
}
