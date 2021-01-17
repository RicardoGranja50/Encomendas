<?php

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


Route::get('/clientes', 'App\Http\Controllers\ClientesController@index')->name('clientes.index')->middleware('auth');

Route::get('/clientes/{id}/show', 'App\Http\Controllers\ClientesController@show')->name('clientes.show')->middleware('auth');

Route::get('/produtos', 'App\Http\Controllers\ProdutosController@index')->name('produtos.index')->middleware('auth');

Route::get('/produtos/{id}/show', 'App\Http\Controllers\ProdutosController@show')->name('produtos.show')->middleware('auth');

Route::get('/vendedores', 'App\Http\Controllers\VendedoresController@index')->name('vendedores.index')->middleware('auth');

Route::get('/vendedores/{id}/show', 'App\Http\Controllers\VendedoresController@show')->name('vendedores.show')->middleware('auth');

Route::get('/encomendas', 'App\Http\Controllers\EncomendasController@index')->name('encomendas.index')->middleware('auth');

Route::get('/encomendas/{id}/show', 'App\Http\Controllers\EncomendasController@show')->name('encomendas.show')->middleware('auth');

Route::get('/formulario', 'App\Http\Controllers\FormularioController@formulario')->name('formulario')->middleware('auth');

Route::post('/mostrar', 'App\Http\Controllers\MostrarController@mostrar')->name('mostrar')->middleware('auth');



Route::get('clientes/create','App\Http\Controllers\ClientesController@create')->name('clientes.create')->middleware('auth');

Route::post('clientes/store','App\Http\Controllers\ClientesController@store')->name('clientes.store')->middleware('auth');

Route::get('clientes/edit','App\Http\Controllers\ClientesController@edit')->name('clientes.edit')->middleware('auth');

Route::patch('clientes/update','App\Http\Controllers\ClientesController@update')->name('clientes.update')->middleware('auth');

Route::get('clientes/destroy/{id}','App\Http\Controllers\ClientesController@destroy')->name('clientes.destroy')->middleware('auth');



Route::get('encomendas/create','App\Http\Controllers\EncomendasController@create')->name('encomendas.create')->middleware('auth');

Route::post('encomendas/store','App\Http\Controllers\EncomendasController@store')->name('encomendas.store')->middleware('auth');





Route::get('/','App\Http\Controllers\ClientesController@principal')->name('clientes.principal')->middleware('auth');

Route::get('encomendas/create/produto/{id}','App\Http\Controllers\EncomendasController@createProduto')->name('encomendas.create.produto')->middleware('auth');

Route::post('encomendas/store/produto/{id}','App\Http\Controllers\EncomendasController@storeProduto')->name('encomendas.store.produto')->middleware('auth');

Route::get('encomendas/edit/produto/{id}/{idp}','App\Http\Controllers\EncomendasController@editProduto')->name('encomendas.edit.produto')->middleware('auth');

Route::post('encomendas/update/produto/{id}/{idp}','App\Http\Controllers\EncomendasController@updateProduto')->name('encomendas.update.produto')->middleware('auth');




Route::get('produtos/create','App\Http\Controllers\ProdutosController@create')->name('produtos.create');

Route::post('produtos/store','App\Http\Controllers\ProdutosController@store')->name('produtos.store');





Route::get('produtos/stock/mais/{id}','App\Http\Controllers\ProdutosController@mais')->name('produtos.stock.mais');

Route::get('produtos/stock/menos/{id}','App\Http\Controllers\ProdutosController@menos')->name('produtos.stock.menos');





Route::get('produtos/edit','App\Http\Controllers\ProdutosController@edit')->name('produtos.edit');

Route::patch('produtos/update','App\Http\Controllers\ProdutosController@update')->name('produtos.update');

Route::get('produtos/destroy/{id}','App\Http\Controllers\ProdutosController@destroy')->name('produtos.destroy');


Route::get('vendedores/create','App\Http\Controllers\VendedoresController@create')->name('vendedores.create');

Route::post('vendedores/store','App\Http\Controllers\VendedoresController@store')->name('vendedores.store');


Route::get('vendedores/edit','App\Http\Controllers\VendedoresController@edit')->name('vendedores.edit');

Route::patch('vendedores/update','App\Http\Controllers\VendedoresController@update')->name('vendedores.update');

Route::get('vendedores/destroy/{id}','App\Http\Controllers\VendedoresController@destroy')->name('vendedores.destroy');




Route::get('encomendas/destroy/{id}/{idp}','App\Http\Controllers\EncomendasController@destroyProduto')->name('encomendas.destroy.produto');


Route::get('clientes/email/{id}','App\Http\Controllers\ClientesController@email')->name('clientes.email');

Route::get('encomendas/destroy/{id}','App\Http\Controllers\EncomendasController@destroy')->name('encomendas.delete');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
