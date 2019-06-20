<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $news = News::orderBy('id', 'desc')->paginate(5);
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
        $news = News::create($request->all());

        $id_new = $news->id;

        $images = $this->getImages($request->input('content'), $id_new);

        DB::table('images_news')->insert($images);

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

        DB::table('images_news')->where('new_id', '=', $id)->delete();
        $images = $this->getImages($request->input('content'), $id);
        DB::table('images_news')->insert($images);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Данные сохранены!');

        return redirect(route('admin.news.index'));
    }

    public function delete($id){

        $files = DB::table('images_news')->where('new_id', $id)->get();
        foreach($files as $file){
            unlink(public_path($file->img_url));
        }

        News::destroy($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Новость удалена!');

        return redirect(route('admin.news.index'));
    }

    public function getImages($content, $id_new){
        $dom = new \DOMDocument();
        $dom->loadHTML($content);

        $images = $dom->getElementsByTagName( "img" );

        $images_send = [];

        foreach($images as $image){
            $images_send[] = [
                'img_url' => $image->getAttribute('src'),
                'new_id' => $id_new,
            ];
        }
        return $images_send;
    }

}
