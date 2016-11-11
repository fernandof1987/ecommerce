<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;

class ProdutosController extends Controller
{
    public function produtos(){
        $produtos = Produtos::where('ProdutoStatus', 1)->paginate(6);
        return view('produtos.index', ['produtos' => $produtos]);
    }

    public function categoria($categoriaId){
         $produtos = Produtos::where('ProdutoStatus', 1)->where('CategoriaId', $categoriaId)->paginate(6);
         return view('produtos.index', ['produtos' => $produtos]);
    }

    public function produto($produtoId){
        $produto = Produtos::find($produtoId);
        return view('produtos.produto', ['produto' => $produto]);
    }

    public function buscaProdutos(Request $request, Produtos $produtos){
        $busca = $request['search'];

        //Model::where('column', 'LIKE', '%value%')->get();

        $produtos = $produtos->where('ProdutoStatus', 1);

        $produtos = $produtos->where('Nome', 'LIKE', '%' . $busca . '%');
            
        return view('produtos.index', ['produtos' => $produtos->paginate(1000)]);
    }
}
