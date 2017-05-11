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
});

Auth::routes();
/*Route::get('404', function () {
	return view('404');
});*/
Route::resource('Users', 'UserController');
Route::get('/home', 'HomeController@index');
Route::get('/{any}', function($any){ return view('404'); })->where('any', '.*');
