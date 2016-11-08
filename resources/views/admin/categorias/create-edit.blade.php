@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Categorias</div>
                <div class="panel-body">

                    @if(isset($categoria))

                        <form action="/admin/categorias/update" method="post" class="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="Id" value="{{ $categoria->Id }}">
                            <input type="text" name="nome" value="{{ $categoria->Nome }}" class="form-control">
                            <button class="btn btn-primary">Ok</button>
                        </form>

                    @else

                        <form action="/admin/categorias/store" method="post" class="form">
                            {{ csrf_field() }}
                            <input type="text" name="nome" class="form-control">
                            <button class="btn btn-primary">Ok</button>
                        </form>

                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
