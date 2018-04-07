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
Route::get('/products/{id}/edit','ProductsController@edit')->name('products.edit');
Route::patch('/products/{id}/update','ProductsController@update');
//Route::delete('/productos/{id}/eliminar','ProductosController@destroy');

Route::get('/containers/index', 'ContainersController@index')->name('containers.catalogue');