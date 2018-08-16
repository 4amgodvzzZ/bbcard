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
    return redirect ('/sale');
});

Route::get('/login', function () {
    return view('auth.login');
});


Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/loginin', 'Auth\LoginController@loginin');
Route::post('/registerin', 'Auth\LoginController@registerin');
Route::get('/outlogin', 'Auth\LoginController@outloginin');

//Login检测拦截器！！！！！！！！！！！！！！！！
Route::group(['middleware'=>['web','MidLoginCheck']], function() {

    //我要供货路由
    Route::get('/sale/{type?}', 'sale\SaleController@index');
    Route::post('/sale/getdenom/{cardtypeid?}', 'sale\SaleController@getdenom');
    Route::post('/sale/savecard', 'sale\SaleController@savecard');


    //账号信息
    Route::get('/account', 'account\AccountController@index');
    Route::get('/accountset', 'account\AccountController@accountset');

    //交易记录
    Route::any('/record/{type?}', 'record\RecordController@index');
});