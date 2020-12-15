<?php

use App\Http\Controllers\RecetasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/crearNuevoAlmacen', 'AlmacenController@create')->middleware('auth');
Route::post('/crearNuevoAlmacen', 'AlmacenController@store')->middleware('auth');

Route::get('/misAlmacenes/{idUsuario}', 'AlmacenController@index')->middleware('auth');
Route::get('/misAlmacenes/{idUsuario}/{idUsuarioAlmacen}/almacen/{idAlmacen}', 'AlmacenController@show')->middleware('auth');
Route::get('/misAlmacenes/{idUsuario}/{idUsuarioAlmacen}/almacen/{idAlmacen}/invitarUsuario', 'InvitacionesAlmacenController@create')->middleware('auth');
Route::post('/invitarUsuario', 'InvitacionesAlmacenController@store')->middleware('auth');

Route::get('/invitacionesRecibidas/{idUsuario}', 'InvitacionesAlmacenController@indexParaUsuario')->middleware('auth');
Route::post('/invitacionesRecibidas/respuestaInvitacion', 'InvitacionesAlmacenController@update')->middleware('auth');
Route::post('/invitacionesRecibidas/eliminaInvitacion', 'InvitacionesAlmacenController@destroy')->middleware('auth');

Route::post('/eliminaUsuarioDeAlmacen', 'UsuariosAlmacenController@destroy')->middleware('auth');

Route::get('/listaDeRecetas', 'RecetasController@index')->middleware('auth'); //Quizas pueda dejarse público.
Route::get('/listaDeRecetas/verReceta/{idReceta}', 'RecetasController@show')->middleware('auth'); //Quizas pueda dejarse público.

Route::get('/misAlmacenes/{idUsuario}', 'AlmacenController@index')->middleware('auth');

Route::get('/misAlmacenes/{idUsuario}/{idUsuarioAlmacen}/almacen/{idAlmacen}/agregarIngredientes', 'IngredientesAlmacenController@create')->middleware('auth');
Route::post('/crearIngredienteEnAlmacen', 'IngredientesAlmacenController@store')->middleware('auth');
// '/crearIngredienteParaAlmacen'

// Route::get('/ejemplos', function () {
//     return view('/layouts.ejemplos'); 
// });




/*
Route::post('/nuevaRefaccion', "piezasRefaccionController@store");
Route::get('/editarRegistro/{id}', "piezasRefaccionController@edit");
*/


