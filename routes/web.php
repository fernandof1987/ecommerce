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

Route::get('/cliente/create', 'ClientesController@create');
Route::post('/cliente/store', 'ClientesController@store');
Route::get('/cliente/edit', 'ClientesController@edit');
Route::post('/cliente/update', 'ClientesController@update');

Route::get('/produtos', 'ProdutosController@produtos');
Route::get('/produtos/categoria/{categoriaId}', 'ProdutosController@categoria');
Route::get('/produtos/{produtoId}', 'ProdutosController@produto');
Route::post('/produtos/busca', 'ProdutosController@buscaProdutos');
/*Admin Categorias*/
Route::get('/admin/categorias', 'AdminCategoriasController@index')->middleware('admin');
Route::get('/admin/categorias/create', 'AdminCategoriasController@create')->middleware('admin');
Route::post('/admin/categorias/store', 'AdminCategoriasController@store')->middleware('admin');
Route::get('/admin/categorias/delete/{categoriaId}', 'AdminCategoriasController@destroy')->middleware('admin');
Route::get('/admin/categorias/edit/{categoriaId}', 'AdminCategoriasController@edit')->middleware('admin');
Route::post('/admin/categorias/update', 'AdminCategoriasController@update')->middleware('admin');
/*Admin Marcas*/
Route::get('/admin/marcas', 'AdminMarcasController@index')->middleware('admin');
Route::get('/admin/marcas/create', 'AdminMarcasController@create')->middleware('admin');
Route::post('/admin/marcas/store', 'AdminMarcasController@store')->middleware('admin');
Route::get('/admin/marcas/delete/{categoriaId}', 'AdminMarcasController@destroy')->middleware('admin');
Route::get('/admin/marcas/edit/{categoriaId}', 'AdminMarcasController@edit')->middleware('admin');
Route::post('/admin/marcas/update', 'AdminMarcasController@update')->middleware('admin');
/*Admin Prodtutos*/
Route::get('/admin/produtos', 'AdminProdutosController@index')->middleware('admin');
Route::get('/admin/produtos/create', 'AdminProdutosController@create')->middleware('admin');
Route::post('/admin/produtos/store', 'AdminProdutosController@store')->middleware('admin');
Route::get('/admin/produtos/delete/{categoriaId}', 'AdminProdutosController@destroy')->middleware('admin');
Route::get('/admin/produtos/edit/{categoriaId}', 'AdminProdutosController@edit')->middleware('admin');
Route::post('/admin/produtos/update', 'AdminProdutosController@update')->middleware('admin');
/*Admin Estoque*/
Route::get('/admin/estoque', 'AdminEstoqueController@index')->middleware('admin');
Route::get('/admin/estoque/entrada', 'AdminEstoqueController@entrada')->middleware('admin');
Route::get('/admin/estoque/entrada/create', 'AdminEstoqueController@createEntrada')->middleware('admin');
Route::post('/admin/estoque/entrada/store', 'AdminEstoqueController@storeEntrada')->middleware('admin');


Route::get('/teste', function(){
    $value = Auth::user()->id;
    echo dd($value);
});