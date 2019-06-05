<?php

namespace App\Http\Controllers;

use App\Stead;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SteadController extends Controller
{
    /**
     * View all steads
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $steads = DB::table('steads')
            ->select('steads.id', 'steads.number', 'users.name', 'users.surname', 'users.patronymic')
            ->leftJoin('users', 'steads.user_id', '=', 'users.id');

        if($request->input('search')){
            $steads->where('steads.number', 'LIKE', '%'.$request->input('search').'%');
        }

        return view('admin.steads.view', [
            'steads' => $steads->paginate(30),
        ]);
    }

    /**
     * Create new stead
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){

        return view('admin.steads.create', [
            'users' =>
                DB::table('users')
                    ->select('id', 'surname', 'name', 'patronymic')
                    ->get()
        ]);
    }

    /**
     * Save new stead
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $request->validate([
            'number' => 'required',
            'user_id' => '',
        ]);
        Stead::create($request->all());

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Участок добавлен!');

        return back();
    }

    /**
     * Edit stead
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $stead = Stead::findOrFail($id);

        return view('admin.steads.edit', [
            'stead' => $stead,
            'users' => User::all(),
            'user' => User::find($stead->user_id)
        ]);
    }

    /**
     * Update stead
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){
        $stead = Stead::findOrFail($id);

        $request->validate([
            'number' => 'required',
            'user_id' => '',
        ]);

        $stead->fill($request->all())->save();

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Участок изменен!');

        return back();
    }

    /**
     * Delete stead
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        Stead::destroy($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Участок удален!');

        return back();
    }

    public function searchStead($number = ''){
        return response()->json(
            Stead::where('number', 'LIKE', "%$number%")
                ->select('steads.id', 'steads.number', 'users.surname', 'users.name', 'users.patronymic')
                ->join('users', 'users.id', '=', 'steads.user_id')
                ->get()
        );
    }
}
