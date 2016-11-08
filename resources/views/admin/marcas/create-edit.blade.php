@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Marcas</div>
                <div class="panel-body">

                    @if(isset($marca))

                        <form action="/admin/marcas/update" method="post" class="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="Id" value="{{ $marca->Id }}">
                            <input type="text" name="nome" value="{{ $marca->Nome }}" class="form-control">
                            <button class="btn btn-primary">Ok</button>
                        </form>

                    @else

                        <form action="/admin/marcas/store" method="post" class="form">
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
