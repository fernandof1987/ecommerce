<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;

class AdminProdutosController extends Controller
{
    private $model;

    public function __construct(Produtos $produtos){
        $this->model = $produtos;
       // $this->model->timestamps = false;
    }

    public function index(){
        $produtos = \DB::table('Produtos as a')
            ->leftJoin('Marcas as b', 'a.MarcaId', '=', 'b.Id')
            ->leftJoin('Categorias as c', 'a.CategoriaId', '=', 'b.Id')
            ->select('a.Id', 'a.Nome', 'a.Descricao', 'a.PrecoCusto', 'a.PrecoVenda', 'a.Peso', 'a.ProdutoStatus', 'b.Nome as Marca', 'c.Nome as Categoria')
            ->get();
        //dd($produtos);
        return view('admin.produtos.index', ['produtos' => $produtos]);
    }

    public function create(){
        $marcas = \App\Marcas::all();
        $categorias = \App\Categorias::all();
        return view('admin.produtos.create-edit', [
            'marcas' => $marcas,
            'categorias' => $categorias
        ]);
    }

    public function store(Request $request){
        $produto = $this->model;
        //$produto->fill = $request->except('_token');
        $produto->Nome = $request['Nome'];
        $produto->Descricao = $request['Descricao'];
        $produto->PrecoCusto = $request['PrecoCusto'];
        $produto->PrecoVenda = $request['PrecoVenda'];
        $produto->Peso = $request['Peso'];
        $produto->ProdutoStatus = $request['ProdutoStatus'];
        $produto->MarcaId = $request['MarcaId'];
        $produto->CategoriaId = $request['CategoriaId'];

        $produto->save();
        return redirect()->action('AdminProdutosController@index');
    }


    public function destroy($produtoId){
        $this->model->find($produtoId)->delete();
        return redirect()->back();
    }

    public function edit($produtoId){
        $marcas = \App\Marcas::all();
        $categorias = \App\Categorias::all();
        $produto = $this->model->find($produtoId);
        return view('admin.produtos.create-edit', [
            'produto' => $produto,
            'marcas' => $marcas,
            'categorias' => $categorias
        ]);
    }

    public function update(Request $request){
        $produto = $this->model->find($request['Id']);
        
        $produto->Nome = $request['Nome'];
        $produto->Descricao = $request['Descricao'];
        $produto->PrecoCusto = $request['PrecoCusto'];
        $produto->PrecoVenda = $request['PrecoVenda'];
        $produto->Peso = $request['Peso'];
        $produto->ProdutoStatus = $request['ProdutoStatus'];
        $produto->MarcaId = $request['MarcaId'];
        $produto->CategoriaId = $request['CategoriaId'];

        $produto->save();
        return redirect()->action('AdminProdutosController@index');
    }
}
