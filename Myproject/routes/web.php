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
    return view('bbs.welcome');
});

Route::get('bbs', 'BBSController@index');//mainlayout

Route::get('view', 'BBSController@show');//view

Route::get('board', 'BBSController@list');//board
Route::post('board', 'BBSController@list');//board

Route::post('delete', 'BBSController@destroy');//delete

Route::get('write','BBSController@create');
Route::post('write','BBSController@store');

Route::get('update','BBSController@edit');
Route::post('update','BBSController@update');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('alert/{AlertType}','BBSController@alert')->name('alert');
Route::get('tag', 'BBSController@tagCategory');

Route::get('hospital', function(){
    return view('bbs.hospital');
});

Route::post('search', 'BBSController@search');
Route::get('myAricles', 'BBSController@myAricles');
//Route::any('/search', 'BBSController@search');

//Route::get('/register', 'RegistrationController@create');
//Route::post('/registers', 'RegistrationController@store');

