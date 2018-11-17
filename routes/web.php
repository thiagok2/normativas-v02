<?php

use Illuminate\Support\Facades\Redirect;

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
    return redirect('login');
});


Route::get('/test', 'Admin\\DocumentoController@test')->name('test');


Auth::routes();

Route::get('/admin/convites', 'Admin\\ConviteController@index')->name('convites');

Route::get('/admin/unidades', 'Admin\\UnidadeController@index')->name('unidades');
Route::post('/admin/unidades', 'Admin\\UnidadeController@store')->name('unidade-store');

Route::get('/admin/unidades/{id}/edit', 'Admin\\UnidadeController@edit')->name('unidade-edit');

Route::get('/admin/tiposdocumento', 'Admin\\TipoDocumentoController@index')->name('tiposdocumento');
Route::get('/admin/assuntos', 'Admin\\AssuntoController@index')->name('Assuntos');
Route::get('/documentos', 'Admin\\DocumentoController@index')->name('documentos');

Route::get('/documentos/publicar', 'Admin\\DocumentoController@create')->name('publicar');
Route::post('/documentos/publicar', 'Admin\\DocumentoController@store')->name('enviar');

Route::get('/documento/{id}', 'Admin\\DocumentoController@show')->name('documento');
Route::delete('/documentos/{id}', 'Admin\\DocumentoController@destroy')->name('delete');


Route::get('/admin/usuarios/{id}/editar', 'Admin\\UsuarioController@edit')->name('usuario-edit');
Route::get('/admin/usuarios', 'Admin\\UsuarioController@index')->name('usuarios');
Route::post('admin/usuarios', 'Admin\\UsuarioController@store')->name('usuario-store');

Route::get('/home', 'HomeController@index')->name('home');



