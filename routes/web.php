<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingController@index')->name('landing');
Route::get('/contacts', 'LandingController@contacts')->name('contacts');
Route::get('/documents', 'LandingController@documents')->name('documents');

Route::get('/policy', function () {
    return view('policy');
})->name('policy');

Auth::routes(['register' => true]);

//News routes
Route::get('/news/{id?}', 'LandingController@news')->name('news')->where('id', '[0-9]+');

//Users routes
Route::group(['middleware' => 'auth', 'prefix' => 'cabinet', 'as' => 'cabinet.'], function () {
    Route::get('/', 'LandingController@cabinet')->name('index');
    Route::post('/user/update/{id}', 'UserController@update')->name('user.update');
});

//Admin routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', 'SiteInfoController@index')->name('index');
    Route::post('/', 'SiteInfoController@update')->name('update');

    Route::resource('news', 'NewsController')->except('show');
    //News admin routes
    Route::group(['prefix' => 'admin', 'as' => 'news.'], function () {

    });

    //Documents admin routes
    Route::resource('documents', 'DocumentsController')->except('show');

    //Users admin routes
    Route::resource('users', 'UserController')->except('show');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        //Search user
        Route::get('search', 'UserController@searchUser')->name('search');
    });

    //Steads admin routes

    Route::resource('steads', 'SteadController')->except('show');
    Route::group(['prefix' => 'steads', 'as' => 'steads.'], function () {

        //Search stead
        Route::get('search', 'SteadController@searchStead')->name('search');

    });


    //Receipts admin routes
    Route::resource('receipts', 'ReceiptController')->except('show');
    Route::group(['prefix' => 'receipts', 'as' => 'receipts.'], function () {
        Route::get('/multiple-create', 'ReceiptController@multipleCreate')->name('multiple_create');
        Route::post('/multiple-store', 'ReceiptController@multipleStore')->name('multiple_store');
    });

    Route::post('upload-image', 'NewsController@uploadImage')->name('upload_image');
});


Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');
