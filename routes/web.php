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


Route::get('/', 'IndexController@index')->name('index');

Route::get('/unidades', 'Admin\UnidadeController@search')->name('unidades-search');
Route::get('/unidades/public/{id}', 'Admin\UnidadeController@page')->name('unidades-page');

Route::get('/login', 'LoginController@login');

//Route::get('home', 'IndexController@index');

Route::match('get', '/normativa/pdf/{normativaId}', [
    'uses' => 'PDFController@pdfNormativa',
    'as' => 'pdfNormativa',
]);

Route::match('get', '/normativa/view/{normativaId}', [
    'uses' => 'IndexController@viewNormativa',
    'as' => 'viewNormativa',
]);

Route::match('get', '/filter', [
    'uses' => 'IndexController@filter',
    'as' => 'filterNormativa',
]);

Route::get('documento/delete/{arquivoId}', 'IndexController@delete')->name('delete-elastic');

Route::get('errors/500', function () {
    return view('errors/500');
});

Route::get('errors/404', function () {
    return view('errors/404');
});

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function(){

    Route::get('getenv', 'EnvController@getenv')->name('getenv');

    


    Route::get('home', 'HomeController@index')->name('home');

    Route::get('convites', 'ConviteController@index')->name('convites');

    Route::get('unidades', 'UnidadeController@index')->name('unidades');
    Route::post('unidades', 'UnidadeController@store')->name('unidade-store');
    
    Route::get('unidades/{id}/edit', 'UnidadeController@edit')->name('unidade-edit');
    Route::get('unidades/{id}/show', 'UnidadeController@show')->name('unidade-show');
    
    Route::get('tiposdocumento', 'TipoDocumentoController@index')->name('tiposdocumento');
    
    
    Route::get('assuntos', 'AssuntoController@index')->name('Assuntos');
    Route::get('assuntos/novo', 'AssuntoController@create')->name('assuntos-create');
    Route::post('assuntos/salvar', 'AssuntoController@store')->name('assunto-store');
    Route::get('assuntos/editar/{id}', 'AssuntoController@edit')->name('assunto-edit');
    Route::get('assuntos/delete/{id}', 'AssuntoController@destroy')->name('assunto-delete');
    Route::get('assuntos/removidos', 'AssuntoController@trashed')->name('assunto-removidos');
    Route::get('assuntos/restaurar/{id}', 'AssuntoController@restore')->name('assunto-restore');


    Route::get('tiposdocumento/novo', 'TipoDocumentoController@create')->name('tiposdocumento-create');
    Route::post('tiposdocumento/salvar', 'TipoDocumentoController@store')->name('tiposdocumento-store');
    Route::get('tiposdocumento/editar/{id}', 'TipoDocumentoController@edit')->name('tiposdocumento-edit');
    Route::get('tiposdocumento/delete/{id}', 'TipoDocumentoController@destroy')->name('tiposdocumento-delete');
    Route::get('tiposdocumento/removidos', 'TipoDocumentoController@trashed')->name('tiposdocumento-removidos');
    Route::get('tiposdocumento/restaurar/{id}', 'TipoDocumentoController@restore')->name('tiposdocumento-restore');

    
    
    Route::get('documentos', 'DocumentoController@search')->name('documentos');
    Route::get('documentos/pesquisar', 'DocumentoController@search')->name('documentos-pesquisar');
    
    Route::get('documentos/publicar', 'DocumentoController@create')->name('publicar');
    Route::post('documentos/publicar', 'DocumentoController@store')->name('enviar');

    Route::get('documentos/publicar-lote', 'LoteController@create')->name('publicar-lote');
    Route::post('documentos/publicar-lote', 'LoteController@store')->name('enviar-lote');
    Route::post('documentos/upload-lote', 'LoteController@upload')->name('upload-lote');
    Route::post('documentos/update-item-lote/{id}', 'LoteController@updateItemLote')->name('update-item-lote');

    Route::get('documentos/pendentes', 'LoteController@documentosPendentes')->name('docs-pendentes');
    
    Route::get('documento/{id}', 'DocumentoController@show')->name('documento');
    Route::get('documento/{id}/edit', 'DocumentoController@edit')->name('documento-edit');
    Route::post('documento/{id}/update', 'DocumentoController@update')->name('documento-update');
    Route::delete('documentos/{id}', 'DocumentoController@destroy')->name('delete');
    Route::get('documentos/{id}/delete', 'DocumentoController@destroy')->name('delete-edit');
    Route::get('lote/upload/{id}/delete', 'LoteController@destroy')->name('delete-upload');
    
    
    Route::get('usuarios/{id}/editar', 'UsuarioController@edit')->name('usuario-edit');
    Route::get('usuarios', 'UsuarioController@index')->name('usuarios');
    Route::get('usuarios/convidar', 'UsuarioController@convidar')->name('usuario-convidar');
    Route::get('usuarios/reenviar-convite/{id}', 'UsuarioController@reenviarConvite')->name('usuario-reconvidar');
    
    Route::post('usuarios', 'UsuarioController@store')->name('usuario-store');
    Route::post('usuarios/create', 'UsuarioController@create')->name('usuario-create');
    Route::get('usuarios/pesquisar', 'UsuarioController@search')->name('usuario-search');
    Route::post('usuarios/pesquisar', 'UsuarioController@search')->name('usuario-search');
    Route::get('usuarios/delete/{id}', 'UsuarioController@destroy')->name('usuario-delete');

    Route::get('etl/comandos', 'ETLController@index')->name('etl-comandos');    
    Route::get('etl/log/download/{logFile}', 'ETLController@downloadLog')->name('download-log');
    Route::get('etl/executar/{script}', 'ETLController@executarEtl')->name('etl-executar');

    Route::get('status/index', 'StatusController@index')->name('server-status');

});


Auth::routes();






