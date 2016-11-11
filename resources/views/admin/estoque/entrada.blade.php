@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Entrada de Estoque
                    <a href="/admin/estoque/entrada/create" class="pull-right btn btn-primary btn-xs">
                        Nova entrada
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Id</th>
                            <th>Cod Produto</th>
                            <th>Data Entrada</th>
                            <th>Qtde Anterior</th>
                            <th>Qtde Entrada</th>
                            <th>Qtde Total</th>
                            <th>Cod Usuario</th>
                            <!--
                            <th>Pedido de Compra</th>
                            <th>Obs</th>
                            <th>Ações</th>
                            -->
                        </tr>
                         @forelse($entrada as $item)
                            <tr>
                                <td>{{ $item->Id }}</td>
                                <td>{{ $item->ProdutoId }}</td>
                                <td>{{ $item->DataEntrada }}</td>
                                <td>{{ $item->QtdeAnterior }}</td>
                                <td>{{ $item->QtdeEntrada }}</td>
                                <td>{{ $item->QtdeRestante }}</td>
                                <td>{{ $item->UsuarioId }}</td>
                                {{--
                                <td>{{ $item->PedidoCompraId }}</td>
                                <td>{{ $item->Obs }}</td>
                               
                                <td>
                                    <a href="/admin/entrada/edit/{{ $item->Id }}">Editar</a> | 
                                    <a href="/admin/entrada/delete/{{ $item->Id }}">Excluir</a>
                                </td>
                                --}}
                            </tr>
                        @empty
                           <tr><td colspan="10">Sem Estoque</td></tr>
                        @endforelse
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
