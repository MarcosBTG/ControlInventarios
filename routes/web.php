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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/index', 'ProductsController@index')->name('products.catalogue');
Route::get('/products/create', 'ProductsController@create')->name('products.create');
Route::post('/products/store','ProductsController@store');

//Route::get('/productos/{id}/editar','ProductosController@edit');//esta ruta nos muestra el formulario para poder editar el registro, como observacion la variable que se va a pasar por la url debe de estar en medio o en otra parte de nuestra ruta para asi evitar ataques sql
//Route::patch('/productos/{id}/actualizar','ProductosController@update');//esta ruta nos lleva hacia el metodo update que guiado por el id realizara la actualizacion ala base
//Route::delete('/productos/{id}/eliminar','ProductosController@destroy');

