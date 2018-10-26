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

Route::get('/admin/convites', 'Admin\\ConviteController@index')->name('convites');
Route::get('/admin/unidades', 'Admin\\UnidadeController@index')->name('unidades');
Route::get('/admin/tiposdocumento', 'Admin\\TipoDocumentoController@index')->name('tiposdocumento');
Route::get('/admin/assuntos', 'Admin\\AssuntoController@index')->name('Assuntos');
Route::get('/admin/documentos', 'Admin\\DocumentoController@index')->name('documentos');

Route::get('/home', 'HomeController@index')->name('home');



