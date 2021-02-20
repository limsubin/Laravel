<?php

use Illuminate\Http\Request;

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

//Laravel에 API 경로임을 알려주므로 
//Laravel은 '/api' URL에 경로 앞에 접두사를 추가하여 웹 경로와 구별합니다.
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('/products', 'ProductController@index');
Route::post('/upload-file', 'ProductController@uploadFile');
Route::get('/products/{product}', 'ProductController@show');

//auth:api라고 미들웨어에 추가하면 해당 그룹의 라우트에 대한 모든 호출 인증해야한다
Route::group(['middleware' => 'auth:api'], function(){
	Route::get('/users','UserController@index');
    Route::get('users/{user}','UserController@show');
    Route::patch('users/{user}','UserController@update');
    Route::get('users/{user}/orders','UserController@showOrders');
    Route::patch('products/{product}/units/add','ProductController@updateUnits');
    Route::patch('orders/{order}/deliver','OrderController@deliverOrder');
    Route::resource('/orders', 'OrderController');
    Route::resource('/products', 'ProductController')->except(['index','show']);
});
