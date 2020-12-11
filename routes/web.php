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

Route::get('/crearNuevoAlmacen', 'AlmacenController@create');
Route::post('/crearNuevoAlmacen', 'AlmacenController@store');

Route::get('/misAlmacenes/{idUsuario}', 'AlmacenController@index');
Route::get('/almacen/{id}', 'AlmacenController@show');

Route::get('/verAlmacenes', function () {
    return view('/verAlmacenes'); 
});

/*
Route::post('/nuevaRefaccion', "piezasRefaccionController@store");
Route::get('/editarRegistro/{id}', "piezasRefaccionController@edit");
*/

