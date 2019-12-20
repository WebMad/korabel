<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = $this->userService->find(Auth::user()->id);

        return ($user->isAdmin()) ? $next($request) : response()->redirectTo(route('landing'));
    }
}
