<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidoVendaItens;
use App\PedidoVendas;

class PedidoVendaItensController extends Controller
{
    public function index(){
        $itens = PedidoVendaItens::all();
        return view('pedidos.itens', ['itens' => $itens]);
    }

    public function itens($pedidoId){
        $itens = PedidoVendaItens::where('PedidoId', $pedidoId)->get();
        return view('pedidos.itens', ['itens' => $itens]);
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

        //dd($item);
        $item->save();
        //return 'Iten Salvo';
        return redirect()->action('PedidoVendaItensController@itens', ['PedidoId' => $pedidoId]);
    }

    public function removeItem($itemId){
        $item = new PedidoVendaItens();
        $item = $item->find($itemId)->delete();
        return redirect()->back();
    }
}
