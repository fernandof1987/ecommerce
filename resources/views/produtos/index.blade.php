@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Produtos</h1>
           
            @forelse($produtos as $produto)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="/images/no-image.png" alt="...">
                        <div class="caption">
                            <h3>{{ $produto->Id }} - {{ $produto->Descricao }}</h3>
                            <p>R$ {{ $produto->PrecoVenda }}</p>
                            <p>
                                <!--a href="#" class="btn btn-default" role="button">Detalhes</a-->
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

                            </p>
                        </div>
                    </div>
                </div>
            @empty
                Não existem produtos cadastrados!
            @endforelse

      

        </div>
    </div>
</div>

@endsection