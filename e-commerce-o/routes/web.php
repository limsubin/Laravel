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

//모든 웹 요청이 Vue 응용 프로그램의 항목이 될 단일 진입 점으로 라우트 됨
Route::get('/{any}', function(){
        return view('landing');
})->where('any', '.*');
