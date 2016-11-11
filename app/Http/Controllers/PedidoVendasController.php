<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidoVendas;
use App\PedidoVendaItens;
//use App\Http\Controllers\Auth;

class PedidoVendasController extends Controller
{
    public function Index(){
        $pedidos = PedidoVendas::where('UsuarioId', \Auth::user()->id)->where('PedidoStatus', '<>', 3)->get();
        //dd($pedidos);
        return view('pedidos.index', ['pedidos' => $pedidos]);
    }

    public function cancela($pedidoId, PedidoVendas $pedidos){
        $itens = PedidoVendaItens::where('PedidoId', $pedidoId);
        $itens->delete();
        $pedido = $pedidos->find($pedidoId);
        $pedido->timestamps = false;
        $pedido->PedidoStatus = 3;
        $pedido->save();
        return redirect()->back();        
    }

    public function finaliza($pedidoId, PedidoVendas $pedidos){
        $pedido = $pedidos->find($pedidoId);
        $pedido->timestamps = false;
        $pedido->PedidoStatus = 2;
        $pedido->save();
        return redirect()->back();        
    }
}
