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
Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
Route::resource('admins', 'AdminsController');
});
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');

Route::get('/test','AdminsController@test');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chart','ChartsController@chart');