@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pedidos</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Número</td>
                                <td>Qtde Itens</td>
                                <td>Valor Total</td>
                                <td>Peso Total</td>
                                <td>Desconto</td>
                                <td>Data</td>
                                <td>Status</td>
                                <td>Ações</td>
                            <tr>
                        </thead>
                        <tbody>
                           @forelse($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->Id }}</td>
                                    <td>{{ $pedido->QtdeItens }}</td>
                                    <td>{{ $pedido->ValorTotal }}</td>
                                    <td>{{ $pedido->PesoTotal }}</td>
                                    <td>{{ $pedido->Desconto }}</td>
                                    <td>{{ $pedido->DataPedido }}</td>
                                    <td>{{ $pedido->PedidoStatus }}</td>
                                    <td>
                                        @if($pedido->PedidoStatus <> 3)
                                            <a href="pedidos/itens/{{ $pedido->Id }}">Ver itens</a> | 
                                        @endif
                                        <a href="pedidos/cancela/{{ $pedido->Id }}">Cancelar</a>
                                    </td>
                                <tr>
                            @empty
                                <td colspan="8">Usuário não possui pedidos!</td>
                            @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection