@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Entrada de Estoque</div>
                <div class="panel-body">

                    @if(isset($produto))

                        <form action="/admin/produtos/update" method="post" class="form">
                            {{ csrf_field() }}
                           <input type="hidden" name="Id" value="{{ $produto->Id }}" />

                            <input type="text"   name="Nome"       value="{{ $produto->Nome }}" class="form-control" placeholder="Nome"><br />
                            <input type="text"   name="Descricao"  value="{{ $produto->Descricao }}" class="form-control" placeholder="Descrição"><br />
                            <input type="number" name="PrecoCusto" value="{{ $produto->PrecoCusto }}" class="form-control" placeholder="Preço Custo"><br />
                            <input type="number" name="PrecoVenda" value="{{ $produto->PrecoVenda }}" class="form-control" placeholder="Preço Venda"><br />
                            <input type="number" name="Peso"       value="{{ $produto->Peso }}" class="form-control" placeholder="Peso"><br />

                            <select name="ProdutoStatus" class="form-control">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select><br />
                            
                            <select name="MarcaId" class="form-control">
                                {{--
                                @foreach($marcas as $marca)
                                     <option value="{{ $marca->Id }}">{{ $marca->Nome }}</option>
                                @endforeach
                                --}}
                            </select><br />

                            <select name="CategoriaId" class="form-control">
                                {{--
                                  @foreach($categorias as $categoria)
                                     <option value="{{ $categoria->Id }}">{{ $categoria->Nome }}</option>
                                @endforeach
                                --}}
                            </select><br />
                            
                            <button class="btn btn-primary">Ok</button>
                        </form>

                    @else

                        <form action="/admin/estoque/entrada/store" method="post" class="form">
                            {{ csrf_field() }}


                            <select name="ProdutoId" class="form-control">
                                @foreach($produtos as $produto)
                                     <option value="{{ $produto->Id }}">{{ $produto->Id }} - {{ $produto->Nome }}</option>
                                @endforeach
                            </select><br />

                            <input type="number" name="QtdeEntrada"  class="form-control" placeholder="Qtde" required><br />

                            <button class="btn btn-primary">Ok</button>
                        </form>

                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
