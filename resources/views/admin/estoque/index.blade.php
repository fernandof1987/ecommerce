@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Estoque
                    <a href="/admin/estoque/entrada" class="pull-right btn btn-primary btn-xs">
                        Entrada estoque
                    </a>
                    <a href="#" class="pull-right btn btn-danger btn-xs disabled">
                        Saida manual
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Id</th>
                            <th>Cod Produto</th>
                            <th>Descrição</th>
                            <th>Qtde</th>
                            <th>Validade</th>
                            <th>Lote</th>
                            <!--th>Ações</th-->
                        </tr>
                         @forelse($estoqueTotal as $estoque)
                            <tr>
                                <td>{{ $estoque->Id }}</td>
                                <td>{{ $estoque->ProdutoId }}</td>
                                <td>{{ $estoque->Descricao }}</td>
                                <td>{{ $estoque->Qtde }}</td>
                                <td>{{ $estoque->Validade or '-' }}</td>
                                <td>{{ $estoque->Lote or '-' }}</td>
                                {{--
                                <td>
                                    <a href="/admin/estoque/edit/{{ $estoque->Id }}">Editar</a> | 
                                    <a href="/admin/estoque/delete/{{ $estoque->Id }}">Excluir</a>
                                </td>
                                --}}
                            </tr>
                        @empty
                           <tr><td colspan="6">Sem Estoque</td></tr>
                        @endforelse
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
