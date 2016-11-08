@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h3>Categorias</h3>
             @include('produtos._categorias')
        </div>
        <div class="col-md-10 col-md-offset">
            <h3>{{ $produto->Id }} - {{ $produto->Nome }}</h3>
            <img src="{{ $produto->Imagem or '/images/no-image.png' }}"/>
            <h4>Descrição</h4>
            <p>{{ $produto->Descricao }}</p>
            Peso: {{ $produto->Peso }} <br />
            Valor: {{ $produto->PrecoVenda }}

                 <form method="Post" action="/pedido/itens/add" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="input-group">
                            <!-- Input Hiddens -->
                            <input type="hidden" name="ProdutoId" value="{{ $produto->Id }}" />
                            <input type="hidden" name="PrecoVenda" value="{{ $produto->PrecoVenda }}" />
                            <input type="hidden" name="PrecoCusto" value="{{ $produto->PrecoCusto }}" />
                            <input type="hidden" name="Peso" value="{{ $produto->Peso }}" />
                            
                            <input type="text" name="Qtde" value="1" maxlength="3" min="1" pattern="[1-9]+$]" size="3" class="form-control" required/>
                        </div>
                    </div>
                    <button class="btn btn-primary" role="button">Adicionar</button>
                </form>

        </div>
    </div>
</div>

@endsection