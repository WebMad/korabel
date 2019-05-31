<?php

namespace App\Http\Controllers;

use App\Receipt;
use App\Stead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class ReceiptController extends Controller
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

    public function index(){
        return view('admin.receipts.view', [
            'receipts' => DB::table('receipts')
                ->select('receipts.*', 'steads.number')
                ->leftJoin('steads', 'steads.id', '=', 'receipts.stead_id')
                ->orderBy('receipts.id')
                ->get(),
            'months' => $this->months,
        ]);
    }

    public function create(){
        return view('admin.receipts.create', [
            'steads' => DB::table('steads')
                ->select('steads.id', 'steads.number', 'users.surname', 'users.name', 'users.patronymic')
                ->join('users', 'users.id', '=', 'steads.user_id')
                ->get()
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'date_receipt' => 'required',
            'stead_id' => 'required',
            'receipts' => 'required',
        ]);

        $file = $request->file('receipts');

        $destination_path = 'uploads/receipts';
        $file_name = time();
        $file_path = $destination_path . '/' . $file_name . '.' . $file->getClientOriginalExtension();

        $file->move($destination_path, $file_path);

        $data = $request->only('date_receipt', 'stead_id');

        $data['file'] = $file_path;

        Receipt::create($data);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Квитанция успешно дабвлена!');

        return back();
    }

    public function multipleCreate(Request $request){
        return view('admin.receipts.multiple_create');
    }
    public function multipleStore(Request $request){
        $files = $request->file('receipts');

        $request->validate([
            'date_receipt' => 'required',
            'receipts' => 'required',
        ]);

        $file_name = time();
        $steads_list = [];

        foreach($files as $file){
            $stead = Stead::where('number', mb_substr($file->getClientOriginalName(), 0, -4))->get()->first();
            if(count($stead)>0) {
                //dd($stead);

                $destination_path = 'uploads/receipts';
                $file_name++;
                $file_path = $destination_path . '/' . $file_name . '.' . $file->getClientOriginalExtension();

                $file->move($destination_path, $file_path);

                $receipts[] = [
                    'stead_id' => $stead->id,
                    'date_receipt' => $request->input('date_receipt'),
                    'file' => $file_path,
                ];
            }
            else{
                Session::flash('msg.status', 'danger');
                Session::flash('msg.text', 'Не найдены следующие участки: ');
                $steads_list[] = mb_substr($file->getClientOriginalName(), 0, -4);
            }
        }



        if(isset($steads_list) and count($steads_list)>0) {
            Session::flash('msg.steads', $steads_list);
        }
        else{
            Receipt::insert($receipts);

            Session::flash('msg.status', 'success');
            Session::flash('msg.text', 'Квитанции успешно дабвлены!');

        }

        return back();
    }

    public function edit($id){
        $receipt = Receipt::findOrFail($id);
        return view('admin.receipts.edit', [
            'receipt' => $receipt,
            'stead' => Stead::where('steads.id', $receipt->stead_id)
                ->select('steads.id', 'steads.number', 'users.surname', 'users.name', 'users.patronymic')
                ->join('users', 'users.id', '=', 'steads.user_id')
                ->get()->first(),
            'steads' => DB::table('steads')
                ->select('steads.id', 'steads.number', 'users.surname', 'users.name', 'users.patronymic')
                ->join('users', 'users.id', '=', 'steads.user_id')
                ->get(),
        ]);
    }
    public function update(Request $request, $id){
        $receipt = Receipt::findOrFail($id);

        $request->validate([
            'date_receipt' => 'required',
            'stead_id' => 'required',
        ]);
        $data = $request->only('date_receipt', 'stead_id');

        if($request->file('receipts')) {

            $filePath = public_path($receipt['file']);
            if(File::exists($filePath)) {
                File::delete($filePath);
            }

            $file = $request->file('receipts');
            $destination_path = 'uploads/receipts';
            $file_name = time();
            $file_path = $destination_path . '/' . $file_name . '.' . $file->getClientOriginalExtension();

            $file->move($destination_path, $file_path);

            $data['file'] = $file_path;
        }

        $receipt->fill($data)->save();

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Информация успешно изменена!');

        return back();
    }

    public function delete($id){
        $fileDB = Receipt::findOrFail($id);
        $filePath = public_path($fileDB['file']);
        if(File::exists($filePath)) {
            File::delete($filePath);
        }
        $fileDB->destroy($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Квитанция удалена!');

        return back();
    }
}
