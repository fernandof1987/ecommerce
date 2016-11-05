<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidoVendas;
//use App\Http\Controllers\Auth;

class PedidoVendasController extends Controller
{
    public function Index(){
        $pedidos = PedidoVendas::where('UsuarioId', \Auth::user()->id)->get()->where('PedidoStatus', '<>', 3);
        return view('pedidos.index', ['pedidos' => $pedidos]);
    }

    public function cancela($pedidoId, PedidoVendas $pedidos){
        $pedido = $pedidos->find($pedidoId);
        $pedido->timestamps = false;
        $pedido->PedidoStatus = 3;
        $pedido->save();
        return redirect()->back();        
    }
}
