<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {return view('welcome');});

Auth::routes();

//Route::get('/', 'HomeController@index');
Route::get('/', 'ProdutosController@produtos');
Route::get('/home', 'ProdutosController@produtos');

Route::get('/pedidos', 'PedidoVendasController@index');
Route::get('/pedidos/cancela/{pedidoId}', 'PedidoVendasController@cancela');

Route::get('/pedidos/itens/{pedidoId}', 'PedidoVendaItensController@itens');

Route::post('/pedido/itens/add', 'PedidoVendaItensController@addItem');
Route::get('/pedido/itens/remove/{itemId}', 'PedidoVendaItensController@removeItem');

Route::get('/produtos', 'ProdutosController@produtos');


Route::get('/teste', function(){
    $value = Auth::user()->id;
    echo dd($value);
});