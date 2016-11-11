@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pedido número: {{ $pedido->Id }}</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Cod Produto</td>
                                <td>Descrição</td>                                
                                <td>Qtde</td>
                                <td>Valor Unitário</td>
                                <td>Valor Total</td>
                                <td>Peso</td>
                                <td>Ações</td>
                            <tr>
                        </thead>
                        <tbody>
                           @foreach($itens as $item)
                            <tr>
                                <td>{{ $item->ProdutoId }}</td>
                                <td>{{ $item->Nome }}</td>
                                <td>{{ $item->Qtde }}</td>
                                <td>{{ $item->ValorVenda }}</td>
                                <td>{{ $item->ValorTotal }}</td>
                                <td>{{ $item->Peso * $item->Qtde }}</td>
                                <td>
                                    {{--<a href="#">Editar</a> | --}}
                                    <a href="/pedido/itens/remove/{{ $item->Id }}">Excluir</a>
                                </td>
                            <tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    {{--<button class="btn btn-success pull-right">Finalizar</button>--}}
                                    <span class="pull-right">Total: {{ $pedido->ValorTotal }}</span>
                                </td>
                            </tr>
                        </tfoot>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection