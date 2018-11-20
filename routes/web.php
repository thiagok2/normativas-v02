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

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function(){
    Route::get('convites', 'ConviteController@index')->name('convites');

    Route::get('unidades', 'UnidadeController@index')->name('unidades');
    Route::post('unidades', 'UnidadeController@store')->name('unidade-store');
    
    Route::get('unidades/{id}/edit', 'UnidadeController@edit')->name('unidade-edit');
    
    Route::get('tiposdocumento', 'TipoDocumentoController@index')->name('tiposdocumento');
    Route::get('assuntos', 'AssuntoController@index')->name('Assuntos');
    Route::get('documentos', 'DocumentoController@index')->name('documentos');
    
    Route::get('documentos/publicar', 'DocumentoController@create')->name('publicar');
    Route::post('documentos/publicar', 'DocumentoController@store')->name('enviar');
    
    Route::get('documento/{id}', 'DocumentoController@show')->name('documento');
    Route::delete('documentos/{id}', 'DocumentoController@destroy')->name('delete');
    
    
    Route::get('usuarios/{id}/editar', 'UsuarioController@edit')->name('usuario-edit');
    Route::get('usuarios', 'UsuarioController@index')->name('usuarios');
    Route::get('usuarios/convidar', 'UsuarioController@convidar')->name('usuario-convidar');
    Route::get('usuarios/reenviar-convite/{id}', 'UsuarioController@reenviarConvite')->name('usuario-reconvidar');
    
    Route::post('usuarios', 'UsuarioController@store')->name('usuario-store');
    Route::post('usuarios/create', 'UsuarioController@create')->name('usuario-create');
    Route::get('usuarios/pesquisar', 'UsuarioController@search')->name('usuario-search');
    Route::post('usuarios/pesquisar', 'UsuarioController@search')->name('usuario-search');
    Route::get('usuarios/delete/{id}', 'UsuarioController@destroy')->name('usuario-delete');
});


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');



