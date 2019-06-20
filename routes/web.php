<?php

use App\Http\Middleware\CheckRights;
use App\News;

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

Route::get('/policy', function(){
    return view('policy');
})->name('policy');

Auth::routes(['register' => true]);

//News routes
Route::get('/news/{id?}', 'NewsController@index')->name('news')->where('id', '[0-9]+');

//Users routes
Route::group(['middleware' => 'auth', 'prefix' => 'cabinet', 'as' => 'cabinet.'], function(){
    Route::get('/', 'LandingController@cabinet')->name('index');
    Route::post('/user/update', 'UserController@update')->name('user.update');
});

//Admin routes
Route::group(['middleware' => 'can:admin-panel','prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('/', 'InfoController@index')->name('index');
    Route::post('/', 'InfoController@update')->name('update');

    //News admin routes
    Route::group(['prefix' => 'news', 'as' => 'news.'], function(){
        Route::get('/', 'AdminController@news')->name('index');

        Route::get('/create', 'NewsController@create')->name('create');
        Route::post('/store', 'NewsController@store')->name('store');

        Route::get('/edit/{id}', 'NewsController@edit')->name('edit');
        Route::post('/update/{id}', 'NewsController@update')->name('update');

        Route::get('/delete/{id}', 'NewsController@delete')->name('delete');
    });

    //Documents admin routes
    Route::group(['prefix' => 'documents', 'as' => 'documents.'], function(){
        Route::get('/', 'AdminController@documents')->name('index');

        Route::get('/create', 'DocumentsController@create')->name('create');
        Route::post('/store', 'DocumentsController@store')->name('store');

        Route::get('/edit/{id}', 'DocumentsController@edit')->name('edit');
        Route::post('/update/{id}', 'DocumentsController@update')->name('update');

        Route::get('/delete/{id}', 'DocumentsController@delete')->name('delete');
    });

    //Users admin routes
    Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
        Route::get('/', 'AdminController@users')->name('index');

        Route::get('/create', 'UserController@create')->name('create');
        Route::post('/store', 'UserController@store')->name('store');

        Route::get('/edit/{id}', 'UserController@edit')->name('edit');
        Route::post('/update/{id}', 'UserController@update')->name('update');

        Route::get('/delete/{id}', 'UserController@delete')->name('delete');

        //Search user
        Route::get('/search/{search?}', 'UserController@searchUser')->name('search');
    });

    //Steads admin routes
    Route::group(['prefix' => 'steads', 'as' => 'steads.'], function(){
        Route::get('/', 'SteadController@index')->name('index');

        Route::get('/create', 'SteadController@create')->name('create');
        Route::post('/store', 'SteadController@store')->name('store');

        Route::get('/edit/{id}', 'SteadController@edit')->name('edit');
        Route::post('/update/{id}', 'SteadController@update')->name('update');

        Route::get('/delete/{id}', 'SteadController@delete')->name('delete');

        //Search stead
        Route::get('/search/{search?}', 'SteadController@searchStead')->name('search');

    });

    //Receipts admin routes
    Route::group(['prefix' => 'receipts', 'as' => 'receipts.'], function(){
        Route::get('/', 'ReceiptController@index')->name('index');

        Route::get('/create', 'ReceiptController@create')->name('create');
        Route::post('/store', 'ReceiptController@store')->name('store');

        Route::get('/multiple-create', 'ReceiptController@multipleCreate')->name('multiple_create');
        Route::post('/multiple-store', 'ReceiptController@multipleStore')->name('multiple_store');

        Route::get('/edit/{id}', 'ReceiptController@edit')->name('edit');
        Route::post('/update/{id}', 'ReceiptController@update')->name('update');

        Route::get('/delete/{id}', 'ReceiptController@delete')->name('delete');

        //Search Receipt
        //Route::get('/search/{search}', 'ReceiptController@searchStead')->name('search');

    });
    Route::post('upload-image', 'AdminController@uploadImage');
});


Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');
