<?php

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

Route::get('/ejemplos', function () {
    return view('/layouts.ejemplos'); 
});




/*
Route::post('/nuevaRefaccion', "piezasRefaccionController@store");
Route::get('/editarRegistro/{id}', "piezasRefaccionController@edit");
*/

