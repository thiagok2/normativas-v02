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


Auth::routes();

Route::get('/admin/convites', 'Admin\\ConviteController@index')->name('convites');

Route::get('/admin/unidades', 'Admin\\UnidadeController@index')->name('unidades');
Route::post('/admin/unidades', 'Admin\\UnidadeController@store')->name('unidade-store');

Route::get('/admin/unidades/{id}/edit', 'Admin\\UnidadeController@edit')->name('unidade-edit');

Route::get('/admin/tiposdocumento', 'Admin\\TipoDocumentoController@index')->name('tiposdocumento');
Route::get('/admin/assuntos', 'Admin\\AssuntoController@index')->name('Assuntos');
Route::get('/admin/documentos', 'Admin\\DocumentoController@index')->name('documentos');

Route::get('/admin/documentos/publicar', 'Admin\\DocumentoController@create')->name('publicar');
Route::post('/admin/documentos/publicar', 'Admin\\DocumentoController@store')->name('enviar');

Route::get('/admin/documento/{id}', 'Admin\\DocumentoController@show')->name('documento');
Route::delete('/admin/documentos/{id}', 'Admin\\DocumentoController@destroy')->name('delete');


Route::get('/admin/usuarios/{id}/editar', 'Admin\\UsuarioController@edit')->name('usuario-edit');
Route::get('/admin/usuarios', 'Admin\\UsuarioController@index')->name('usuarios');
Route::get('/admin/usuarios/convidar', 'Admin\\UsuarioController@convidar')->name('usuario-convidar');
Route::get('/admin/usuarios/reenviar-convite/{id}', 'Admin\\UsuarioController@reenviarConvite')->name('usuario-reconvidar');

Route::post('/admin/usuarios', 'Admin\\UsuarioController@store')->name('usuario-store');
Route::post('/admin/usuarios/create', 'Admin\\UsuarioController@create')->name('usuario-create');
Route::get('/admin/usuarios/pesquisar', 'Admin\\UsuarioController@search')->name('usuario-search');
Route::post('/admin/usuarios/pesquisar', 'Admin\\UsuarioController@search')->name('usuario-search');
Route::get('/admin/usuarios/delete/{id}', 'Admin\\UsuarioController@destroy')->name('usuario-delete');

Route::get('/home', 'HomeController@index')->name('home');



