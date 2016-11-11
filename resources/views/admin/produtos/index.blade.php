@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de produtos<a href="/admin/produtos/create" class="pull-right btn btn-primary btn-xs">Adicionar nova produto</a></div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço Custo</th>
                            <th>Preço Venda</th>
                            <th>Peso</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                         @forelse($produtos as $produto)
                            <tr>
                                <td>{{ $produto->Id }}</td>
                                <td>{{ $produto->Nome }}</td>
                                <td>{{ $produto->Descricao }}</td>
                                <td>{{ $produto->PrecoCusto }}</td>
                                <td>{{ $produto->PrecoVenda }}</td>
                                <td>{{ $produto->Peso }}</td>
                                <td>{{ $produto->Marca }}</td>
                                <td>{{ $produto->Categoria }}</td>
                                <td>{{ $produto->ProdutoStatus }}</td>
                                <td>
                                    <a href="/admin/produtos/edit/{{ $produto->Id }}">Editar</a> | 
                                    <a href="/admin/produtos/delete/{{ $produto->Id }}">Excluir</a>
                                </td>
                            </tr>
                        @empty
                           <tr><td colspan="3">Sem produtos</td></tr>
                        @endforelse
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
