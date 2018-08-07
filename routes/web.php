<?php
use App\Events\TaskEvent;
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

Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');

Route::get('/test','AdminsController@test');
Route::get('/test/{year}/{month}','AdminsController@selectData');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/table','ChartsController@table');
Route::get('/list','ChartsController@list_data');

Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']],function(){
//MemberRoute
Route::resource('member', 'MembersController');
//chartRoute
Route::get('/chart',['as'=> 'chart.index','uses'=>'ChartsController@chart']);
Route::get('/chart/create','ChartsController@create');
Route::get('/chart/store','ChartsController@store');
Route::get('/chart/edit/{id}','ChartsController@edit');
Route::get('/chart/update/{id}','ChartsController@update');
Route::get('/chart/delete/{id}','ChartsController@hapus');
//AjaxCRUD
Route::get('my-posts','PostsController@mypost');
Route::resource('posts','PostsController');
//Penjualan
Route::resource('penjualan','PenjualansController');
Route::get('penjualan/{year}/{month}','PenjualansController@chart');
 
Route::get('penjualandatatable','PenjualansController@penjualandatatable');
Route::get('penjualanlist','PenjualansController@penjualanlist');
Route::get('penjualandatatable/{year}/{month}','PenjualansController@selectData');
});
//Alternative ng rock 
//datatables bootstrap 4
Route::get('testchart','PenjualansController@testchart');

//Sample Pusher
Route::get('/pusher', function() {
    event(new App\Events\TaskEvent('Hi there Pusher!'));
    return "Event has been sent!";
});
Route::get('/pusher-data', function() {
    return view('listen');
});