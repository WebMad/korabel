<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\User;
use App\UsersRole;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($request->get('search')) {
            $users = $this->userService->search($request->get('search'))->paginate(30);
        } else {
            $users = User::paginate(30);
        }

        return view('admin.users.view', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreRequest $request)
    {

        $this->userService->create($request->all());

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Пользователь добавлен!');

        return back();
    }

    public function edit($id)
    {
        $user = $this->userService->find($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(UpdateRequest $request, $id, User $user)
    {
        /** @var User $user */
        $user = $this->userService->find($id);

        if ($request->get('is_admin')) {
            $user->roles()->attach(Role::ADMIN);
        } else {
            $user->roles()->detach(Role::ADMIN);
        }

        $fields = $request->except('is_admin');

        if (!empty($request->input('password'))) {
            $fields['password'] = $request->input('password');
            $fields['password_confirmation'] = $request->input('password_confirmation');
            Validator::make($fields, [
                'password' => 'max:255|confirmed',
            ])->validate();
            $fields['password'] = Hash::make($fields['password']);
            unset($fields['password_confirmation']);
        }
        if ($request->input('email') != User::find($id)->email) {
            $fields['email'] = $request->input('email');
            Validator::make($fields, [
                'email' => 'required|unique:users|max:255',
            ])->validate();
        }
        Validator::make($fields, [
            'phone' => 'max:255',
            'name' => 'required|max:255',
            'surname' => 'max:255',
            'patronymic' => 'max:255',
        ])->validate();

        $user->fill($fields)->save();

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Данные успешно сохранены!');

        return back();
    }

    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Пользователь удален!');

        return back();
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('search');
        $users = User::search($search)->limit(30)->get();

        return UserResource::collection($users);
    }

}
