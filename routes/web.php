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

Route::get('/pedidos', 'PedidoVendasController@index')->middleware('auth');
Route::get('/pedidos/cancela/{pedidoId}', 'PedidoVendasController@cancela')->middleware('auth');
Route::get('/pedidos/finaliza/{pedidoId}', 'PedidoVendasController@finaliza')->middleware('auth');


Route::get('/pedidos/itens/{pedidoId}', 'PedidoVendaItensController@itens')->middleware('auth');

Route::post('/pedido/itens/add', 'PedidoVendaItensController@addItem')->middleware('auth');
Route::get('/pedido/itens/remove/{itemId}', 'PedidoVendaItensController@removeItem')->middleware('auth');

Route::get('/produtos', 'ProdutosController@produtos');
Route::get('/produtos/categoria/{categoriaId}', 'ProdutosController@categoria');
Route::get('/produtos/{produtoId}', 'ProdutosController@produto');
/*Admin Categorias*/
Route::get('/admin/categorias', 'AdminCategoriasController@index');
Route::get('/admin/categorias/create', 'AdminCategoriasController@create');
Route::post('/admin/categorias/store', 'AdminCategoriasController@store');
Route::get('/admin/categorias/delete/{categoriaId}', 'AdminCategoriasController@destroy');
Route::get('/admin/categorias/edit/{categoriaId}', 'AdminCategoriasController@edit');
Route::post('/admin/categorias/update', 'AdminCategoriasController@update');
/*Admin Marcas*/
Route::get('/admin/marcas', 'AdminMarcasController@index');
Route::get('/admin/marcas/create', 'AdminMarcasController@create');
Route::post('/admin/marcas/store', 'AdminMarcasController@store');
Route::get('/admin/marcas/delete/{categoriaId}', 'AdminMarcasController@destroy');
Route::get('/admin/marcas/edit/{categoriaId}', 'AdminMarcasController@edit');
Route::post('/admin/marcas/update', 'AdminMarcasController@update');
/*Admin Prodtutos*/
Route::get('/admin/produtos', 'AdminProdutosController@index');
Route::get('/admin/produtos/create', 'AdminProdutosController@create');
Route::post('/admin/produtos/store', 'AdminProdutosController@store');
Route::get('/admin/produtos/delete/{categoriaId}', 'AdminProdutosController@destroy');
Route::get('/admin/produtos/edit/{categoriaId}', 'AdminProdutosController@edit');
Route::post('/admin/produtos/update', 'AdminProdutosController@update');


Route::get('/teste', function(){
    $value = Auth::user()->id;
    echo dd($value);
});