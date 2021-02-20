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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/login', 'ProductsController@login');
//Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@do']);

Route::get('/test', function(){
    return response()->json([
        'user'=>[
            'first_name'=>'Renato',
            'last_name'=>'Hysa'
        ]
    ]);
});

//Route::group(['middleware' => 'auth:api'], function(){
    Route::get('users/{user}/orders','OrderController@showOrders');
    Route::resource('products', 'ProductsController');
    Route::resource('/orders', 'OrderController');
    Route::resource('/carts', 'CartController')->only(['index', 'store', 'destroy']);
    Route::get('/test', 'testController@index');

  
//});
//Route::get('products/chartsData', 'ProductsController@chartsData');

Route::get('/day', 'DateController@day');
Route::get('/week', 'DateController@week');
Route::get('/month', 'DateController@month');
Route::get('/year', 'DateController@year');
Route::get('/recommend/{commend}', 'DateController@recommend');
Route::resource('customcard','CustomCardController');
Route::get('/woman', 'DateController@woman');
Route::get('/man', 'DateController@man');