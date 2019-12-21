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

    public function update(UpdateRequest $request, $id)
    {
        $params = $request->all();
        if (empty($params['password'])) {
            unset($params['password']);
        }
        $this->userService->update($id, $params);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Данные успешно сохранены!');

        return back();
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Пользователь удален!');

        return back();
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('search');
        $users = $this->userService->search($search)->limit(30)->get();

        return UserResource::collection($users);
    }

}
