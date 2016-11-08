@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Marcas<a href="/admin/marcas/create" class="pull-right btn btn-primary">Adicionar nova marca</a></div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                         @forelse($marcas as $marca)
                            <tr>
                                <td>{{ $marca->Id }}</td>
                                <td>{{ $marca->Nome }}</td>
                                <td>
                                    <a href="/admin/marcas/edit/{{ $marca->Id }}">Editar</a> | 
                                    <a href="/admin/marcas/delete/{{ $marca->Id }}">Excluir</a>
                                </td>
                            </tr>
                        @empty
                           <tr><td colspan="3">Sem Marcas</td></tr>
                        @endforelse
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
