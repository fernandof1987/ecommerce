<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;

class ProdutosController extends Controller
{
    public function produtos(){
        $produtos = Produtos::where('ProdutoStatus', 1)->get();
        return view('produtos.index', ['produtos' => $produtos]);
    }
}
