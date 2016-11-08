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
                                    <td>{{ $pedido->DataPedido }}</td>
                                    <td>
                                        @if($pedido->PedidoStatus == 1)
                                            Aberto
                                        @elseif($pedido->PedidoStatus == 2)
                                            Finalizado
                                        @else 
                                            Cancelado
                                        @endif
                                    </td>
                                    <td>
                                        @if($pedido->PedidoStatus == 1)
                                            <a href="pedidos/itens/{{ $pedido->Id }}">Ver itens</a>  | 
                                            <a href="pedidos/cancela/{{ $pedido->Id }}">Cancelar</a> | 
                                            <a href="pedidos/finaliza/{{ $pedido->Id }}">Finalizar</a>
                                        @else
                                            <span style="color:#ccc">
                                                Ver itens | 
                                                Cancelar  | 
                                                Finalizar
                                            </span>
                                        
                                        @endif

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