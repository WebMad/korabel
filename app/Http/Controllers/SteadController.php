<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stead\StoreRequest;
use App\Http\Requests\Stead\UpdateRequest;
use App\Services\SteadService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SteadController extends Controller
{

    private $steadService;
    private $userService;

    /**
     * SteadController constructor.
     * @param SteadService $steadService
     * @param UserService $userService
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

        if (!empty($request->input('search'))) {
            $steads = $this->steadService->search($request->input('search'), ['user']);
        } else {
            $steads = $this->steadService->all(['user']);
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
    public function store(StoreRequest $request)
    {
        $this->steadService->create($request->all());

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
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {

        $this->steadService->update($id, $request->all());

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Участок изменен!');

        return back();
    }

    /**
     * Delete stead
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->steadService->delete($id);

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
