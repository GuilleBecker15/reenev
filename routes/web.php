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

Route::resource('Users', 'UserController');
Route::get('/home', 'HomeController@index');


// Route::get('cambiar' ,['as'=> 'cambiar', 'uses' => 'HomeController@cambiar'] );
/*Route::get('cambiar/{user}' ,['as' => 'cambiar', function(){
	return view('user.cambiarPass'*/
Route::get('cambiarPass/{user}' ,[ 'uses' => 'UserController@redirectCambiarPass' , 'as' => 'cambiarPass'] );
Route::put('updatePass/{user}', [ 'uses' => 'UserController@updatePass', 'as' => 'updatePass']);

Route::get('/{any}', function($any){ return view('404'); })->where('any', '.*');


// ['as' => 'my-profile', 'uses' => 'ProfileController@myProfile']