<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function index($id = null){
        if(isset($id)){
            $new = News::find($id);
            if(isset($new['id'])) {
                return view('news.more', ['new' => $new]);
            }
            return redirect(route('news'));
        }
        $news = News::paginate(5);
        return view('news.view', ['news' => $news]);
    }

    public function create(){
        return view('admin.news.create');
    }
    public function store(Request $request){
        $request->validate([
            'header' => 'required',
            'content' => 'required',
        ]);
        News::create($request->all());

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Новость добавлена!');

        return redirect(route('admin.news.index'));
    }

    public function edit($id){
        return view('admin.news.edit', ['new' => News::findOrFail($id)]);
    }
    public function update(Request $request, $id){
        $new = News::findOrFail($id);
        $request->validate([
            'header' => 'required',
            'content' => 'required',
        ]);
        $new->fill($request->all())->save();

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Данные сохранены!');

        return redirect(route('admin.news.index'));
    }

    public function delete($id){
        News::destroy($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Новость удалена!');

        return redirect(route('admin.news.index'));
    }
}
