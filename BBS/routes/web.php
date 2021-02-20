<?php

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

Route::get('/', function () {
    return view('welcome');
    //return View::make('welcome');
});

//라우팅 기능(추가)
Route::get('test', function(){
    return "Hi~ everyone!!";
});

Route::get('hello', function(){
    return "<h1>Hello Everyone?</h1>";
});

Route::get('hi', function(){
    return view('hi')->with('name','scpark');
});

Route::get('hello', function(){
    return view('hello');
});

Route::get('order', function(){
    return view('shop.order');
});

//Route::get('bbs', function(){
//    return view('bbs.board');
//});
Route::get('bbs', 'BBSController@index');

// Route::get('views', function(){
//     return view('bbs.view');
// });
Route::get('view', 'BBSController@show');

// Route::get('modify_form', function(){
//     return view('bbs.modify_form');
// });

// Route::post('modify', function(){
//     return view('bbs.modify');
// });
Route::get('modify', 'BBSController@edit');//modify_form
Route::post('modify', 'BBSController@update');

// Route::post('delete', function(){
//     return view('bbs.delete');
// });
Route::post('delete', 'BBSController@destroy');

//Route::get('write', function(){
//    return view('bbs.write_form');
//});
Route::get('write', 'BBSController@create');//write_form
Route::post('write','BBSController@store');

Route::get('template', function(){
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
