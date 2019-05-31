<?php

use Illuminate\Http\Request;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/searchUser', 'UserController@searchUser');
Route::get('/searchUser/{string}', function($string){
    $string = explode(" ", $string);
    switch(count($string)){
        case '3':
            return User::where('name', 'like', "%$string[2]%")
                ->orWhere('surname', 'like', "%$string[2]%")
                ->orWhere('patronymic', 'like', "%$string[2]%")->get();
        case '2':
            return User::where('name', 'like', "%$string[1]%")
                ->orWhere('surname', 'like', "%$string[1]%")
                ->orWhere('patronymic', 'like', "%$string[1]%")->get();
        case '1':
            return User::where('name', 'like', "%$string[0]%")
                ->orWhere('surname', 'like', "%$string[0]%")
                ->orWhere('patronymic', 'like', "%$string[0]%")->get();
    }

    return User::get();
});
