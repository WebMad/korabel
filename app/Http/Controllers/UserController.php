<?php

namespace App\Http\Controllers;

//use Dotenv\Validator;
use Illuminate\Http\Request;
use App\User;
use App\UsersRole;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('admin.users.create');
    }
    public function store(Request $request){
        $fields = $request->only('email', 'phone', 'password', 'name', 'surname', 'patronymic', 'active');
        $fields['password_confirmation'] = $request->input('password_confirmation');
        Validator::make($fields, [
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'name' => 'required',
            'surname' => '',
            'patronymic' => '',
            'phone' => '',
        ])->validate();
        $fields['password'] = Hash::make($fields['password']);
        unset($fields['password_confirmation']);
        User::create($fields);
        if($request->input('is_admin')) {
            UsersRole::create([
                'id_user' => User::orderBy('id', 'desc')->first()->value('id'),
                'id_role' => Role::where('name', 'admin-panel')->first()->value('id')
            ]);
            //dd(User::orderBy('id', 'desc')->limit(0, 1)->value('id'));
        }

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Пользователь добавлен!');

        return back();
    }

    public function edit($id){
        $data = User::findOrFail($id);
        $data['is_admin'] = UsersRole::where('id_user', $id)->first() ? true : false;
        return view('admin.users.edit', ['user' => $data]);
    }
    public function update(Request $request, $id = null){
        if($id == null){
            $id =  Auth::user()->id;
        }

        $fields = $request->only('phone', 'name', 'surname', 'patronymic', 'active');
        if(!empty($request->input('password'))){
            $fields['password'] = $request->input('password');
            $fields['password_confirmation'] = $request->input('password_confirmation');
            Validator::make($fields,[
                'password' => 'max:255|confirmed',
            ])->validate();
            $fields['password'] = Hash::make($fields['password']);
            unset($fields['password_confirmation']);
        }
        if($request->input('email') != User::find($id)->email){
            $fields['email'] = $request->input('email');
            Validator::make($fields,[
                'email' => 'required|unique:users|max:255',
            ])->validate();
        }
        Validator::make($fields, [
            'phone' => 'max:255',
            'name' => 'required|max:255',
            'surname' => 'max:255',
            'patronymic' => 'max:255',
        ])->validate();

        if ($request->input('is_admin')) {
            UsersRole::create([
                'id_user' => $id,
                'id_role' => Role::where('name', 'admin-panel')->first()->value('id')
            ]);
        } else {
            UsersRole::where([
                'id_user' => $id,
                'id_role' => Role::where('name', 'admin-panel')->first()->value('id')
            ])->delete();
        }

        //dd($fields);

        User::find($id)->fill($fields)->save();

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Данные успешно сохранены!');

        return back();
    }

    public function delete($id){
        User::destroy($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Пользователь удален!');

        return back();
    }

    public function searchUser($string = ''){

        $string = explode(' ', $string);

        $select = DB::table('users');

        if(isset($string[0])){
            $select->where('surname', 'LIKE', "%$string[0]%");
        }
        if(isset($string[1])){
            $select->where('name', 'LIKE', "%$string[1]%");
        }
        if(isset($string[2])){
            $select->where('patronymic', 'LIKE', "%$string[2]%");
        }

        return response()->json($select->get());
    }

    public static function hasRole($role){
        $id_role = Role::where('name', '=', $role)->value('id');
        $id_user = Auth::id();
        $value = UsersRole::where('id_user', '=', $id_user)->where('id_role', '=', $id_role)->first();
        return isset($value->id) ? true : false;
    }


}
