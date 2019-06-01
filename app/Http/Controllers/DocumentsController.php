<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Documents;

class DocumentsController extends Controller
{
    public function create(){
        return view('admin.documents.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'file' => 'required',
        ]);
        $file = $request->file('file');

        $destinationPath = 'uploads/documents';
        $fileName = time();
        $filePath = $destinationPath.'/'.$fileName. '.' .$file->getClientOriginalExtension();
        $file->move($destinationPath,$filePath);

        Documents::create(['name' => $request->input('name'), 'file' => $filePath]);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Документ добавлен!');

        return redirect(route('admin.documents.index'));
    }

    public function edit($id){
        return view('admin.documents.edit', ['document' => Documents::findOrFail($id)]);
    }
    public function update(Request $request, $id){

        $fileDB = Documents::findOrFail($id);
        $request->validate([
            'name' => 'required',
        ]);

        $data = [
            'name'=>$request->input('name'),
            'type'=>$request->input('type')
        ];
        if(!empty($request->file('file'))){

            $filePath = app_path($fileDB);;
            if(File::exists($filePath)) {
                File::delete($filePath);
            }
            $file = $request->file('file');

            $destinationPath = 'uploads/documents';
            $fileName = time();
            $filePath = $destinationPath.'/'.$fileName. '.' .$file->getClientOriginalExtension();
            $file->move($destinationPath,$filePath);

            $data['file'] = $filePath;
        }

        $fileDB->fill($data)->save();

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Данные успешно сохранены!');

        return redirect(route('admin.documents.index'));
    }

    public function delete($id){
        $fileDB = Documents::findOrFail($id);
        $filePath = public_path($fileDB['file']);
        if(File::exists($filePath)) {
            File::delete($filePath);
        }
        $fileDB->destroy($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Документ удален!');

        return redirect(route('admin.documents.index'));
    }
}
