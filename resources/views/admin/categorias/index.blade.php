@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Categorias<a href="/admin/categorias/create" class="pull-right btn btn-primary btn-xs">Adicionar nova categoria</a></div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                         @forelse($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->Id }}</td>
                                <td>{{ $categoria->Nome }}</td>
                                <td>
                                    <a href="/admin/categorias/edit/{{ $categoria->Id }}">Editar</a> | 
                                    <a href="/admin/categorias/delete/{{ $categoria->Id }}">Excluir</a>
                                </td>
                            </tr>
                        @empty
                           <tr><td colspan="3">Sem Categorias</td></tr>
                        @endforelse
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
