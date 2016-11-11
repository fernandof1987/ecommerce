<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estoque;
use App\EstoqueEntrada;
use App\Produtos;

class AdminEstoqueController extends Controller
{
    public function index(Estoque $estoque)
    {
        $estoqueTotal = \DB::table('Estoque as a')
            ->leftJoin('Produtos as b', 'a.ProdutoId', '=', 'b.Id')
            ->select('a.Id', 'a.ProdutoId', 'b.Nome as Descricao', 'a.Qtde', 'a.Validade', 'a.Lote')
            ->get();
        //dd($estoqueTotal);
        //$estoqueTotal = $estoque->all();
        return view('admin.estoque.index', ['estoqueTotal' => $estoqueTotal]);
    }

    public function entrada(EstoqueEntrada $entrada)
    {
        $entrada = $entrada->all();
        return view('admin.estoque.entrada', ['entrada' => $entrada]);
    }

    public function createEntrada(Produtos $produtos)
    {
        $produtos = $produtos->all();
        return view('admin.estoque.create-edit-entrada',
            ['produtos' => $produtos]
        );
    }

    public function storeEntrada(Request $request, EstoqueEntrada $entrada)
    {
        $request = $request->all();
        //return $request['ProdutoId'];
        $entrada->QtdeEntrada = $request['QtdeEntrada'];
        $entrada->ProdutoId = $request['ProdutoId'];
        $entrada->UsuarioId = \Auth::user()->id;
        $entrada->save();
        return redirect()->action('AdminEstoqueController@entrada');
    }
}
