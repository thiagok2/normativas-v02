<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('documentos/assuntos/total', 'API\DocumentoRestController@documentosPorAssunto');
Route::get('documentos/tipos/total', 'API\DocumentoRestController@documentosPorTipo');
Route::get('documentos/enviados/6meses', 'API\DocumentoRestController@evolucaoEnviados6Meses');
Route::get('documentos/enviados/periodo', 'API\DocumentoRestController@evolucaoEnviadosPeriodo');

Route::get('unidades/confirmadas/periodo', 'API\UnidadeRestController@evolucaoUnidadesConfirmadasPeriodo');
Route::get('unidades/confirmadas/6meses', 'API\UnidadeRestController@evolucaoUnidadesConfirmadas6Meses');
//Route::resource('usuarios', 'API\\UserRestController');

Route::get('unidades', 'API\UnidadeRestController@get');
