<?php

namespace App\Http\Controllers;

use App\Services\SteadService;
use App\Services\UserService;
use App\Stead;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SteadController extends Controller
{

    private $steadService;
    private $userService;

    /**
     * SteadController constructor.
     * @param SteadService $steadService
     */
    public function __construct(SteadService $steadService, UserService $userService)
    {
        $this->steadService = $steadService;
        $this->userService = $userService;
    }

    /**
     * View all steads
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $steads = $this->steadService->all(['user']);

        if ($request->input('search')) {
            $steads->where('steads.number', 'LIKE', '%' . $request->input('search') . '%');
        }

        return view('admin.steads.view', [
            'steads' => $steads->paginate(30),
        ]);
    }

    /**
     * Create new stead
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('admin.steads.create');
    }

    /**
     * Save new stead
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
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
    public function edit($id)
    {
        $stead = $this->steadService->find($id, ['user']);

        return view('admin.steads.edit', [
            'stead' => $stead,
        ]);
    }

    /**
     * Update stead
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $stead = $this->steadService->find($id);

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
    public function delete($id)
    {
        Stead::destroy($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Участок удален!');

        return back();
    }

    public function searchStead(Request $request)
    {
        $number = $request->get('search');
        return response()->json($this->steadService->all(['user'])->limit(30)->where('number', 'LIKE', "%$number%")->get());
    }
}
