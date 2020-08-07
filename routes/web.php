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
Route::get('/', 'Auth\LoginController@showLoginForm');
Auth::routes();
Route::get('home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['role:super-admin|moderador|editor']],function(){
    Route::resource('usuarios','UserController');
});
Route::post('login','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');
Route::get('cliente','ClienteController@index' )->name('index');
Route::get('buscarCliente','ClienteController@buscar')->name('buscar');
Route::get('/direcciones.{codCliente}', 'ClienteController@direcciones')->name('direcciones');
Route::post('guardar', 'ClienteController@guardar')->name('guardar');
Route::get('salasAsignadas','ClienteController@salasAsignadas' )->name('salasAsignadas');
Route::get('/subfamilia.{id}', 'ClienteController@subfamilia')->name('subfamilia');
Route::get('/producto.{grupo1}.{docentry2}', 'ClienteController@producto')->name('producto');
Route::get('buscarProducto','ClienteController@buscarProd')->name('buscarProd');
Route::post('guardarStock', 'ClienteController@guardarStock')->name('guardarStock');
Route::get('reporte','ReporteController@index')->name('index');
Route::get('/listaStock.{docentry}', 'ReporteController@listaStock')->name('listaStock');
Route::get('reporteGeneral','ReporteController@reporteGeneral')->name('reporteGeneral');
//Route::get('listacliente','ClienteController@listacliente' )->name('listacliente');
//Route::get('/direcciones.{codCliente}', 'ClienteController@direcciones')->name('direcciones');
//Route::get('cliente/buscador','ClienteController@buscador');
//Route::get('buscarCliente.{id}','ClienteController@buscar')->name('buscar');
//Route::post('guardar', 'ClienteController@guardar')->name('guardar');
//Route::get('listaSala','ClienteController@indexSala' )->name('indexSala');
//Route::get('/subFamilia.{id}', 'ClienteController@subFamilia')->name('subFamilia');
//Route::get('/producto.{id}.{idRDir}', 'ClienteController@producto')->name('producto');
//Route::post('guardarStock', 'ClienteController@guardarStock')->name('guardarStock');
//Route::resource('empleados','EmpleadoController');