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

Route::get('/gc', function () {
	return view('google_chart');
});

Route::get('/home', 'HomeController@index'); //Por si Laravel lo sigue usando internamente
Route::get('/back', ['uses' => 'HomeController@back', 'as' => 'back']);

Route::post('/Cursos/buscar', 'CursoController@buscar');
Route::post('/Docentes/buscar', 'DocenteController@buscar');
Route::post('/Encuestas/buscar', 'EncuestaController@buscar');
Route::post('/Users/buscar', 'UserController@buscar');

Route::post('/hacerAdmin/{id}', 'UserController@hacerAdmin');
Route::post('/Realizadas/continuar', 'RealizadaController@continuar');

Route::get('/Realizadas/{Encuesta}/show', [ 'uses' => 'RealizadaController@verpormateria', 'as' => 'Realizada.show.materia']);
Route::get('/Realizadas/{Encuesta}/quienes', [ 'uses' => 'RealizadaController@quienes', 'as' => 'Realizada.quienes']);
Route::post('/Realizadas/rehacer',['uses'=>'RealizadaController@rehacer','as'=>'Realizada.rehacer']);
Route::get('/Realizadas/todos',['uses'=>'RealizadaController@todos','as'=>'Realizada.todos']);
// CAMBIAR LAS RUTAS PARA QUE AL BUSCAR NO DE ERROR:

Route::get('/Users/borrados/{si_o_no}', 'UserController@borrados');
Route::get('/Users/completadas/{id}', 'UserController@realizadas');
Route::get('/Cursos/docente/{id}', 'CursoController@docente');
Route::get('/Docentes/graficas/{id_docente}', 'DocenteController@graficas');
Route::get('/Docentes/exportar/{id_docente}/{id_encuesta}/{id_curso}', 'DocenteController@exportar');

Route::resource('Cursos', 'CursoController');
Route::resource('Docentes', 'DocenteController');
Route::resource('Encuestas', 'EncuestaController');
Route::resource('Realizadas', 'RealizadaController');
Route::resource('Users', 'UserController');
Route::resource('Encuestas.Preguntas','PreguntaController');

// Route::get('cambiar' ,['as'=> 'cambiar', 'uses' => 'HomeController@cambiar'] );
/*Route::get('cambiar/{user}' ,['as' => 'cambiar', function(){
	return view('user.cambiarPass'*/
Route::get('cambiarPass/{user}' ,[ 'uses' => 'UserController@redirectCambiarPass' , 'as' => 'cambiarPass'] );
Route::put('updatePass/{user}', [ 'uses' => 'UserController@updatePass', 'as' => 'updatePass']);

// Route::get('/{any}', function($any){ return view('404'); })->where('any', '.*');

Route::post('/updateByAjax/{id}', [ 'uses' => 'UserController@updateByAjax', 'as' => 'Users.updateByAjax']);

// ['as' => 'my-profile', 'uses' => 'ProfileController@myProfile']
Route::delete('/Cursos/{Curso}/Docentes', [ 'uses' => 'CursoController@borrardocente', 'as' => 'Cursos.Docente.destroy']);
Route::put('/Cursos/{Curso}/Docentes', [ 'uses' => 'CursoController@actualizardocente', 'as' => 'Cursos.Docente.update']);
Route::get('/Cursos/{Curso}/Docentes/edit', [ 'uses' => 'CursoController@editdocente', 'as' => 'Cursos.Docente.edit']);

Route::put('/Users/{User}/Recuperar', ['uses' => 'UserController@recuperar', 'as' => 'Users.recuperar']);


Route::get('/sendemail', 'MailController@sendemail');