<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidoVendaItens;
use App\PedidoVendas;
use App\Estoque;

class PedidoVendaItensController extends Controller
{
    public function index(){
        $itens = PedidoVendaItens::all();
        return view('pedidos.itens', ['itens' => $itens]);
    }

    public function itens($pedidoId, PedidoVendaItens $itens){

        $itens = \DB::table('PedidoVendaItens as a')
            ->leftJoin('Produtos as b', 'a.ProdutoId', '=', 'b.Id')
            ->select('a.Id', 'a.ProdutoId', 'b.Nome', 'a.Qtde', 'a.ValorVenda', 'a.ValorTotal', 'a.Peso')
            ->where('PedidoId', $pedidoId)
            ->get();
        //dd($itens);
        $pedido = PedidoVendas::find($pedidoId);
        return view('pedidos.itens', ['itens' => $itens, 'pedido' => $pedido]);
    }

    public function addItem(Request $request, PedidoVendas $pedidos){
        
        $pedido = $pedidos->where('UsuarioId', \Auth::user()->id)->where('PedidoStatus', 1)->get(['Id']);

        if(count($pedido) == 0) {
            $pedido2 = $pedidos;
            $pedido2->UsuarioId = \Auth::user()->id;
            $pedido2->timestamps = false;
            $pedido2->save();
        }

        $pedido = $pedidos->where('UsuarioId', \Auth::user()->id)->where('PedidoStatus', 1)->get(['Id']);
        
        $pedidoId[0] = json_decode($pedido);
        $pedidoId = $pedidoId[0][0]->Id;

        $item = new PedidoVendaItens();
        $item->PedidoId = $pedidoId;
        $item->ProdutoId = $request->input('ProdutoId');
        $item->Qtde = $request->input('Qtde');
        $item->ValorVenda = $request->input('PrecoVenda');
        $item->ValorCusto = $request->input('PrecoCusto');
        //$item->Desconto = $request->input('Desconto');
        $item->Peso = $request->input('Peso');
        $item->timestamps = false;
        //$item->desconto = 0;

        $estoqueQtde = Estoque::where('ProdutoId', $item->ProdutoId)->get(['Qtde']);
        
        $estoqueQtde = (empty($estoqueQtde[0]->Qtde)) ? 0 : $estoqueQtde[0]->Qtde;

        if($item->Qtde <= $estoqueQtde) {
            $item->save();
            return redirect()->action('PedidoVendaItensController@itens', ['PedidoId' => $pedidoId]);
        }else{
            $msg1 = "O Porduto {$item->ProdutoId} não possui a quantidade solicitada <br />";
            $msg2 = "A qtde disponível é {$estoqueQtde} <br />";
            $link = "<a href='/'>Voltar</a>";
            $msg = $msg1 . $msg2;
            return view('produtos.msg', ['msg' => $msg, 'link' => $link]);
        }
    
    }

    public function removeItem($itemId){
        $item = new PedidoVendaItens();
        $item = $item->find($itemId)->delete();
        //dd($item);
        return redirect()->back();
    }
}
