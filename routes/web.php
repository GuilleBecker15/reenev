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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index'); //Por si Laravel lo sigue usando internamente

Route::post('/Cursos/buscar', 'CursoController@buscar');
Route::post('/Docentes/buscar', 'DocenteController@buscar');
Route::post('/Encuestas/buscar', 'EncuestaController@buscar');
Route::post('/Users/buscar', 'UserController@buscar');

Route::post('/hacerAdmin/{id}', 'UserController@hacerAdmin');
Route::post('/recuperar/{id}', 'UserController@recuperar');

Route::resource('Cursos', 'CursoController');
Route::resource('Docentes', 'DocenteController');
Route::resource('Encuestas', 'EncuestaController');
Route::resource('Realizadas', 'RealizadaController');
Route::resource('Users', 'UserController');

// Route::get('cambiar' ,['as'=> 'cambiar', 'uses' => 'HomeController@cambiar'] );
/*Route::get('cambiar/{user}' ,['as' => 'cambiar', function(){
	return view('user.cambiarPass'*/
Route::get('cambiarPass/{user}' ,[ 'uses' => 'UserController@redirectCambiarPass' , 'as' => 'cambiarPass'] );
Route::put('updatePass/{user}', [ 'uses' => 'UserController@updatePass', 'as' => 'updatePass']);

// Route::get('/{any}', function($any){ return view('404'); })->where('any', '.*');

Route::post('/updateByAjax/{id}', [ 'uses' => 'UserController@updateByAjax', 'as' => 'Users.updateByAjax']);

// ['as' => 'my-profile', 'uses' => 'ProfileController@myProfile']