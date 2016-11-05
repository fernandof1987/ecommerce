@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Itens do Pedido</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Cod Produto</td>
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
                                <td>{{ $item->Qtde }}</td>
                                <td>{{ $item->ValorVenda }}</td>
                                <td>{{ $item->ValorTotal }}</td>
                                <td>{{ $item->Peso }}</td>
                                <td>
                                    <a href="#">Editar</a> | 
                                    <a href="/pedido/itens/remove/{{ $item->Id }}">Excluir</a>
                                </td>
                            <tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection